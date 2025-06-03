<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Pembeli;
use App\Models\Penitip;
use App\Models\Organisasi;
use App\Models\Request_Donasi;
use App\Models\Jabatan;
use App\Models\Pegawai;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $email = $request->email;
        $password = $request->password;

        // Cek di tabel pembeli
        $pembeli = Pembeli::where('EMAIL_PEMBELI', $email)->first();
        if ($pembeli && Hash::check($password, $pembeli->PASSWORD_PEMBELI)) {
            // Simpan data ke session atau pakai Auth guard jika sudah setup
            session(['user_type' => 'pembeli', 'user_id' => $pembeli->ID_PEMBELI]);
            session()->save();
            return redirect()->route('halamanPembeli');
        }

        // Cek di tabel penitip
        $penitip = Penitip::where('EMAIL_PENITIP', $email)->first();
        if ($penitip && Hash::check($password, $penitip->PASSWORD_PENITIP)) {
            session(['user_type' => 'penitip', 'user_id' => $penitip->ID_PENITIP]);
            return redirect()->route('halamanPenitip');
        }

        // Cek di tabel organisasi
        $organisasi = Organisasi::where('EMAIL_ORGANISASI', $email)->first();
        if ($organisasi && Hash::check($password, $organisasi->PASSWORD_ORGANISASI)) {
            session(['user_type' => 'organisasi', 'user_id' => $organisasi->ID_ORGANISASI]);
            $requestList = Request_Donasi::where('ID_ORGANISASI', $organisasi->ID_ORGANISASI)->get();
            return redirect()->route('halamanOrganisasi');
        }

        $pegawai = Pegawai::where('EMAIL_PEGAWAI', $email)->first();

        if ($pegawai && Hash::check($password, $pegawai->PASSWORD_PEGAWAI)) {
            session(['user_type' => 'pegawai', 'user_id' => $pegawai->ID_PEGAWAI]);

            $namaJabatan = strtolower($pegawai->jabatan->NAMA_JABATAN);

            return match ($namaJabatan) {
                'admin' => redirect()->route('halamanAdmin'),
                'customer service' => redirect()->route('halamanCS'),
                'owner' => redirect()->route('halamanOwner'),
                'pegawai gudang' => redirect()->route('halamanGudang'),
                default => view('halamanUmum'),
            };

        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function logout()
    {
        session()->flush(); // Hapus semua session
        return redirect()->route('login.form'); // Redirect ke halaman login
    }
}
