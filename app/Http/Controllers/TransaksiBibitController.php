<?php

namespace App\Http\Controllers;

use App\Models\Kandang;
use App\Models\stokBibit;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class TransaksiBibitController extends Controller
{
    public function index(Request $request)
    {
        $halaman = 10;
        $kandang = Kandang::all();
        $query = stokBibit::query()->orderBy('tanggal');

        if (auth()->user()->level === 'PETERNAK') {
            $query->where('kandang_id', auth()->user()->kandang_id);
        } elseif ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }

        $listBibit = $query->paginate($halaman);
        $data = compact('listBibit', 'halaman', 'kandang');

        return view('masterData.transaksiBibit.index', $data);
    }

    public function create(stokBibit $bibit)
    {
        $kandang = Kandang::all();
        return view('masterData.transaksiBibit.tambah', compact('bibit', 'kandang'));
    }
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'tanggal' => 'required|date',
                'no_doc' => 'required|string|max:255',
                'jenis_bibit' => 'required|string|max:255',
                'jumlah_bibit' => 'required|numeric',
                'harga_bibit' => 'required|numeric',
            ]);

            $data = [
                'tanggal' => $request->tanggal,
                'no_doc' => $request->no_doc,
                'jenis_bibit' => $request->jenis_bibit,
                'jumlah_bibit' => $request->jumlah_bibit,
                'harga_bibit' => $request->harga_bibit,
                'total_harga' => $request->jumlah_bibit * $request->harga_bibit,
                'created_id' => auth()->id(),
                'kandang_id' => $request->kandang_id,
                'created_at' => now(),
                'updated_at' => null,
            ];

            stokBibit::create($data);

            Alert::success('Sukses', 'Berhasil Menambahkan Data Bibit Baru');
            return redirect()->route('transaksiBibit.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $pakan = stokBibit::findOrFail($id);
        return view('masterData.transaksiBibot.show', compact('pakan'));
    }
    public function edit($id)
    {
        $bibit = stokBibit::findOrFail($id);
        $kandang = Kandang::all();
        return view('masterData.transaksiBibit.edit', compact('bibit', 'kandang'));
    }
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'tanggal' => 'required|date',
                'no_doc' => 'required|string|max:255',
                'jenis_bibit' => 'required|string|max:255',
                'jumlah_bibit' => 'required|numeric',
                'harga_bibit' => 'required|numeric',
            ]);

            $data = [
                'tanggal' => $request->tanggal,
                'no_doc' => $request->no_doc,
                'jenis_bibit' => $request->jenis_bibit,
                'jumlah_bibit' => $request->jumlah_bibit,
                'harga_bibit' => $request->harga_bibit,
                'total_harga' => $request->jumlah_bibit * $request->harga_bibit,
                'kandang_id' => $request->kandang_id,
                'updated_at' => now(),
            ];

            $stokBibit = stokBibit::findOrFail($id);
            $stokBibit->update($data);

            Alert::success('Sukses', 'Berhasil Memperbarui Data Bibit');
            return redirect()->route('transaksiBibit.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        $bibit = stokBibit::findOrFail($id);
        $bibit->delete();
        Alert::success('Sukses', 'Berhasil Menghapus Data Bibit');
        return redirect()->route('transaksiBibit.index');
    }
    public function cetak()
    {
        $listBibit = stokBibit::orderBy('tanggal')->get();
        return view('masterData.transaksiBibit.cetak', compact('listBibit'));
    }
    public function printPdf(Request $request)
    {
        $query = stokBibit::query()->orderBy('tanggal');

        if (auth()->user()->level === 'PETERNAK') {
            $query->where('kandang_id', auth()->user()->kandang_id);
        } elseif ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }

        $bibit = $query->get();

        $pdf = PDF::loadView('masterdata.transaksiBibit._pdf', compact('bibit'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Data Transaksi Bibit.pdf', array("Attachment" => false));
    }
}
