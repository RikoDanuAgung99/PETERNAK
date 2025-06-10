<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pakan;
use DataTables;
use Session;
use Alert;
use App\Models\Kandang;
use App\Models\StokPakan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class PakanController extends Controller
{
    public function index(Pakan $pakan)
    {
        $kandang = Kandang::all();
        return view('masterdata.pakan.index', compact('pakan', 'kandang'));
    }

    public function getPakan(Request $request)
    {
        $query = Pakan::query();

        if (auth()->user()->level === 'PETERNAK') {
            $query->where('kandang_id', auth()->user()->kandang_id);
        } elseif ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }


        return DataTables::of($query)
            ->editColumn('aksi', function ($pakan) {
                return view('partials._action_pakan', [
                    'model' => $pakan,
                    'form_url' => $pakan->id,
                    'edit_url' => route('pakan.edit', $pakan->id),
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['aksi'])
            ->make(true);
    }


    public function create()
    {
        $kandang_id = Auth::user()->kandang_id;

        $stokPakan = StokPakan::select('jenis_pakan')
            ->where('kandang_id', $kandang_id)
            ->whereIn('jenis_pakan', ['STARTER', 'PRESTARTER', 'FINISHER'])
            ->groupBy('jenis_pakan')
            ->selectRaw('jenis_pakan, SUM(stok_pakan) as total_jumlah')
            ->pluck('total_jumlah', 'jenis_pakan');

        return view('masterdata.pakan.tambah', compact('stokPakan'));
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'tanggal' => 'required|date',
                'umur' => 'required|numeric',
                'jenis' => 'required|string|max:255',
                'jumlah' => 'required|numeric|min:1',
            ]);

            DB::transaction(function () use ($request) {
                $kandangId = auth()->user()->kandang_id;
                $jenis = $request->jenis;
                $jumlahPemakaian = $request->jumlah;

                $totalStok = StokPakan::where('kandang_id', $kandangId)
                    ->where('jenis_pakan', $jenis)
                    ->sum('stok_pakan');

                if ($totalStok <= 0) {
                    throw new \Exception("Stok pakan jenis $jenis kosong.");
                }

                if ($jumlahPemakaian > $totalStok) {
                    throw new \Exception("Stok pakan jenis $jenis hanya tersedia $totalStok, tidak mencukupi.");
                }

                $sisaPemakaian = $jumlahPemakaian;
                $stokList = StokPakan::where('kandang_id', $kandangId)
                    ->where('jenis_pakan', $jenis)
                    ->orderBy('id') 
                    ->get();

                foreach ($stokList as $stok) {
                    if ($stok->stok_pakan >= $sisaPemakaian) {
                        $stok->stok_pakan -= $sisaPemakaian;
                        $stok->save();
                        break;
                    } else {
                        $sisaPemakaian -= $stok->stok_pakan;
                        $stok->stok_pakan = 0;
                        $stok->save();
                    }
                }

                Pakan::create([
                    'tanggal' => $request->tanggal,
                    'umur' => $request->umur,
                    'jenis' => $jenis,
                    'jumlah' => $jumlahPemakaian,
                    'stok_pakan' => $totalStok - $jumlahPemakaian,
                    'created_id' => auth()->id(),
                    'kandang_id' => $kandangId,
                    'created_at' => now(),
                    'updated_at' => null,
                ]);
            });

            Alert::success('Sukses', 'Berhasil Menambahkan Data Penggunaan Pakan Baru');
            return redirect()->route('pakan.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }



    public function edit(Pakan $pakan)
    {
        return view('masterdata.pakan.edit', compact('pakan'));
    }


    public function update(Request $request, Pakan $pakan)
    {
        try {
            // Validasi inputan
            $this->validate($request, [
                'tanggal' => 'required|date',
                'umur' => 'required|numeric',
                'nama' => 'required|string|max:255',
                'jenis' => 'required|string|max:255',
                'jumlah' => 'required|numeric',
            ]);

            // Buat data untuk update
            $data = [
                'tanggal' => $request->tanggal,
                'umur' => $request->umur,
                'nama' => $request->nama,
                'jenis' => $request->jenis,
                'jumlah' => $request->jumlah,
                'updated_at' => now(),
            ];

            // Update data di database
            $pakan->update($data);

            Alert::success('Sukses', 'Berhasil Mengupdate Data Penggunaan Pakan');
            return redirect()->route('pakan.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }


    public function destroy(Pakan $pakan)
    {
        $pakan->destroy($pakan->id);
        Alert::success('Sukses', 'Berhasil Menghapus Data Pakan ');
        return redirect()->route('pakan.index');
    }

    public function printPdf(Request $request)
    {
        $query = Pakan::query();

        if (auth()->user()->level === 'PETERNAK') {
            $query->where('kandang_id', auth()->user()->kandang_id);
        } elseif ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }

        $pakan = $query->get();
        $pdf = PDF::loadView('masterdata.pakan._pdf', compact('pakan'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Data Pakan Harian.pdf', array("Attachment" => false));
    }
}
