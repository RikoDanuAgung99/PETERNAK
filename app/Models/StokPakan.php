<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokPakan extends Model
{
    use HasFactory;

    protected $table = 'stok_pakan';
    protected $fillable = [
        'tanggal',
        'no_doc',
        'jenis_pakan',
        'jumlah_pakan',
        'stok_pakan',
        'harga_pakan',
        'total_harga',
        'kandang_id',
        'created_id',
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        // 'tanggal' => 'date',
        'jumlah_pakan' => 'integer',
        'harga_pakan' => 'decimal:2',
        'total_harga' => 'decimal:2',
    ];
    protected $primaryKey = 'id';
    // public $timestamps = TRUE;

    public function kandang()
    {
        return $this->belongsTo(kandang::class);
    }
}
