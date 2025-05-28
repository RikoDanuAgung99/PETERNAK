<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bedah extends Model
{
    use HasFactory;

    protected $table = 'bedah'; // Pastikan sesuai dengan tabel di database
    protected $fillable = ['tanggal','umur', 'gejala', 'diagnosis']; // Pastikan kolom sesuai
    public $timestamps = false;
}
