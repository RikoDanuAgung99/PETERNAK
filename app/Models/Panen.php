<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panen extends Model
{
    use HasFactory;

    protected $table = 'panen';
    protected $fillable = [
        'tanggal',
        'no_doc',
        'jumlah_panen',
        'tonase_panen',
        'rata_rata',
        'harga_kontrak',
        'total_harga',
        'kandang_id',
        'created_id',
        'created_at',
        'updated_at',
    ];

    // public $timestamps = TRUE;

    public function kandang()
    {
        return $this->belongsTo(kandang::class);
    }
}
