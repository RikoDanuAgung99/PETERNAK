<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokObat extends Model
{
    use HasFactory;

    
    protected $table = 'stok_obat'; 
    protected $fillable = ['tanggal', 'jenis_obat', 'stok_awal', 'jumlah']; 
    public $timestamps = true;
}
