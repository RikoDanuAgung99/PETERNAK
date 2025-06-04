<?php

namespace App\Http\Controllers;

use App\Models\Kandang;
use App\Models\Panen;
use Illuminate\Http\Request;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;

class PanenController extends Controller
{
    public function index(Request $request)
    {
        $halaman = 10;
        $kandang = Kandang::all();
        $query = Panen::query()->orderBy('tanggal');

        if (auth()->user()->level === 'PETERNAK') {
            $query->where('kandang_id', auth()->user()->kandang_id);
        } elseif ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }

        $panen = $query->paginate($halaman);
        $data = compact('halaman', 'panen', 'kandang');

        return view('masterData.panen.index', $data);
    }

    public function create(Panen $panen)
    {
        $kandang = Kandang::all();
        return view('masterData.panen.tambah', compact('panen', 'kandang'));
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'tanggal' => 'required|date',
                'no_doc' => 'required|string|max:255',
                'jumlah_panen' => 'required|numeric',
                'tonase_panen' => 'required|numeric',
                'rata_rata' => 'required|numeric',
                'harga_kontrak' => 'required|numeric',
            ]);

            $data = [
                'tanggal' => $request->tanggal,
                'no_doc' => $request->no_doc,
                'jumlah_panen' => $request->jumlah_panen,
                'tonase_panen' => $request->tonase_panen,
                'rata_rata' => $request->rata_rata,
                'harga_kontrak' => $request->harga_kontrak,
                'total_harga' => $request->total_harga,
                'created_id' => auth()->id(),
                'kandang_id' => $request->kandang_id,
                'created_at' => now(),
                'updated_at' => null,
            ];

            Panen::create($data);
            Alert::success('Sukses', 'Berhasil Menambahkan Data Panen Baru');
            return redirect()->route('panen.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }


    public function show($id)
    {
        return view('panen.show', compact('id'));
    }

    public function edit($id)
    {
        $panen = Panen::findOrFail($id);
        $kandang = Kandang::all();
        return view('masterData.panen.edit', compact('panen', 'kandang'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tanggal' => 'required|date',
            'no_doc' => 'required|string|max:255',
            'jumlah_panen' => 'required|numeric',
            'tonase_panen' => 'required|numeric',
            'rata_rata' => 'required|numeric',
            'harga_kontrak' => 'required|numeric',
        ]);

        $panen = Panen::findOrFail($id);

        $panen->update([
            'tanggal' => $request->tanggal,
            'no_doc' => $request->no_doc,
            'jumlah_panen' => $request->jumlah_panen,
            'tonase_panen' => $request->tonase_panen,
            'rata_rata' => $request->rata_rata,
            'harga_kontrak' => $request->harga_kontrak,
            'total_harga' => $request->total_harga,
            'kandang_id' => $request->kandang_id,
            'updated_at' => now(),
        ]);

        Alert::success('Sukses', 'Berhasil Memperbarui Data Panen');
        return redirect()->route('panen.index')->with('success', 'Panen updated successfully.');
    }


    public function destroy($id)
    {
        // Logic to delete a specific panen
        // Panen::destroy($id);
        $panen = Panen::findOrFail($id);
        $panen->delete();
        Alert::success('Sukses', 'Berhasil Menghapus Data Panen');
        return redirect()->route('panen.index');
    }
    public function printPdf(Request $request)
    {
        $query = Panen::query()->orderBy('tanggal');

        if (auth()->user()->level === 'PETERNAK') {
            $query->where('kandang_id', auth()->user()->kandang_id);
        } elseif ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }

        $panen = $query->get();
        $data = compact('panen');

        $pdf = PDF::loadView('masterdata.panen._pdf', $data);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Data Panen.pdf', ["Attachment" => false]);
    }
}
