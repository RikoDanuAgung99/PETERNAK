<?php

namespace App\Http\Controllers;

use App\Models\Kandang;
use App\Models\StokPakan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class TransaksiPakanController extends Controller
{

    public function index(Request $request)
    {
        $halaman = 10;
        $kandang = Kandang::all();

        $query = StokPakan::orderBy('tanggal');

        if (auth()->user()->level === 'PETERNAK') {
            $query->where('kandang_id', auth()->user()->kandang_id);
        } elseif ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }

        $listPakan = $query->paginate($halaman);

        $data = compact('listPakan', 'halaman', 'kandang');
        return view('masterData.transaksiPakan.index', $data);
    }


    public function create(StokPakan $pakan)
    {
        $kandang = Kandang::all();
        return view('masterData.transaksiPakan.tambah', compact('pakan', 'kandang'));
    }


    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'tanggal' => 'required|date',
                'no_doc' => 'required|string|max:255',
                'jenis_pakan' => 'required|string|max:255',
                'jumlah_pakan' => 'required|numeric',
                'harga_pakan' => 'required|numeric',
            ]);

            $data = [
                'tanggal' => $request->tanggal,
                'no_doc' => $request->no_doc,
                'jenis_pakan' => $request->jenis_pakan,
                'jumlah_pakan' => $request->jumlah_pakan,
                'harga_pakan' => $request->harga_pakan,
                'total_harga' => $request->jumlah_pakan * $request->harga_pakan,
                'created_id' => auth()->id(),
                'kandang_id' => $request->kandang_id,
                'created_at' => now(),
                'updated_at' => null,
            ];

            StokPakan::create($data);

            Alert::success('Sukses', 'Berhasil Menambahkan Data Pakan Baru');
            return redirect()->route('transaksiPakan.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }



    public function show($id)
    {
        $pakan = StokPakan::findOrFail($id);
        return view('masterData.transaksiPakan.show', compact('pakan'));
    }

    public function edit($id)
    {
        $pakan = StokPakan::findOrFail($id);
        $kandang = Kandang::all();
        return view('masterData.transaksiPakan.edit', compact('pakan', 'kandang'));
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'tanggal' => 'required|date',
                'no_doc' => 'required|string|max:255',
                'jenis_pakan' => 'required|string|max:255',
                'jumlah_pakan' => 'required|numeric',
                'harga_pakan' => 'required|numeric',
            ]);

            $data = [
                'tanggal' => $request->tanggal,
                'no_doc' => $request->no_doc,
                'jenis_pakan' => $request->jenis_pakan,
                'jumlah_pakan' => $request->jumlah_pakan,
                'harga_pakan' => $request->harga_pakan,
                'total_harga' => $request->jumlah_pakan * $request->harga_pakan,
                'kandang_id' => $request->kandang_id,
                'updated_at' => now(),
            ];

            $pakan = StokPakan::findOrFail($id);
            $pakan->update($data);

            Alert::success('Sukses', 'Data Pakan Berhasil Diperbarui');
            return redirect()->route('transaksiPakan.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }



    public function destroy($id)
    {
        $pakan = StokPakan::findOrFail($id);
        $pakan->delete();
        Alert::success('Sukses', 'Berhasil Menghapus Data Pakan');
        return redirect()->route('transaksiPakan.index');
    }

    public function printPdf(Request $request)
    {
        $query = StokPakan::query();

        if (auth()->user()->level === 'PETERNAK') {
            $query->where('kandang_id', auth()->user()->kandang_id);
        } elseif ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }

        $pakan = $query->orderBy('tanggal')->get();

        $pdf = PDF::loadView('masterdata.transaksiPakan._pdf', compact('pakan'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Data Transaksi Pakan.pdf', ["Attachment" => false]);
    }
}
