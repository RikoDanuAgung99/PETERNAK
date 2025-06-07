<?php

namespace App\Http\Controllers;

use App\Models\Kandang;
use App\Models\Kematian;
use App\Models\Panen;
use App\Models\Rekapitulasi;
use App\Models\StokBibit;
use App\Models\Stokjml_Pakan;
use App\Models\StokObat;
use App\Models\StokPakan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class RekapitulasiController extends Controller
{
    public function index(Request $request)
    {
        $halaman = 10;
        $kandang = Kandang::all();
        $query = Rekapitulasi::query()->orderBy('tanggal_start', 'desc');

        if (auth()->user()->level === 'PETERNAK') {
            $query->where('kandang_id', auth()->user()->kandang_id);
        } elseif ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }

        $list = $query->paginate($halaman);

        return view('masterdata.rekapitulasi.index', compact('kandang', 'list', 'halaman'));
    }

    public function show($id)
    {
        $kandang = Kandang::all();
        $list = Rekapitulasi::findOrFail($id);

        $stokBibit = StokBibit::where('kandang_id', $list->kandang_id)
            ->whereBetween('tanggal', [$list->tanggal_start, $list->tanggal_end])
            ->get();

        $stokPakan = StokPakan::where('kandang_id', $list->kandang_id)
            ->whereBetween('tanggal', [$list->tanggal_start, $list->tanggal_end])
            ->get();

        $stokObat = StokObat::where('kandang_id', $list->kandang_id)
            ->whereBetween('tanggal', [$list->tanggal_start, $list->tanggal_end])
            ->get();

        $panen = Panen::where('kandang_id', $list->kandang_id)
            ->whereBetween('tanggal', [$list->tanggal_start, $list->tanggal_end])
            ->get();

        return view('masterdata.rekapitulasi.detail', compact(
            'list',
            'kandang',
            'stokBibit',
            'stokPakan',
            'stokObat',
            'panen'
        ));
    }



    public function create(Request $request)
    {
        $kandang = Kandang::all();

        $rekap = [
            'jml_bibit'     => 0,
            'jml_kematian'  => 0,
            'sisa_ayam'     => 0,
            'total_panen'   => 0,
            'tonase_panen'  => 0,
            'rata_rata'     => 0,
            'deplesi'       => 0,
            'std_deplesi'   => 0,
            'diff_deplesi'  => 0,
            'pakan'     => 0,
            'std_pakan'     => 0,
            'diff_pakan'    => 0,
            'fcr'           => 0,
            'std_fcr'       => 0,
            'diff_fcr'      => 0,
        ];

        $stokBibit = collect();
        $stokPakan = collect();
        $stokObat = collect();
        $panen = collect();

        if ($request->filled(['tanggal_start', 'tanggal_end', 'kandang_id'])) {
            $stokBibit = StokBibit::where('kandang_id', $request->kandang_id)
                ->whereBetween('tanggal', [$request->tanggal_start, $request->tanggal_end])
                ->get();

            $stokPakan = StokPakan::where('kandang_id', $request->kandang_id)
                ->whereBetween('tanggal', [$request->tanggal_start, $request->tanggal_end])
                ->get();

            $stokObat = StokObat::where('kandang_id', $request->kandang_id)
                ->whereBetween('tanggal', [$request->tanggal_start, $request->tanggal_end])
                ->get();

            $panen = panen::where('kandang_id', $request->kandang_id)
                ->whereBetween('tanggal', [$request->tanggal_start, $request->tanggal_end])
                ->get();


            $rekap['jml_bibit'] = StokBibit::where('kandang_id', $request->kandang_id)
                ->whereBetween('tanggal', [$request->tanggal_start, $request->tanggal_end])
                ->sum('jumlah_bibit');

            $rekap['jml_kematian'] = Kematian::where('kandang_id', $request->kandang_id)
                ->whereBetween('tanggal', [$request->tanggal_start, $request->tanggal_end])
                ->sum('kematian');

            $rekap['sisa_ayam'] = $rekap['jml_bibit'] - $rekap['jml_kematian'];

            $rekap['total_panen'] = Panen::where('kandang_id', $request->kandang_id)
                ->whereBetween('tanggal', [$request->tanggal_start, $request->tanggal_end])
                ->sum('jumlah_panen');

            $rekap['tonase_panen'] = Panen::where('kandang_id', $request->kandang_id)
                ->whereBetween('tanggal', [$request->tanggal_start, $request->tanggal_end])
                ->sum('tonase_panen');

            $rekap['rata_rata'] = $rekap['total_panen'] > 0
                ? round($rekap['tonase_panen'] / $rekap['total_panen'], 2)
                : 0;

            $rekap['deplesi'] = $rekap['jml_bibit'] > 0
                ? round(100 - ($rekap['sisa_ayam'] / $rekap['jml_bibit'] * 100), 2)
                : 0;

            $rekap['std_deplesi'] = $request->input('std_deplesi', 0);
            $rekap['diff_deplesi'] = round($rekap['std_deplesi'] - $rekap['deplesi'], 2);

            $rekap['pakan'] = StokPakan::where('kandang_id', $request->kandang_id)
                ->whereBetween('tanggal', [$request->tanggal_start, $request->tanggal_end])
                ->get()
                ->sum(function ($item) {
                    return $item->jumlah_pakan * 50;
                });
            $rekap['std_pakan'] = $request->input('std_pakan', 0);
            $rekap['diff_pakan'] = round($rekap['std_pakan'] - $rekap['pakan'], 2);

            $rekap['fcr'] = $rekap['tonase_panen'] > 0
                ? round($rekap['pakan'] / $rekap['tonase_panen'], 4)
                : 0;
            $rekap['std_fcr'] = $request->input('std_fcr', 0);
            $rekap['diff_fcr'] = round($rekap['std_fcr'] - $rekap['fcr'], 4);
        }

        return view('masterData.rekapitulasi.tambah', [
            'kandang'        => $kandang,
            'rekapitulasi'   => new Rekapitulasi(),
            'jml_bibit'      => $rekap['jml_bibit'],
            'jml_kematian'   => $rekap['jml_kematian'],
            'sisa_ayam'      => $rekap['sisa_ayam'],
            'total_panen'    => $rekap['total_panen'],
            'tonase_panen'   => $rekap['tonase_panen'],
            'rata_rata'      => $rekap['rata_rata'],
            'deplesi'        => $rekap['deplesi'],
            'std_deplesi'    => $rekap['std_deplesi'],
            'diff_deplesi'   => $rekap['diff_deplesi'],
            'pakan'      => $rekap['pakan'],
            'std_pakan'      => $rekap['std_pakan'],
            'diff_pakan'     => $rekap['diff_pakan'],
            'fcr'            => $rekap['fcr'],
            'std_fcr'        => $rekap['std_fcr'],
            'diff_fcr'       => $rekap['diff_fcr'],
            'stokBibit'     => $stokBibit,
            'stokPakan'     => $stokPakan,
            'stokObat'       => $stokObat,
            'panen'          => $panen,
        ]);
    }

    public function store(Request $request)
    {
        // dd(request()->all());
        try {
            $validated = $request->validate([
                'tanggal_start' => 'required|date',
                'tanggal_end'   => 'required|date',
                'jml_bibit'     => 'required|numeric|min:0',
                'jml_kematian'  => 'required|numeric|min:0',
                'sisa_ayam'     => 'required|numeric|min:0',
                'deplesi'       => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
                'std_deplesi'   => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
                'total_panen'   => 'required|numeric|min:0',
                'tonase_panen'  => 'required|numeric|min:0',
                'rata_rata'     => 'required|numeric|min:0',
                'pakan'         => 'required|numeric|min:0',
                'std_pakan'     => 'required|numeric|min:0',
                'fcr'           => 'required|numeric|min:0|regex:/^\d+(\.\d{1,4})?$/',
                'std_fcr'       => 'required|numeric|min:0|regex:/^\d+(\.\d{1,4})?$/',
                'kandang_id'    => 'required|exists:kandang,id',

                'total_jumlah_bibit' => 'required|numeric|min:0',
                'harga_bibit_avg' => 'required|numeric|min:0',
                'total_harga_bibit' => 'required|numeric|min:0',

                'total_jumlah_pakan' => 'required|numeric|min:0',
                'harga_pakan_avg' => 'required|numeric|min:0',
                'total_harga_pakan' => 'required|numeric|min:0',

                'total_jumlah_obat' => 'required|numeric|min:0',
                'harga_obat_avg' => 'required|numeric|min:0',
                'total_harga_obat' => 'required|numeric|min:0',

                'total_jumlah_panen' => 'required|numeric|min:0',
                'total_tonase_panen' => 'required|numeric|min:0',
                'rata_rata_avg' => 'required|numeric|min:0',
                'harga_kontrak_avg' => 'required|numeric|min:0',
                'total_harga_panen' => 'required|numeric|min:0',

                'penjualan' => 'nullable|numeric|min:0',
                'pembelian' => 'nullable|numeric|min:0',
                'keuntungan_kerugian' => 'nullable|numeric|min:0',

            ]);

            $validated['diff_deplesi'] = round($validated['std_deplesi'] - $validated['deplesi'], 2);
            $validated['diff_pakan'] = round($validated['std_pakan'] - $validated['pakan'], 2);
            $validated['diff_fcr'] = round($validated['std_fcr'] - $validated['fcr'], 4);

            $validated['created_at'] = now();
            $validated['updated_at'] = null;
            $validated['created_id'] = auth()->id();

            Rekapitulasi::create($validated);

            Alert::success('Sukses', 'Rekapitulasi berhasil disimpan.');
            return redirect()->route('rekapitulasi.index');
        } catch (\Exception $e) {
            dd('Error saat simpan:', $e->getMessage());
        }
    }

    public function edit($id, Request $request)
    {
        $rekapitulasi = Rekapitulasi::findOrFail($id);
        $kandang = Kandang::all();

        $stokBibit = collect();
        $stokPakan = collect();
        $stokObat = collect();
        $panen = collect();

        if ($request->filled(['tanggal_start', 'tanggal_end', 'kandang_id'])) {
            $stokBibit = StokBibit::where('kandang_id', $request->kandang_id)
                ->whereBetween('tanggal', [$request->tanggal_start, $request->tanggal_end])
                ->get();

            $stokPakan = StokPakan::where('kandang_id', $request->kandang_id)
                ->whereBetween('tanggal', [$request->tanggal_start, $request->tanggal_end])
                ->get();

            $stokObat = StokObat::where('kandang_id', $request->kandang_id)
                ->whereBetween('tanggal', [$request->tanggal_start, $request->tanggal_end])
                ->get();

            $panen = Panen::where('kandang_id', $request->kandang_id)
                ->whereBetween('tanggal', [$request->tanggal_start, $request->tanggal_end])
                ->get();
        }

        return view('masterData.rekapitulasi.edit', compact('rekapitulasi', 'kandang', 'stokBibit', 'stokPakan', 'stokObat', 'panen'));
    }

    public function update(Request $request, $id)
    {
        try {
            $rekapitulasi = Rekapitulasi::findOrFail($id);

            $validated = $request->validate([
                'tanggal_start' => 'required|date',
                'tanggal_end'   => 'required|date',
                'jml_bibit'     => 'required|numeric|min:0',
                'jml_kematian'  => 'required|numeric|min:0',
                'sisa_ayam'     => 'required|numeric|min:0',
                'deplesi'       => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
                'std_deplesi'   => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
                'total_panen'   => 'required|numeric|min:0',
                'tonase_panen'  => 'required|numeric|min:0',
                'rata_rata'     => 'required|numeric|min:0',
                'pakan'         => 'required|numeric|min:0',
                'std_pakan'     => 'required|numeric|min:0',
                'fcr'           => 'required|numeric|min:0|regex:/^\d+(\.\d{1,4})?$/',
                'std_fcr'       => 'required|numeric|min:0|regex:/^\d+(\.\d{1,4})?$/',
                'kandang_id'    => 'required|exists:kandang,id',

                'total_jumlah_bibit' => 'required|numeric|min:0',
                'harga_bibit_avg' => 'required|numeric|min:0',
                'total_harga_bibit' => 'required|numeric|min:0',

                'total_jumlah_pakan' => 'required|numeric|min:0',
                'harga_pakan_avg' => 'required|numeric|min:0',
                'total_harga_pakan' => 'required|numeric|min:0',

                'total_jumlah_obat' => 'required|numeric|min:0',
                'harga_obat_avg' => 'required|numeric|min:0',
                'total_harga_obat' => 'required|numeric|min:0',

                'total_jumlah_panen' => 'required|numeric|min:0',
                'total_tonase_panen' => 'required|numeric|min:0',
                'rata_rata_avg' => 'required|numeric|min:0',
                'harga_kontrak_avg' => 'required|numeric|min:0',
                'total_harga_panen' => 'required|numeric|min:0',

                'penjualan' => 'nullable|numeric|min:0',
                'pembelian' => 'nullable|numeric|min:0',
                'keuntungan_kerugian' => 'nullable|numeric|min:0',
            ]);

            $validated['diff_deplesi'] = round($validated['std_deplesi'] - $validated['deplesi'], 2);
            $validated['diff_pakan'] = round($validated['std_pakan'] - $validated['pakan'], 2);
            $validated['diff_fcr'] = round($validated['std_fcr'] - $validated['fcr'], 4);

            $validated['updated_at'] = now();
            $validated['updated_id'] = auth()->id();

            $rekapitulasi->update($validated);

            Alert::success('Sukses', 'Rekapitulasi berhasil diperbarui.');
            return redirect()->route('rekapitulasi.index');
        } catch (\Exception $e) {
            dd('Error saat update:', $e->getMessage());
        }
    }
    public function destroy($id)
    {
        $rekapitulasi = Rekapitulasi::findOrFail($id);
        $rekapitulasi->delete();
        Alert::success('Sukses', 'Berhasil Menghapus Data rekapitulasi');
        return redirect()->route('rekapitulasi.index');
    }

    public function printPdf($id)
    {
        $list = Rekapitulasi::findOrFail($id);

        // Validasi user level (opsional, jika diperlukan untuk keamanan)
        if (auth()->user()->level === 'PETERNAK' && $list->kandang_id !== auth()->user()->kandang_id) {
            abort(403, 'Unauthorized access to this data.');
        }

        // Ambil data terkait berdasarkan tanggal dan kandang
        $stokBibit = StokBibit::where('kandang_id', $list->kandang_id)
            ->whereBetween('tanggal', [$list->tanggal_start, $list->tanggal_end])
            ->get();

        $stokPakan = StokPakan::where('kandang_id', $list->kandang_id)
            ->whereBetween('tanggal', [$list->tanggal_start, $list->tanggal_end])
            ->get();

        $stokObat = StokObat::where('kandang_id', $list->kandang_id)
            ->whereBetween('tanggal', [$list->tanggal_start, $list->tanggal_end])
            ->get();

        $panen = Panen::where('kandang_id', $list->kandang_id)
            ->whereBetween('tanggal', [$list->tanggal_start, $list->tanggal_end])
            ->get();

        $pdf = PDF::loadView('masterdata.rekapitulasi._pdf', compact(
            'list',
            'stokBibit',
            'stokPakan',
            'stokObat',
            'panen'
      ));

        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('Rekapitulasi-' . $list->id . '.pdf', ['Attachment' => false]);
    }
}
