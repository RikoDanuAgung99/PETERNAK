<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Obat;
use DataTables;
use Session;
use Alert;
use PDF;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Obat $obat)
    {
        return view('masterdata.obat.index');
    }

     public function getObat(Request $request)
    {
        if ($request->ajax()) {
        $obat = Obat::all();
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

    /**
     * Show the form for creating a new resource.
     */
    public function create(Obat $obat)
    {
        return view('masterdata.obat.tambah', compact('obat'));
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
        'nama' => 'required',
        'jenis' => 'required',
        'jumlah' => 'required|numeric',
        ]);

        // insert data ke database
        Obat::create($request->all());
        Alert::success('Sukses', 'Berhasil Menambahkan Data Penggunaan Obat Baru');
        return redirect()->route('obat.index');
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
    public function edit(Obat $obat)
    {
        return view('masterdata.obat.edit', compact('obat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Obat $obat)
    {
         $this->validate($request, [
        'tanggal' => 'required|date',
        'umur' => 'required|numeric',
        'nama' => 'required', 
        'jenis' => 'required',
        'jumlah' => 'required|numeric',
    ]);

    // Update data pada objek yang sudah ditemukan
    $obat->update([
        'nama' => $request->nama, // Pastikan sesuai dengan ENUM
        'jenis' => $request->jenis, // Pastikan sesuai dengan ENUM
        'tanggal' => $request->tanggal,
        'umur' => $request->umur,
        'jumlah' => $request->jumlah,
    ]);

    Alert::success('Sukses', 'Berhasil Mengupdate Data Penggunaan Obat Baru');
    return redirect()->route('obat.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Obat $obat)
    {
        $obat->destroy($obat->id);
        Alert::success('Sukses', 'Berhasil Menghapus Data Obat ');
        return redirect()->route('obat.index');
    }

     public function printPdf()
    {
        $obat = Obat::all();
        $pdf = PDF::loadView('masterdata.obat._pdf', compact('obat'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Data Obat Harian.pdf', array("Attachment" => false));
    }
}
