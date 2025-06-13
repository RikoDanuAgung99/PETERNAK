<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use DataTables;
use Session;
use Alert;
use App\Models\Kandang;
use App\Models\StokObat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Obat $obat)
    {
        $kandang = Kandang::all();

        return view('masterdata.obat.index', compact('obat', 'kandang'));
    }

    public function getObat(Request $request)
    {
        $query = Obat::query();

        if (auth()->user()->level === 'PETERNAK') {
            $query->where('kandang_id', auth()->user()->kandang_id);
        } elseif ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }
        return DataTables::of($query)
            ->editColumn('aksi', function ($obat) {
                return view('partials._action_obat', [
                    'model' => $obat,
                    'form_url' => $obat->id,
                    'edit_url' => route('obat.edit', $obat->id),
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['aksi'])
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kandang_id = Auth::user()->kandang_id;

        $stokObat = StokObat::select('jenis_obat')
            ->where('kandang_id', $kandang_id)
            ->whereIn('jenis_obat', ['ANTIBIOTIK', 'PROBIOTIK', 'VITAMIN'])
            ->groupBy('jenis_obat')
            ->selectRaw('jenis_obat, SUM(stok_obat) as total_jumlah')
            ->pluck('total_jumlah', 'jenis_obat');

        return view('masterdata.obat.tambah', compact('stokObat'));
    }


    /**
     * Store a newly created resource in storage.
     */
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

                $totalStok = StokObat::where('kandang_id', $kandangId)
                    ->where('jenis_obat', $jenis)
                    ->sum('stok_obat');

                if ($totalStok <= 0) {
                    throw new \Exception("Stok obat jenis $jenis kosong.");
                }

                if ($jumlahPemakaian > $totalStok) {
                    throw new \Exception("Stok obat jenis $jenis hanya tersedia $totalStok, tidak mencukupi.");
                }

                $sisaPemakaian = $jumlahPemakaian;
                $stokList = StokObat::where('kandang_id', $kandangId)
                    ->where('jenis_obat', $jenis)
                    ->orderBy('id')
                    ->get();

                foreach ($stokList as $stok) {
                    if ($stok->stok_obat >= $sisaPemakaian) {
                        $stok->stok_obat -= $sisaPemakaian;
                        $stok->save();
                        break;
                    } else {
                        $sisaPemakaian -= $stok->stok_obat;
                        $stok->stok_obat = 0;
                        $stok->save();
                    }
                }

                Obat::create([
                    'tanggal' => $request->tanggal,
                    'umur' => $request->umur,
                    'jenis' => $jenis,
                    'jumlah' => $jumlahPemakaian,
                    'stok_obat' => $totalStok - $jumlahPemakaian,
                    'created_id' => auth()->id(),
                    'kandang_id' => $kandangId,
                    'created_at' => now(),
                    'updated_at' => null,
                ]);
            });

            Alert::success('Sukses', 'Berhasil Menambahkan Data Penggunaan Obat Baru');
            return redirect()->route('obat.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit($id)
    // {
    //     $kandang_id = Auth::user()->kandang_id;

    //     $obat = Obat::where('id', $id)
    //         ->where('kandang_id', $kandang_id)
    //         ->firstOrFail();

    //     $stokObatReal = StokObat::where('kandang_id', $kandang_id)
    //         ->where('jenis_obat', $obat->jenis)
    //         ->sum('stok_obat');

    //     $stokObat[$obat->jenis] = $stokObatReal + $obat->jumlah;

    //     return view('masterdata.obat.edit', compact('obat', 'stokObat'));
    // }
    public function edit(Obat $obat)
    {
        $kandang_id = Auth::user()->kandang_id;

        $stokObatAwal = StokObat::where('kandang_id', $kandang_id)
            ->where('jenis_obat', $obat->jenis)
            ->value('stok_obat');

        $stokObat[$obat->jenis] = $stokObatAwal + $obat->jumlah;

        return view('masterdata.obat.edit', compact('obat', 'stokObat'));
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Obat $obat)
    {
        try {
            $this->validate($request, [
                'tanggal' => 'required|date',
                'umur' => 'required|numeric',
                'jumlah' => 'required|numeric|min:1',
            ]);

            DB::transaction(function () use ($request, $obat) {
                $kandangId = auth()->user()->kandang_id;
                $jenis = $obat->jenis; 
                $jumlahBaru = $request->jumlah;
                $jumlahLama = $obat->jumlah;
                $selisih = $jumlahBaru - $jumlahLama;

                $stok = StokObat::where('kandang_id', $kandangId)
                    ->where('jenis_obat', $jenis)
                    ->firstOrFail();

                if ($selisih > 0) {
                    if ($stok->stok_obat < $selisih) {
                        throw new \Exception("Stok tidak mencukupi. Sisa stok: $stok->stok_obat.");
                    }
                    $stok->stok_obat -= $selisih;
                } elseif ($selisih < 0) {
                    $stok->stok_obat += abs($selisih);
                }

                $stok->save();

                $obat->update([
                    'tanggal' => $request->tanggal,
                    'umur' => $request->umur,
                    'jumlah' => $jumlahBaru,
                    'stok_obat' => $stok->stok_obat,
                    'updated_at' => now(),
                ]);
            });

            Alert::success('Sukses', 'Berhasil Memperbarui Data Penggunaan Obat');
            return redirect()->route('obat.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Obat $obat)
    {
        $stok = StokObat::where('jenis_obat', $obat->jenis)->first();

        if ($stok) {
            // $stok->jumlah_obat += $obat->jumlah;
            $stok->stok_obat += $obat->jumlah;
            $stok->save();
        }

        $obat->delete();

        Alert::success('Sukses', 'Berhasil Menghapus Data Obat');
        return redirect()->route('obat.index');
    }


    public function printPdf(Request $request)
    {
        $query = Obat::query();

        if (auth()->user()->level === 'PETERNAK') {
            $query->where('kandang_id', auth()->user()->kandang_id);
        } elseif ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }

        $obat = $query->get();
        $pdf = PDF::loadView('masterdata.obat._pdf', compact('obat'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Data Obat Harian.pdf', array("Attachment" => false));
    }
}
