<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Klasifikasi;
use App\Models\Riwayat;

class KlasifikasiController extends Controller
{
    /**
     * Simpan hasil klasifikasi
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'id_penyakit' => 'required',
            'gambar_input' => 'required',
            'probabilitas' => 'required|numeric',
        ]);

        $klasifikasi = Klasifikasi::create([
            'id_user' => $request->id_user,
            'id_penyakit' => $request->id_penyakit,
            'gambar_input' => $request->gambar_input,
            'probabilitas' => $request->probabilitas,
            'tanggal_klasifikasi' => now(),
        ]);

        // otomatis masuk riwayat
        Riwayat::create([
            'id_user' => $request->id_user,
            'id_klasifikasi' => $klasifikasi->id_klasifikasi,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Klasifikasi berhasil disimpan',
            'data' => $klasifikasi,
        ]);
    }

    /**
     * Ambil semua klasifikasi
     */
    public function index()
    {
        $data = Klasifikasi::with(['penyakit', 'user'])
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
}