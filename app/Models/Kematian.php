<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kematian extends Model
{
    use HasFactory;

    protected $table = 'kematian'; // Pastikan sesuai dengan tabel di database
    protected $fillable = ['tanggal','umur', 'kematian', 'std_kematian']; // Pastikan kolom sesuai
    public $timestamps = false;
}
