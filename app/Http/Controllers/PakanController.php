<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pakan;
use DataTables;
use Session;
use Alert;
use PDF;

class PakanController extends Controller
{
    public function index(Pakan $pakan)
    {
        return view('masterdata.pakan.index', compact('pakan'));
    }

    public function getPakan(Request $request)
    {
        if ($request->ajax()) {
            $pakan = Pakan::all();
            return DataTables::of($pakan)
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
    }

    public function create(Pakan $pakan)
    {
        return view('masterdata.pakan.tambah', compact('pakan'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'tanggal' => 'required|date',
            'umur' => 'required|numeric',
            'nama' => 'required',
            'jenis' => 'required',
            'jumlah' => 'required|numeric',
        ]);

        Pakan::create($request->all());
        Alert::success('Sukses', 'Berhasil Menambahkan Data Penggunaan Pakan Baru');
        return redirect()->route('pakan.index');
    }




    public function edit(Pakan $pakan)
    {
        return view('masterdata.pakan.edit', compact('pakan'));
    }


    public function update(Request $request, Pakan $pakan)
    {
        $this->validate($request, [
            'tanggal' => 'required|date',
            'umur' => 'required|numeric',
            'nama' => 'required',
            'jenis' => 'required',
            'jumlah' => 'required|numeric',
        ]);


        $pakan->update([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'tanggal' => $request->tanggal,
            'umur' => $request->umur,
            'jumlah' => $request->jumlah,
        ]);

        Alert::success('Sukses', 'Berhasil Mengupdate Data Penggunaan Pakan Baru');
        return redirect()->route('pakan.index');
    }


    public function destroy(Pakan $pakan)
    {
        $pakan->destroy($pakan->id);
        Alert::success('Sukses', 'Berhasil Menghapus Data Pakan ');
        return redirect()->route('pakan.index');
    }

    public function printPdf()
    {
        $pakan = Pakan::all();
        $pdf = PDF::loadView('masterdata.pakan._pdf', compact('pakan'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Data Pakan Harian.pdf', array("Attachment" => false));
    }
}
