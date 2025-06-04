<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bw;
use DataTables;
use Session;
use Alert;
use App\Models\Kandang;
use PDF;

class BwController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Bw $bw)
    {

        $kandang = Kandang::all();
        return view('masterdata.bw.index', compact('bw', 'kandang'));
    }

    public function getBw(Request $request)
    {
        $query = Bw::query();

        if (auth()->user()->level === 'PETERNAK') {
            $query->where('kandang_id', auth()->user()->kandang_id);
        } elseif ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }

        return DataTables::of($query)
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
        try {
            $this->validate($request, [
                'tanggal' => 'required|date',
                'umur' => 'required|numeric',
                'bw_act' => 'required|numeric',
                'bw_std' => 'required|numeric',
                'dif_bw' => 'required|numeric',
                'keterangan' => 'nullable|string|max:255',
            ]);

            $data = [
                'tanggal' => $request->tanggal,
                'umur' => $request->umur,
                'bw_act' => $request->bw_act,
                'bw_std' => $request->bw_std,
                'dif_bw' => $request->dif_bw,
                'keterangan' => $request->keterangan,
                'created_id' => auth()->id(),
                'kandang_id' => auth()->user()->kandang_id,
                'created_at' => now(),
                'updated_at' => null,
            ];

            Bw::create($data);

            Alert::success('Sukses', 'Berhasil Menambahkan Data BW Baru');
            return redirect()->route('bw.index');
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
    public function edit(Bw $bw)
    {
        return view('masterdata.bw.edit', compact('bw'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bw $bw)
    {
        try {
            $this->validate($request, [
                'tanggal' => 'required|date',
                'umur' => 'required|numeric',
                'bw_act' => 'required|numeric',
                'bw_std' => 'required|numeric',
                'dif_bw' => 'required|numeric',
                'keterangan' => 'nullable|string|max:255',
            ]);

            $data = [
                'tanggal' => $request->tanggal,
                'umur' => $request->umur,
                'bw_act' => $request->bw_act,
                'bw_std' => $request->bw_std,
                'dif_bw' => $request->dif_bw,
                'keterangan' => $request->keterangan,
                'updated_at' => now(),
            ];

            $bw->update($data);

            Alert::success('Sukses', 'Berhasil Mengupdate Data BW');
            return redirect()->route('bw.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
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

    public function printPdf(Request $request)
    {
        $query = Bw::query();

        if (auth()->user()->level === 'PETERNAK') {
            $query->where('kandang_id', auth()->user()->kandang_id);
        } elseif ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }

        $bw = $query->get();
        $pdf = PDF::loadView('masterdata.bw._pdf', compact('bw'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Data BW Harian.pdf', array("Attachment" => false));
    }
}
