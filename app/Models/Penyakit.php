<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model {
    protected $table = 'penyakit';

    protected $fillable = [
        'slug',
        'nama',
        'deskripsi',
        'tingkat_bahaya',
        'gejala',
        'penanganan',
        'pencegahan',
        'referensi',
    ];

    protected $casts = [
        'gejala' => 'array',
        'penanganan' => 'array',
        'pencegahan' => 'array',
        'referensi' => 'array',
    ];
}
