<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaKontrak extends Model
{
    use HasFactory;
    protected $table = 'harga_kontrak';
    protected $fillable = [
        'berat',
        'harga',];
}
