<?php

namespace App\Http\Controllers;

use App\Models\Kandang;
use App\Models\Kematian;
use App\Models\Pakan;
use DataTables;
use PDF;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        // $halaman = 10;
        $range = request()->get('r');

        $query = Pakan::select(
            'pakan.id',
            'pakan.tanggal',
            'pakan.umur',
            'pakan.jenis',
            'pakan.jumlah',
            'kematian.id',
            'kematian.kematian',
            'obat.jumlah as jumlahObat',
            'bw.bw_act',
            'bw.keterangan'
        )
            ->leftJoin('kematian', function ($join) {
                $join->on('kematian.tanggal', '=', 'pakan.tanggal');
            })
            ->leftJoin('obat', function ($join) {
                $join->on('obat.tanggal', '=', 'pakan.tanggal');
            })
            ->leftJoin('bw', function ($join) {
                $join->on('bw.tanggal', '=', 'pakan.tanggal');
            });

        if (auth()->user()->level === 'PETERNAK') {
            $query->where('pakan.kandang_id', auth()->user()->kandang_id);
        } elseif ($request->filled('kandang_id')) {
            $query->where('pakan.kandang_id', $request->kandang_id);
        }

        $rekap = $query->paginate();
        $kandang = Kandang::all();
        $data = compact('rekap', 'range', 'kandang');
        return view('masterdata.rekap.index', $data);
    }
    public function printPdf(Request $request)
    {
        $query = Pakan::select(
            'pakan.id',
            'pakan.tanggal',
            'pakan.umur',
            'pakan.jenis',
            'pakan.jumlah',
            'kematian.id',
            'kematian.kematian',
            'obat.jumlah as jumlahObat',
            'bw.bw_act',
            'bw.keterangan'
        )
            ->leftJoin('kematian', function ($join) {
                $join->on('kematian.tanggal', '=', 'pakan.tanggal');
            })
            ->leftJoin('obat', function ($join) {
                $join->on('obat.tanggal', '=', 'pakan.tanggal');
            })
            ->leftJoin('bw', function ($join) {
                $join->on('bw.tanggal', '=', 'pakan.tanggal');
            });

        if (auth()->user()->level === 'PETERNAK') {
            $query->where('pakan.kandang_id', auth()->user()->kandang_id);
        } elseif ($request->filled('kandang_id')) {
            $query->where('pakan.kandang_id', $request->kandang_id);
        }

        $rekap = $query->get();

        $data = compact('rekap');
        $pdf = PDF::loadView('masterdata.rekap._pdf', $data);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Data Rekap Harian.pdf', array("Attachment" => false));
    }
}
