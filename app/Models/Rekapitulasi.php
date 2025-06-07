<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekapitulasi extends Model
{
    use HasFactory;
    protected $table = 'rekapitulasi';

    protected $fillable = [
        'tanggal_start',
        'tanggal_end',
        'jml_bibit',
        'jml_kematian',
        'sisa_ayam',
        'deplesi',
        'std_deplesi',
        'diff_deplesi',
        'total_panen',
        'tonase_panen',
        'rata_rata',
        'pakan',
        'std_pakan',
        'diff_pakan',
        'fcr',
        'std_fcr',
        'diff_fcr',

        'total_jumlah_bibit',
        'harga_bibit_avg',
        'total_harga_bibit',
        'total_jumlah_pakan',
        'harga_pakan_avg',
        'total_harga_pakan',
        'total_jumlah_obat',
        'harga_obat_avg',
        'total_harga_obat',
        'total_jumlah_panen',
        'total_tonase_panen',
        'rata_rata_avg',
        'harga_kontrak_avg',
        'total_harga_panen',

        'penjualan',
        'pembelian',
        'keuntungan_kerugian',
        
        'kandang_id',
        'created_id',
        'created_at',
        'updated_at',
    ];

    public function kandang()
    {
        return $this->belongsTo(Kandang::class);
    }
}
