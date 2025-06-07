<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokObat extends Model
{
    use HasFactory;


    protected $table = 'stok_obat';
    protected $fillable = [
        'tanggal',
        'jenis_obat',
        'stok_awal',
        'jumlah_obat',
        'harga_obat',
        'total_harga',
        'kandang_id',
        'created_id',
        'created_at',
        'updated_at',
    ];
    // public $timestamps = true;

    public function kandang()
    {
        return $this->belongsTo(kandang::class);
    }
}
