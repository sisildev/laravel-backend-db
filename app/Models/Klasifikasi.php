<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Klasifikasi extends Model
{
    protected $table = 'klasifikasi';

    protected $primaryKey = 'id_klasifikasi';

    protected $fillable = [
        'id_user',
        'id_penyakit',
        'gambar_input',
        'probabilitas',
        'tanggal_klasifikasi',
    ];

    protected $casts = [
        'tanggal_klasifikasi' => 'datetime',
    ];

    /**
     * Relasi ke user
     */
    public function user()
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id'
        );
    }

    /**
     * Relasi ke penyakit
     */
    public function penyakit()
    {
        return $this->belongsTo(
            Penyakit::class,
            'id_penyakit',
            'id_penyakit'
        );
    }

    /**
     * Relasi ke riwayat
     */
    public function riwayat()
    {
        return $this->hasOne(
            Riwayat::class,
            'id_klasifikasi',
            'id_klasifikasi'
        );
    }
}