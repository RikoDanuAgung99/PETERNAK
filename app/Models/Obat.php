<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obat'; // Pastikan sesuai dengan tabel di database
    protected $fillable = ['tanggal','umur', 'nama', 'jenis', 'jumlah']; // Pastikan kolom sesuai
    public $timestamps = false;
}

