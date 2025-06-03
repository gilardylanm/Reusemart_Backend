<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Organisasi;
use Illuminate\Support\Facades\Hash;
use Exception;

class OrganisasiController extends Controller
{
    public function index()
    {
        try {
            $data = Organisasi::all();
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

    public function login(Request $request)
    {
        $request->validate([
            'EMAIL_ORGANISASI' => 'required|string|email',
            'PASSWORD_ORGANISASI' => 'required|string',
        ]);


        $organisasi = Organisasi::where('EMAIL_ORGANISASI', $request->EMAIL_ORGANISASI)->first();

        if (!$organisasi || !Hash::check($request->PASSWORD_ORGANISASI, $organisasi->PASSWORD_ORGANISASI)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $organisasi->createToken('Personal Access Token')->plainTextToken;

        return response()->json([
            'detail' => $organisasi,
            'token' => $token
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'NAMA_ORGANISASI' => 'required|string|max:255',
                'EMAIL_ORGANISASI' => 'required|email|unique:organisasi,EMAIL_ORGANISASI',
                'USERNAME_ORGANISASI' => 'required|string|max:255',
                'ALAMAT_ORGANISASI' => 'required|string|max:255',
                'NOTELP_ORGANISASI' => 'required|string|max:15',
                'PASSWORD_ORGANISASI' => 'required|string|min:6',
            ]);

            $organisasi = Organisasi::create([
                'NAMA_ORGANISASI' => $request->NAMA_ORGANISASI,
                'EMAIL_ORGANISASI' => $request->EMAIL_ORGANISASI,
                'USERNAME_ORGANISASI' => $request->USERNAME_ORGANISASI,
                'ALAMAT_ORGANISASI' => $request->ALAMAT_ORGANISASI,
                'NOTELP_ORGANISASI' => $request->NOTELP_ORGANISASI,
                'PASSWORD_ORGANISASI' => Hash::make($request->PASSWORD_ORGANISASI),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Organisasi created successfully',
                'data' => $organisasi
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

    public function update(Request $request, $id)
    {
        $organisasi = Organisasi::findOrFail($id);
        $organisasi->update($request->all());
        return redirect()->route('admin.adminForOrganisasi')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $organisasi = Organisasi::findOrFail($id);
        $organisasi->delete();
        return redirect()->route('admin.adminForOrganisasi')->with('success', 'Data berhasil dihapus.');
    }

    // Cari organisasi berdasarkan nama atau email
    public function search(Request $request)
    {
        $query = $request->input('q');

        $result = Organisasi::where('NAMA_ORGANISASI', 'like', "%$query%")
            ->orWhere('EMAIL_ORGANISASI', 'like', "%$query%")
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Search result',
            'data' => $result
        ]);
    }

    public function logout(Request $request)
    {
        $organisasi = Auth::guard('organisasi')->user();

        if ($organisasi) {
            $organisasi->currentAccessToken()->delete();

            return response()->json(['message' => 'Logged out successfully']);
        }

        return response()->json(['message' => 'Not logged in'], 401);
    }
}
