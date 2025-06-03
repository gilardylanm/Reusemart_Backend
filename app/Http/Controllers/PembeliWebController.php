<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembeli;
use App\Models\Alamat;
use App\Models\Barang;
use Illuminate\Support\Facades\Hash;
use Exception;

class PembeliWebController extends Controller
{
    public function mainPage()
    {
        $products = Barang::all(); // atau bisa disesuaikan dengan relasi kategori
        return view('halamanPembeli', compact('products'));
    }

    public function index()
    {
        $pembeliId = session('user_id');

        if (!$pembeliId) {
            return redirect('/login')->with('error', 'Silakan login sebagai pembeli terlebih dahulu.');
        }

        // Ambil data pembeli dari database
        
        
        $pembeli = Pembeli::find($pembeliId);
        $alamatList = Alamat::where('ID_PEMBELI', $pembeliId)->get();
        return view('ProfilPembeli', compact('pembeli', 'alamatList'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'NAMA_PEMBELI' => 'required|string|max:255',
                'EMAIL_PEMBELI' => 'required|email|unique:pembeli,EMAIL_PEMBELI',
                'PASSWORD_PEMBELI' => 'required|string|min:6',
                'NOMOR_TELEPON' => 'required|string|max:20',
            ]);

            $pembeli = Pembeli::create([
                'NAMA_PEMBELI' => $request->NAMA_PEMBELI,
                'EMAIL_PEMBELI' => $request->EMAIL_PEMBELI,
                'PASSWORD_PEMBELI' => Hash::make($request->PASSWORD_PEMBELI),
                'NOMOR_TELEPON' => $request->NOMOR_TELEPON,
                'POIN_PEMBELI' => 0,
            ]);

            return redirect('/login')->with('success', 'Pembeli berhasil ditambahkan. Silakan login.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
