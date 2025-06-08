<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use Illuminate\Http\Request;

class PembelianMobileController extends Controller
{
    public function getPembelianByPembeli($id)
    {
        $pembelian = Pembelian::with(['barangs', 'alamat'])
            ->where('ID_PEMBELI', $id)
            ->orderByDesc('TANGGAL_PEMBELIAN')
            ->get();

        return response()->json(['data' => $pembelian]);
    }
}
