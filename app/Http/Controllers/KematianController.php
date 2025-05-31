<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Kematian;
use DataTables;
use Session;
use Alert;
use PDF;

class KematianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Kematian $kematian)
    {
        return view('masterdata.kematian.index', compact('kematian')); 
    }

    public function getKematian(Request $request)
    {
        if ($request->ajax()) {
        $kematian = Kematian::all();
        return DataTables::of($kematian)
        ->editColumn('aksi', function ($kematian) {
        return view('partials._action', [
        'model' => $kematian,
        'form_url' => $kematian->id,
        'edit_url' => route('kematian.edit', $kematian->id),
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
        return view('masterdata.kematian.tambah');
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
        'std_kematian' => 'required|numeric',
        'keterangan' => 'required|string|max:255',
        ]);

        // insert data ke database
        Kematian::create($request->all());
        Alert::success('Sukses', 'Berhasil Menambahkan Data Kematian Baru');
        return redirect()->route('kematian.index');
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
    public function edit(Kematian $kematian)
    {
        return view('masterdata.kematian.edit', compact('kematian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kematian $kematian)
    {
        $this->validate($request, [
        'tanggal' => 'required|date',
        'umur' => 'required|numeric',
        'kematian' => 'required|numeric',
        'std_kematian' => 'required|numeric',
        'keterangan' => 'required|string|max:255',
        ]);

        // insert data ke database
        $kematian->update($request->all());
        Alert::success('Sukses', 'Berhasil Mengupdate Data Kematian');
        return redirect()->route('kematian.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kematian $kematian)
    {
        $kematian->destroy($kematian->id);
        Alert::success('Sukses', 'Berhasil Menghapus Kematian ');
        return redirect()->route('kematian.index');
    }

    public function printPdf()
    {
        $kematian = Kematian::all();
        $pdf = PDF::loadView('masterdata.kematian._pdf', compact('kematian'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Data Kematian Harian.pdf', array("Attachment" => false));
    }
}
