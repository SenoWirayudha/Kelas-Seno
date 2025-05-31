<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon; // Import Carbon untuk timestamp

class PelangganAuthController extends Controller
{
    /**
     * Register pelanggan baru
     */
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'pelanggan' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'telp' => 'required|string|max:20'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'pesan' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Cek apakah nomor telepon sudah ada
        $existing = DB::table('pelanggans')->where('telp', $request->input('telp'))->first();
        if ($existing) {
            return response()->json([
                'pesan' => 'Nomor telepon sudah terdaftar',
                'data' => null
            ], 409);
        }

        try {
            // Simpan data pelanggan ke tabel yang sudah ada
            $idpelanggan = DB::table('pelanggans')->insertGetId([
                'pelanggan' => $request->input('pelanggan'),
                'alamat' => $request->input('alamat'),
                'telp' => $request->input('telp'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            return response()->json([
                'pesan' => 'Registrasi berhasil',
                'data' => [
                    'idpelanggan' => $idpelanggan,
                    'pelanggan' => $request->input('pelanggan'),
                    'alamat' => $request->input('alamat'),
                    'telp' => $request->input('telp')
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'pesan' => 'Registrasi gagal',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Login pelanggan dengan nomor telepon
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'telp' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'pesan' => 'Nomor telepon wajib diisi',
                'errors' => $validator->errors()
            ], 422);
        }

        $telp = $request->input('telp');
        
        // Cari pelanggan berdasarkan nomor telepon
        $pelanggan = DB::table('pelanggans')->where('telp', $telp)->first();

        if ($pelanggan) {
            // Generate token untuk pelanggan
            $token = Str::random(60);
            
            // Simpan token di cache selama 24 jam (karena tabel tidak punya kolom api_token)
            $pelangganData = [
                'idpelanggan' => $pelanggan->idpelanggan,
                'pelanggan' => $pelanggan->pelanggan,
                'alamat' => $pelanggan->alamat,
                'telp' => $pelanggan->telp,
                'login_time' => Carbon::now()
            ];
            
            Cache::put('pelanggan_token_' . $token, $pelangganData, 60 * 24); // 24 jam

            return response()->json([
                'pesan' => 'Login berhasil',
                'token' => $token,
                'data' => [
                    'idpelanggan' => $pelanggan->idpelanggan,
                    'pelanggan' => $pelanggan->pelanggan,
                    'alamat' => $pelanggan->alamat,
                    'telp' => $pelanggan->telp
                ]
            ]);
        } else {
            return response()->json([
                'pesan' => 'Login gagal, nomor telepon tidak terdaftar',
                'data' => null
            ], 404);
        }
    }

    /**
     * Get profile pelanggan
     */
    public function profile(Request $request)
    {
        $pelanggan = $request->pelanggan_data;

        return response()->json([
            'pesan' => 'Data pelanggan ditemukan',
            'data' => [
                'idpelanggan' => $pelanggan->idpelanggan,
                'pelanggan' => $pelanggan->pelanggan,
                'alamat' => $pelanggan->alamat,
                'telp' => $pelanggan->telp
            ]
        ]);
    }

    /**
     * Update profile pelanggan
     */
    public function updateProfile(Request $request)
    {
        $pelanggan = $request->pelanggan_data;
        
        $validator = Validator::make($request->all(), [
            'pelanggan' => 'sometimes|string|max:255',
            'alamat' => 'sometimes|string|max:500',
            'telp' => 'sometimes|string|max:20'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'pesan' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Cek jika nomor telepon baru sudah dipakai pelanggan lain
        if ($request->has('telp') && $request->input('telp') != $pelanggan->telp) {
            $existing = DB::table('pelanggans') // Fixed: konsisten gunakan 'pelanggans'
                ->where('telp', $request->input('telp'))
                ->where('idpelanggan', '!=', $pelanggan->idpelanggan)
                ->first();
            
            if ($existing) {
                return response()->json([
                    'pesan' => 'Nomor telepon sudah digunakan pelanggan lain',
                    'data' => null
                ], 409);
            }
        }

        try {
            $updateData = [];
            
            if ($request->has('pelanggan')) {
                $updateData['pelanggan'] = $request->input('pelanggan');
            }
            
            if ($request->has('alamat')) {
                $updateData['alamat'] = $request->input('alamat');
            }
            
            if ($request->has('telp')) {
                $updateData['telp'] = $request->input('telp');
            }

            if (empty($updateData)) {
                return response()->json([
                    'pesan' => 'Tidak ada data yang diupdate',
                    'data' => null
                ], 400);
            }

            // Tambahkan updated_at timestamp
            $updateData['updated_at'] = Carbon::now();

            DB::table('pelanggans') // Fixed: konsisten gunakan 'pelanggans'
                ->where('idpelanggan', $pelanggan->idpelanggan)
                ->update($updateData);

            // Get updated data
            $updatedPelanggan = DB::table('pelanggans') // Fixed: konsisten gunakan 'pelanggans'
                ->where('idpelanggan', $pelanggan->idpelanggan)
                ->first();

            return response()->json([
                'pesan' => 'Profile berhasil diupdate',
                'data' => [
                    'idpelanggan' => $updatedPelanggan->idpelanggan,
                    'pelanggan' => $updatedPelanggan->pelanggan,
                    'alamat' => $updatedPelanggan->alamat,
                    'telp' => $updatedPelanggan->telp
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'pesan' => 'Update gagal',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Logout pelanggan
     */
    public function logout(Request $request)
    {
        $token = $request->header('Authorization');
        $token = str_replace('Bearer ', '', $token);

        try {
            // Hapus token dari cache
            Cache::forget('pelanggan_token_' . $token);

            return response()->json([
                'pesan' => 'Logout berhasil'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'pesan' => 'Logout gagal',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get semua pelanggan (untuk admin)
     */
    public function index()
    {
        try {
            $pelanggan = DB::table('pelanggans')->get(); // Fixed: konsisten gunakan 'pelanggans'
            
            return response()->json([
                'pesan' => 'Data pelanggan ditemukan',
                'data' => $pelanggan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'pesan' => 'Gagal mengambil data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}