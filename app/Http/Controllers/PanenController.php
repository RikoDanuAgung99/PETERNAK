<?php

namespace App\Http\Controllers;

use App\Models\Panen;
use Illuminate\Http\Request;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;

class PanenController extends Controller
{
    public function index()
    {
        $halaman = 10;
        $panen = Panen::orderBy('tanggal')->paginate($halaman);
        $data = compact('halaman', 'panen');
        return view('masterData.panen.index', $data);
    }

    public function create(Panen $panen)
    {
        return view('masterData.panen.tambah', compact('panen'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tanggal' => 'required|date',
            'no_doc' => 'required|string|max:255',
            'jumlah_panen' => 'required|numeric',
            'tonase_panen' => 'required|numeric',
            'rata_rata' => 'required|decimal:2',
            'harga_kontrak' => 'required|numeric',
            'total_harga' => 'required|numeric',
        ]);
        Panen::create($request->all());
        Alert::success('Sukses', 'Berhasil Menambahkan Data Panen Baru');
        return redirect()->route('panen.index')->with('success', 'Panen created successfully.');
    }

    public function show($id)
    {
        return view('panen.show', compact('id'));
    }

    public function edit($id)
    {
        $panen = Panen::findOrFail($id);
        return view('masterData.panen.edit', compact('panen'));
    }

    public function update(Request $request, $id)
    {
        // Logic to update a specific panen
        $this->validate($request, [
            'tanggal' => 'required|date',
            'no_doc' => 'required|string|max:255',
            'jumlah_panen' => 'required|numeric',
            'tonase_panen' => 'required|numeric',
            'rata_rata' => 'required|decimal:2',
            'harga_kontrak' => 'required|numeric',
            'total_harga' => 'required|numeric',
        ]);
        $panen = Panen::findOrFail($id);
        $panen->update($request->all());
        Alert::success('Sukses', 'Berhasil Memperbarui Data Panen');

        return redirect()->route('panen.index')->with('success', 'Panen updated successfully.');
    }

    public function destroy($id)
    {
        // Logic to delete a specific panen
        // Panen::destroy($id);
        $panen = Panen::findOrFail($id);
        $panen->delete();
        Alert::success('Sukses', 'Berhasil Menghapus Data Panen');
        return redirect()->route('panen.index');
    }
    public function printPdf()
    {
        $panen = Panen::all();
        $data = compact('panen');
         $pdf = PDF::loadView('masterdata.panen._pdf', $data);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Data Panen.pdf', array("Attachment" => false));
    }
}
