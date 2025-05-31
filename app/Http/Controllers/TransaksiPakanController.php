<?php

namespace App\Http\Controllers;

use App\Models\StokPakan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class TransaksiPakanController extends Controller
{
    
    public function index()
    {
        $halaman = 10;
        $listPakan = StokPakan::orderBy('tanggal')->paginate($halaman);
        $data = compact('listPakan', 'halaman');
        return view('masterData.transaksiPakan.index', $data);
    }

    public function create(StokPakan $pakan)
    {
        return view('masterData.transaksiPakan.tambah', compact('pakan'));
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
            'tanggal' => 'required|date',
            'no_doc'    => 'required|string|max:255',
            'jenis_pakan' => 'required|string',
            'jumlah_pakan' => 'required|numeric',
            'harga_pakan' => 'required|numeric',
            'total_harga' => 'required|numeric',
        ]);
        $request->merge([
            'total_harga' => $request->jumlah_pakan * $request->harga_pakan,
        ]);
        StokPakan::create($request->all());
        Alert::success('Sukses', 'Berhasil Menambahkan Data Pakan Baru');
        return redirect()->route('transaksiPakan.index');
    }

    
    public function show($id)
    {
        $pakan = StokPakan::findOrFail($id);
        return view('masterData.transaksiPakan.show', compact('pakan'));
    }

    public function edit($id)
    {
        $pakan = StokPakan::findOrFail($id);
        return view('masterData.transaksiPakan.edit', compact('pakan'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tanggal' => 'required|date',
            'no_doc'    => 'required|string|max:255',
            'jenis_pakan' => 'required|string',
            'jumlah_pakan' => 'required|numeric',
            'harga_pakan' => 'required|numeric',
            'total_harga' => 'required|numeric',
        ]);
        $pakan = StokPakan::findOrFail($id);
        $request->merge([
            'total_harga' => $request->jumlah_pakan * $request->harga_pakan,
        ]);
        $pakan->update($request->all());
        Alert::success('Sukses', 'Berhasil Memperbarui Data Pakan');
        return redirect()->route('transaksiPakan.index');
    }

  
    public function destroy($id)
    {
        $pakan = StokPakan::findOrFail($id);
        $pakan->delete();
        Alert::success('Sukses', 'Berhasil Menghapus Data Pakan');
        return redirect()->route('transaksiPakan.index');
    }

     public function printPdf()
    {
        $pakan = StokPakan::all();
        $pdf = PDF::loadView('masterdata.transaksiPakan._pdf', compact('pakan'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Data Transaksi Pakan.pdf', array("Attachment" => false));
    }
    
}
