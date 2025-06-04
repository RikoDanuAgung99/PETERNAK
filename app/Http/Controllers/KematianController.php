<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kematian;
use DataTables;
use Session;
use Alert;
use App\Models\Kandang;
use PDF;

class KematianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Kematian $kematian)
    {
        $kandang = Kandang::all();
        return view('masterdata.kematian.index', compact('kematian', 'kandang'));
    }

    public function getKematian(Request $request)
    {
        $query = Kematian::query();

        if (auth()->user()->level === 'PETERNAK') {
            $query->where('kandang_id', auth()->user()->kandang_id);
        } elseif ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }


        return DataTables::of($query)
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
        try {
            // Validasi inputan (hapus created_at dan updated_at dari validasi)
            $this->validate($request, [
                'tanggal' => 'required|date',
                'umur' => 'required|numeric',
                'kematian' => 'required|numeric',
                'std_kematian' => 'required|numeric',
                'keterangan' => 'required|string|max:255',
            ]);

            // Buat data untuk disimpan
            $data = [
                'tanggal' => $request->tanggal,
                'umur' => $request->umur,
                'kematian' => $request->kematian,
                'std_kematian' => $request->std_kematian,
                'keterangan' => $request->keterangan,
                'created_id' => auth()->id(),
                'kandang_id' => auth()->user()->kandang_id,
                'created_at' => now(),
                'updated_at' => null,
            ];

            Kematian::create($data);

            Alert::success('Sukses', 'Berhasil Menambahkan Data Kematian Baru');
            return redirect()->route('kematian.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
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
        try {
            $this->validate($request, [
                'tanggal' => 'required|date',
                'umur' => 'required|numeric',
                'kematian' => 'required|numeric',
                'std_kematian' => 'required|numeric',
                'keterangan' => 'required|string|max:255',
            ]);

            $data = [
                'tanggal' => $request->tanggal,
                'umur' => $request->umur,
                'kematian' => $request->kematian,
                'std_kematian' => $request->std_kematian,
                'keterangan' => $request->keterangan,
                'updated_at' => now(),
            ];

            // Update data di database
            $kematian->update($data);

            Alert::success('Sukses', 'Berhasil Mengupdate Data Kematian');
            return redirect()->route('kematian.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
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

    public function printPdf(Request $request)
    {
        $query = Kematian::query();

        if (auth()->user()->level === 'PETERNAK') {
            $query->where('kandang_id', auth()->user()->kandang_id);
        } elseif ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }

        $kematian = $query->get();

        $pdf = PDF::loadView('masterdata.kematian._pdf', compact('kematian'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Data Kematian Harian.pdf', ["Attachment" => false]);
    }
}
