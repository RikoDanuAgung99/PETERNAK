<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bedah;
use App\Models\Kandang;
use DataTables;
use Session;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;
use Illuminate\Support\Facades\Storage;
use Svg\Tag\Rect;

class BedahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Bedah $bedah)
    {
        // dd($bedah);
        $kandang = Kandang::all();
        return view('masterdata.bedah.index', compact('bedah', 'kandang'));
    }
    public function getBedah(Request $request)
    {
        $query = Bedah::query();

        if (auth()->user()->level === 'PETERNAK') {
            $query->where('kandang_id', auth()->user()->kandang_id);
        } elseif ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }
        return DataTables::of($query)
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
        try {
            if ($request->hasFile('images')) {
                $image = $request->file('images');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/bedah', $imageName);
            } else {
                $imageName = null;
            }

            Bedah::create([
                'tanggal' => $request->tanggal,
                'umur' => $request->umur,
                'gejala' => $request->gejala,
                'diagnosis' => $request->diagnosis,
                'images' => $imageName,
                'created_id' => auth()->user()->id,
                'kandang_id' => auth()->user()->kandang_id,
                'created_at' => now(),
                'updated_at' => null,
            ]);

            Alert::success('Sukses', 'Berhasil Menambahkan Data Bedah Baru');
            return redirect()->route('bedah.index');
        } catch (\Exception $e) {
            return back()->with('error', 'Upload gagal: ' . $e->getMessage());
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
    public function edit(Bedah $bedah)
    {
        return view('masterdata.bedah.edit', compact('bedah'));
    }

    public function update(Request $request, Bedah $bedah)
    {
        $this->validate($request, [
            'tanggal' => 'required|date',
            'umur' => 'required|numeric',
            'gejala' => 'required',
            'diagnosis' => 'required',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'updated_at' => now(),
        ]);

        try {
            $data = $request->only(['tanggal', 'umur', 'gejala', 'diagnosis']);

            if ($request->hasFile('images')) {
                if ($bedah->images && Storage::exists('public/bedah/' . $bedah->images)) {
                    Storage::delete('public/bedah/' . $bedah->images);
                }

                $image = $request->file('images');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/bedah', $imageName);
                $data['images'] = $imageName;
            }

            $bedah->update($data);

            Alert::success('Sukses', 'Berhasil Mengupdate Data Bedah');
            return redirect()->route('bedah.index');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengupdate data.'])->withInput();
        }
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

    public function printPdf(Request $request)
    {
        $query = Bedah::query();

        if (auth()->user()->level === 'PETERNAK') {
            $query->where('kandang_id', auth()->user()->kandang_id);
        } elseif ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }

        $bedah = $query->get();
        $pdf = PDF::loadView('masterdata.bedah._pdf', compact('bedah'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Data Bedah.pdf', array("Attachment" => false));
    }
}
