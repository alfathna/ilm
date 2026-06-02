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
        Schema::create('view_logs', function (Blueprint $table) {
            $table->id();
            $table->morphs('viewable'); // creates viewable_id and viewable_type
            $table->date('viewed_date'); // tanggal kunjungan
            $table->timestamps();

            // Index untuk query cepat berdasarkan tanggal
            $table->index('viewed_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('view_logs');
    }
};
