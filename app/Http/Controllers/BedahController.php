<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bedah;
use DataTables;
use Session;
use Alert;
use PDF;

class BedahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Bedah $bedah)
    {
        return view('masterdata.bedah.index', compact('bedah'));
    }

    public function getBedah(Request $request)
    {
        if ($request->ajax()) {
        $bedah = Bedah::all();
        return DataTables::of($bedah)
        ->editColumn('aksi', function ($bedah) {
        return view('partials._action_bedah', [
        'model' => $bedah,
        'form_url' => $bedah->id,
        'edit_url' => route('bedah.edit', $bedah->id),
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
        return view('masterdata.bedah.tambah');
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
        'gejala' => 'required',
        'diagnosis' => 'required',
        ]);

        // insert data ke database
        Bedah::create($request->all());
        Alert::success('Sukses', 'Berhasil Menambahkan Data Bedah Baru');
        return redirect()->route('bedah.index');
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
    public function edit(Bedah $bedah)
    {
        return view('masterdata.bedah.edit', compact('bedah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bedah $bedah)
    {
        $this->validate($request, [
        'tanggal' => 'required|date',
        'umur' => 'required|numeric',
        'gejala' => 'required',
        'diagnosis' => 'required',
        ]);

        // insert data ke database
        $bedah->update($request->all());
        Alert::success('Sukses', 'Berhasil Mengupdate Data Bedah');
        return redirect()->route('bedah.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bedah $bedah)
    {
          $bedah->destroy($bedah->id);
        Alert::success('Sukses', 'Berhasil Menghapus Bedah ');
        return redirect()->route('bedah.index');
    }

    public function printPdf()
    {
        $bedah = Bedah::all();
        $pdf = PDF::loadView('masterdata.bedah._pdf', compact('bedah'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Data Bedah.pdf', array("Attachment" => false));
    }
}
