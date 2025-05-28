<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rekaptest;
use DataTables;
use Session;
use Alert;
use PDF;

class RekaptestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Rekaptest $rekaptest)
    {
        return view('masterdata.rekaptest.index', compact('rekaptest')); 
    }

    public function getRekaptest(Request $request)
    {
        if ($request->ajax()) {
        $rekaptest = Rekaptest::all();
        return DataTables::of($rekaptest)
        ->editColumn('aksi', function ($rekaptest) {
        return view('partials._action_rekaptest', [
        'model' => $rekaptest,
        'form_url' => $rekaptest->id,
        'edit_url' => route('rekaptest.edit', $rekaptest->id),
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
        return view('masterdata.rekaptest.tambah');
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
        'kematian' => 'required|numeric',
        'pakan' => 'required|numeric',
        'obat' => 'required|numeric',
        'bobot' => 'required|numeric',
        ]);

        // insert data ke database
        Rekaptest::create($request->all());
        Alert::success('Sukses', 'Berhasil Menambahkan Data Rekap Baru');
        return redirect()->route('rekaptest.index');
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
    public function edit(Rekaptest $rekaptest)
    {
        return view('masterdata.rekaptest.edit', compact('rekaptest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rekaptest $rekaptest)
    {
        $this->validate($request, [
        'tanggal' => 'required|date', // Validasi untuk tanggal
        'umur' => 'required|numeric',
        'kematian' => 'required|numeric',
        'pakan' => 'required|numeric',
        'obat' => 'required|numeric',
        'bobot' => 'required|numeric',
        ]);

        // insert data ke database
        $rekaptest->update($request->all());
        Alert::success('Sukses', 'Berhasil Mengupdate Data Rekap');
        return redirect()->route('rekaptest.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rekaptest $rekaptest)
    {
        $rekaptest->destroy($rekaptest->id);
        Alert::success('Sukses', 'Berhasil Menghapus Data Rekap ');
        return redirect()->route('rekaptest.index');
    }

    public function printPdf()
    {
        $rekaptest = Rekaptest::all();
        $pdf = PDF::loadView('masterdata.rekaptest._pdf', compact('rekaptest'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Data Rekap Harian.pdf', array("Attachment" => false));
    }
}
