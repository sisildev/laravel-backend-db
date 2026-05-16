<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Aman untuk kondisi tabel sudah ada (mis. server pernah dibuat manual /
        // migration sebelumnya gagal tapi tabel terlanjur kebentuk).
        if (Schema::hasTable('klasifikasi')) {
            return;
        }

        Schema::create('klasifikasi', function (Blueprint $table) {
            $table->id('id_klasifikasi');

            // relasi ke users
            $table->unsignedBigInteger('id_user');

            // relasi ke penyakit
            $table->unsignedBigInteger('id_penyakit');

            // gambar input dari user
            $table->string('gambar_input');

            // probabilitas hasil AI
            $table->float('probabilitas');

            // tanggal klasifikasi
            $table->dateTime('tanggal_klasifikasi');

            $table->timestamps();

            // foreign key
            // users memakai PK default: `id`
            $table->foreign('id_user')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            // penyakit memakai PK default: `id`
            $table->foreign('id_penyakit')
                ->references('id')
                ->on('penyakit')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('klasifikasi');
    }
};
