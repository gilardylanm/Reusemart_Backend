<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use Illuminate\Support\Facades\Hash;

class OwnerWebController extends Controller
{
    public function index()
    {
        $jabatanList = Owner::all();
        return view('halamanOwner', compact('jabatanList'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'EMAIL_OWNER' => 'required|email|unique:owner,EMAIL_OWNER',
            'PASSWORD_OWNER' => 'required|min:6',
        ]);

        Owner::create([
            'EMAIL_OWNER' => $request->EMAIL_OWNER,
            'PASSWORD_OWNER' => Hash::make($request->PASSWORD_OWNER),
        ]);

        return redirect()->back()->with('success', 'Data pegawai berhasil dibuat.');
    }
}
