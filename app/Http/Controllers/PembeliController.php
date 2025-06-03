<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembeli;
use Illuminate\Support\Facades\Hash;
use Exception;

class PembeliController extends Controller
{
    public function index()
    {
        try {
            $data = Pembeli::all();
            return response()->json([
                "Status" => true,
                "message" => "Get successful",
                "data" => $data
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
                "data" => $e->getMessage()
            ], 400);
        }
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

            return response()->json([
                'status' => true,
                'message' => 'Pembeli created successfully',
                'data' => $pembeli
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
