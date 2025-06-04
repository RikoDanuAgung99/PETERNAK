<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use DataTables;
use Session;
use Alert;
use App\Models\Kandang;
use PDF;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Obat $obat)
    {
        $kandang = Kandang::all();

        return view('masterdata.obat.index', compact('obat', 'kandang'));
    }

    public function getObat(Request $request)
    {
        $query = Obat::query();

        if (auth()->user()->level === 'PETERNAK') {
            $query->where('kandang_id', auth()->user()->kandang_id);
        } elseif ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }
        return DataTables::of($query)
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


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('masterdata.obat.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'tanggal' => 'required|date',
                'umur' => 'required|numeric',
                'nama' => 'required|string|max:255',
                'jenis' => 'required|string|max:255',
                'jumlah' => 'required|numeric',
            ]);

            $data = [
                'tanggal' => $request->tanggal,
                'umur' => $request->umur,
                'nama' => $request->nama,
                'jenis' => $request->jenis,
                'jumlah' => $request->jumlah,
                'created_id' => auth()->id(),
                'kandang_id' => auth()->user()->kandang_id,
                'created_at' => now(),
                'updated_at' => null,
            ];

            Obat::create($data);

            Alert::success('Sukses', 'Berhasil Menambahkan Data Penggunaan Obat Baru');
            return redirect()->route('obat.index');
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
    public function edit(Obat $obat)
    {
        return view('masterdata.obat.edit', compact('obat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Obat $obat)
    {
        try {
            $this->validate($request, [
                'tanggal' => 'required|date',
                'umur' => 'required|numeric',
                'nama' => 'required|string|max:255',
                'jenis' => 'required|string|max:255',
                'jumlah' => 'required|numeric',
            ]);

            $data = [
                'tanggal' => $request->tanggal,
                'umur' => $request->umur,
                'nama' => $request->nama,
                'jenis' => $request->jenis,
                'jumlah' => $request->jumlah,
                'updated_at' => now(),
            ];

            $obat->update($data);

            Alert::success('Sukses', 'Berhasil Mengupdate Data Penggunaan Obat');
            return redirect()->route('obat.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
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

    public function printPdf(Request $request)
    {
        $query = Obat::query();

        if (auth()->user()->level === 'PETERNAK') {
            $query->where('kandang_id', auth()->user()->kandang_id);
        } elseif ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }

        $obat = $query->get();
        $pdf = PDF::loadView('masterdata.obat._pdf', compact('obat'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Data Obat Harian.pdf', array("Attachment" => false));
    }
}
