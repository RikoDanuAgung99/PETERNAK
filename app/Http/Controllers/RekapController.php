<?php

namespace App\Http\Controllers;

use App\Models\Kematian;
use App\Models\Pakan;
use PDF;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    public function index() {
        $halaman = 5;
        $range = request()->get('r');
        $rekap = Pakan::select(
            'pakan.id',
            'pakan.tanggal',
            'pakan.umur',
            'pakan.jenis',
            'pakan.jumlah',
            'kematian.id',
            'kematian.kematian',
            'obat.jumlah as  jumlahObat',   
            'bw.bw_act'
        )
            ->leftJoin('kematian', function($join) {
                $join->on('kematian.tanggal', '=', 'pakan.tanggal'); 
            })
            ->leftJoin('obat', function($join) {
                $join->on('obat.tanggal', '=', 'pakan.tanggal'); 
            })
            ->leftJoin('bw', function($join) {
                $join->on('bw.tanggal', '=', 'pakan.tanggal'); 
            })
            ->paginate($halaman);
        // dd($rekap);
        $data = compact('halaman', 'rekap', 'range');
        return view('masterdata.rekap.index', $data);
    }

    public function printPdf()
    {
        $rekap = Pakan::select(
            'pakan.id',
            'pakan.tanggal',
            'pakan.umur',
            'pakan.jenis',
            'pakan.jumlah',
            'kematian.id',
            'kematian.kematian',
            'obat.jumlah as  jumlahObat',   
            'bw.bw_act'
        )
            ->leftJoin('kematian', function($join) {
                $join->on('kematian.tanggal', '=', 'pakan.tanggal'); 
            })
            ->leftJoin('obat', function($join) {
                $join->on('obat.tanggal', '=', 'pakan.tanggal'); 
            })
            ->leftJoin('bw', function($join) {
                $join->on('bw.tanggal', '=', 'pakan.tanggal'); 
            })->get();
        $data = compact('rekap');
        $pdf = PDF::loadView('masterdata.rekap._pdf', $data);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Data Rekap Harian.pdf', array("Attachment" => false));
    }
}
