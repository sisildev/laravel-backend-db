<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Klasifikasi;

class Riwayat extends Model
{
    protected $table = 'riwayat_scan';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'label',
        'confidence',
        'image_path',
        'all_predictions',
    ];

    protected $casts = [
        'all_predictions' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function klasifikasi()
    {
        return $this->belongsTo(Klasifikasi::class, 'id_klasifikasi');
    }
}