<?php

namespace App\Http\Controllers;

use App\Models\HargaKontrak;
use Illuminate\Http\Request;

class HargaKontrakController extends Controller
{
    public function getHargaByRata($rata)
{
    $rata = min(floatval(str_replace(',', '.', $rata)), 2); // jika >2, tetap dianggap 2
    $harga = HargaKontrak::where('min_rata', '<=', $rata)
                         ->where('max_rata', '>=', $rata)
                         ->value('harga');

    return response()->json(['harga' => $harga ?? 0]);
}
}
