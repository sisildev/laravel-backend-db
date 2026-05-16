<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('riwayat_scan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('label');
            $table->float('confidence');
            $table->string('image_path')->nullable();
            $table->json('all_predictions')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('riwayat_scan'); }
};