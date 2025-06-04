<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kandang extends Model
{
    use HasFactory;
    protected $table = 'kandang'; // Pastikan sesuai dengan tabel di database
    protected $fillable = ['nama']; // Pastikan kolom sesuai
}
