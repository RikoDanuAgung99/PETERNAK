<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bw;
use DataTables;
use Session;
use Alert;
use PDF;

class BwController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('masterdata.bw.index');
    }

    public function getBw(Request $request)
    {
        if ($request->ajax()) {
        $bw = Bw::all();
        return DataTables::of($bw)
        ->editColumn('aksi', function ($bw) {
        return view('partials._action_bw', [
        'model' => $bw,
        'form_url' => $bw->id,
        'edit_url' => route('bw.edit', $bw->id),
        ]);
        })
        ->addIndexColumn()
        ->rawColumns(['aksi'])
        ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('masterdata.bw.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // memvalidasi inputan
        $this->validate($request, [
        'tanggal' => 'required|date', // Validasi untuk tanggal
        'umur' => 'required|numeric',
        'bw_act' => 'required|numeric',
        'bw_std' => 'required|numeric',
        'dif_bw' => 'required|numeric',
        ]);

        // insert data ke database
        Bw::create($request->all());
        Alert::success('Sukses', 'Berhasil Menambahkan Data BW Baru');
        return redirect()->route('bw.index');
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
    public function edit(Bw $bw)
    {
        return view('masterdata.bw.edit', compact('bw'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bw $bw)
    {
        $this->validate($request, [
        'tanggal' => 'required|date',
        'umur' => 'required|numeric',
        'bw_act' => 'required|numeric',
        'bw_std' => 'required|numeric',
        'dif_bw' => 'required|numeric',
        ]);

        // insert data ke database
        $bw->update($request->all());
        Alert::success('Sukses', 'Berhasil Mengupdate Data BW');
        return redirect()->route('bw.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bw $bw)
    {
        $bw->destroy($bw->id);
        Alert::success('Sukses', 'Berhasil Menghapus BW ');
        return redirect()->route('bw.index');
    }

    public function printPdf()
    {
        $bw = Bw::all();
        $pdf = PDF::loadView('masterdata.bw._pdf', compact('bw'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Data BW Harian.pdf', array("Attachment" => false));
    }
}
