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
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Show the form for creating a new resource.
     */
    public function create(Pakan $pakan)
    {
         return view('masterdata.pakan.tambah', compact('pakan'));
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
        Pakan::create($request->all());
        Alert::success('Sukses', 'Berhasil Menambahkan Data Penggunaan Pakan Baru');
        return redirect()->route('pakan.index');
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
    public function edit(Pakan $pakan)
    {
        return view('masterdata.pakan.edit', compact('pakan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pakan $pakan)
    {
         $this->validate($request, [
        'tanggal' => 'required|date',
        'umur' => 'required|numeric',
        'nama' => 'required', 
        'jenis' => 'required',
        'jumlah' => 'required|numeric',
    ]);

    // Update data pada objek yang sudah ditemukan
    $pakan->update([
        'nama' => $request->nama, // Pastikan sesuai dengan ENUM
        'jenis' => $request->jenis, // Pastikan sesuai dengan ENUM
        'tanggal' => $request->tanggal,
        'umur' => $request->umur,
        'jumlah' => $request->jumlah,
    ]);

    Alert::success('Sukses', 'Berhasil Mengupdate Data Penggunaan Pakan Baru');
    return redirect()->route('pakan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
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
