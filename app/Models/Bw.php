<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bw extends Model
{
    use HasFactory;

    protected $table = 'bw'; // Pastikan sesuai dengan tabel di database
    protected $fillable = ['tanggal','umur','bw_act','bw_std','dif_bw']; // Pastikan kolom sesuai
    public $timestamps = false;

}
