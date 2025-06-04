<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bedah extends Model
{
    use HasFactory;

    protected $table = 'bedah'; // Pastikan sesuai dengan tabel di database
    protected $fillable = ['tanggal', 'umur', 'gejala', 'diagnosis', 'images', 'kandang_id', 'created_id', 'created_at', 'updated_at']; // Pastikan kolom sesuai

    // public $timestamps = false;

    public function kandang()
    {
        return $this->belongsTo(kandang::class);
    }
}
