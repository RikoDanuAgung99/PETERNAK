<?php

namespace App\Http\Controllers;

use App\Models\StokObat;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class TransaksiObatController extends Controller
{
    public function index(StokObat $obat)
    {
        $halaman = 10;
        $listObat = StokObat::orderBy('tanggal')->paginate($halaman);
        $data = compact('listObat', 'halaman');
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
        return view('masterData.transaksiObat.tambah', compact('obat'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tanggal' => 'required|date',
            'jenis_obat' => 'required|string',
            'stok_awal' => 'required|numeric',
            'jumlah' => 'numeric',
        ]);

        StokObat::create($request->all());
        Alert::success('Sukses', 'Berhasil Menambahkan Data Obat Baru');
        return redirect()->route('transaksiObat.index');
    }

    public function edit($id)
    {
        $obat = StokObat::findOrFail($id);
        return view('masterData.transaksiObat.edit', compact('obat'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tanggal' => 'required|date',
            'jenis_obat' => 'required|string',
            'stok_awal' => 'required|numeric',
            'jumlah' => 'numeric',
        ]);

        $obat = StokObat::findOrFail($id);
        $obat->update($request->all());
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
    public function printPdf()
    {
        $obat = StokObat::all();
        $pdf = PDF::loadView('masterdata.transaksiObat._pdf', compact('obat'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Data Transaksi Obat.pdf', array("Attachment" => false));
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
