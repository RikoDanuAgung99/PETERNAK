<?php

namespace App\Http\Controllers;

use App\Models\Kandang;
use App\Models\StokObat;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class TransaksiObatController extends Controller
{
    public function index(Request $request)
    {
        $halaman = 10;
        $query = StokObat::query();

        if (auth()->user()->level === 'PETERNAK') {
            $query->where('kandang_id', auth()->user()->kandang_id);
        } elseif ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }
        $kandang = Kandang::all();
        $listObat = $query->orderBy('tanggal')->paginate($halaman);
        $data = compact('listObat', 'halaman', 'kandang');
        return view('masterData.transaksiObat.index', $data);
    }


    public function getObat(Request $request)
    {
        if ($request->ajax()) {
            $obat = StokObat::all();
            return DataTables::of($obat)
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
    }


    public function create(StokObat $obat)
    {
        $kandang = Kandang::all();
        return view('masterData.transaksiObat.tambah', compact('obat', 'kandang'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tanggal' => 'required|date',
            'jenis_obat' => 'required|string|max:255',
            'stok_awal' => 'required|numeric',
            'jumlah' => 'nullable|numeric',
            'harga' => 'nullable|numeric',
            'kandang_id' => 'required|numeric',
        ]);

        $jumlah = $request->jumlah ?? 0;
        $harga = $request->harga ?? 0;

        $data = [
            'tanggal' => $request->tanggal,
            'jenis_obat' => $request->jenis_obat,
            'stok_awal' => $request->stok_awal,
            'jumlah' => $jumlah,
            'harga' => $harga,
            'total_harga' => $jumlah * $harga,
            'kandang_id' => $request->kandang_id,
            'created_id' => auth()->id(),
            'created_at' => now(),
            'updated_at' => null,
        ];

        StokObat::create($data);

        Alert::success('Sukses', 'Berhasil Menambahkan Data Obat Baru');
        return redirect()->route('transaksiObat.index');
    }


    public function edit($id)
    {
        $obat = StokObat::findOrFail($id);
        $kandang = Kandang::all();
        return view('masterData.transaksiObat.edit', compact('obat', 'kandang'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tanggal' => 'required|date',
            'jenis_obat' => 'required|string|max:255',
            'stok_awal' => 'required|numeric',
            'jumlah' => 'nullable|numeric',
            'harga' => 'nullable|numeric',
            'kandang_id' => 'required|numeric',
        ]);

        $obat = StokObat::findOrFail($id);

        $jumlah = $request->jumlah ?? 0;
        $harga = $request->harga ?? 0;

        $data = [
            'tanggal' => $request->tanggal,
            'jenis_obat' => $request->jenis_obat,
            'stok_awal' => $request->stok_awal,
            'jumlah' => $jumlah,
            'harga' => $harga,
            'total_harga' => $jumlah * $harga,
            'kandang_id' => $request->kandang_id,
            'updated_id' => auth()->id(),
            'updated_at' => now(),
        ];

        $obat->update($data);

        Alert::success('Sukses', 'Berhasil Memperbarui Data Obat');
        return redirect()->route('transaksiObat.index');
    }


    public function destroy($id)
    {
        $obat = StokObat::findOrFail($id);
        $obat->delete();
        Alert::success('Sukses', 'Berhasil Menghapus Data Obat');
        return redirect()->route('transaksiObat.index');
    }
    public function printPdf(Request $request)
    {
        $query = StokObat::query();

        if (auth()->user()->level === 'PETERNAK') {
            $query->where('kandang_id', auth()->user()->kandang_id);
        } elseif ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }

        $obat = $query->orderBy('tanggal')->get();

        $pdf = PDF::loadView('masterdata.transaksiObat._pdf', compact('obat'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Data Transaksi Obat.pdf', ["Attachment" => false]);
    }

    public function getTransaksiObat(Request $request)
    {
        if ($request->ajax()) {
            $obat = StokObat::all();
            return DataTables::of($obat)
                ->editColumn('aksi', function ($obat) {
                    return view('partials._action_transaksi_obat', [
                        'model' => $obat,
                        'form_url' => $obat->id,
                        'edit_url' => route('transaksiObat.edit', $obat->id),
                    ]);
                })
                ->addIndexColumn()
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }
}
