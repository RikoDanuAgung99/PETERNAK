<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekaptest extends Model
{
    use HasFactory;

     protected $table = 'rekaptest'; // Pastikan sesuai dengan tabel di database
    protected $fillable = ['tanggal','umur', 'kematian', 'pakan', 'obat', 'bobot']; // Pastikan kolom sesuai
    public $timestamps = false;
}
