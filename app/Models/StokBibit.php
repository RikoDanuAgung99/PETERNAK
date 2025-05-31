<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBibit extends Model
{
    use HasFactory;

    protected $table = 'stok_bibit';
    protected $fillable = [
        'tanggal',
        'no_doc',
        'jenis_bibit',
        'jumlah_bibit',
        'harga_bibit',
        'total_harga',
    ];
       protected $casts = [
        // 'tanggal' => 'date',
        'jumlah_bibit' => 'integer',
        'harga_bibit' => 'decimal:2',
        'total_harga' => 'decimal:2',
    ];
    protected $primaryKey = 'id';
    public $timestamps = TRUE;
}
