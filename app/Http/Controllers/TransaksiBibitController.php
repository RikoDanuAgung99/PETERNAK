<?php

namespace App\Http\Controllers;

use App\Models\stokBibit;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class TransaksiBibitController extends Controller
{
    public function index()
    {
        $halaman = 10;
        $listBibit = stokBibit::orderBy('tanggal')->paginate($halaman);
        $data = compact('listBibit', 'halaman');
        return view('masterData.transaksiBibit.index', $data);
    }
    public function create(stokBibit $bibit)
    {
        return view('masterData.transaksiBibit.tambah', compact('bibit'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'tanggal' => 'required|date',
            'no_doc' => 'required|string|max:255',
            'jenis_bibit' => 'required|string',
            'jumlah_bibit' => 'required|numeric',
            'harga_bibit' => 'required|numeric',
            'total_harga' => 'required|numeric',
        ]);
        $request->merge([
            'total_harga' => $request->jumlah_bibit * $request->harga_bibit,
        ]);
        stokBibit::create($request->all());
        Alert::success('Sukses', 'Berhasil Menambahkan Data Bibit Baru');
        return redirect()->route('transaksiBibit.index');
    }
    public function show($id)
    {
        $pakan = stokBibit::findOrFail($id);
        return view('masterData.transaksiBibot.show', compact('pakan'));
    }
    public function edit($id)
    {
        $bibit = stokBibit::findOrFail($id);
        return view('masterData.transaksiBibit.edit', compact('bibit'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tanggal' => 'required|date',
            'no_doc' => 'required|string|max:255',
            'jenis_bibit' => 'required|string',
            'jumlah_bibit' => 'required|numeric',
            'harga_bibit' => 'required|numeric',
            'total_harga' => 'required|numeric',
        ]);
        $request->merge([
            'total_harga' => $request->jumlah_bibit * $request->harga_bibit,
        ]);
        $bibit = stokBibit::findOrFail($id);
        $bibit->update($request->all());
        Alert::success('Sukses', 'Berhasil Memperbarui Data Bibit');
        return redirect()->route('transaksiBibit.index');
    }
    public function destroy($id)
    {
        $bibit = stokBibit::findOrFail($id);
        $bibit->delete();
        Alert::success('Sukses', 'Berhasil Menghapus Data Bibit');
        return redirect()->route('transaksiBibit.index');
    }
    public function cetak()
    {
        $listBibit = stokBibit::orderBy('tanggal')->get();
        return view('masterData.transaksiBibit.cetak', compact('listBibit'));
    }
    public function printPdf()
    {
        $bibit = stokBibit::all();
        $pdf = PDF::loadView('masterdata.transaksiBibit._pdf', compact('bibit'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Data Transaksi Bibit.pdf', array("Attachment" => false));
    }
}