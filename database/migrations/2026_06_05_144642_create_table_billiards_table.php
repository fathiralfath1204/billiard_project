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
        Schema::create('table_billiards', function (Blueprint $table) {
        $table->id();
        $table->string('number_table'); // Contoh: "Meja 01"
        $table->string('type');         // Contoh: "VIP" atau "Reguler"
        $table->integer('price_per_hour'); // Harga sewa per jam
        $table->string('status')->default('available'); // Status: available, occupied, maintenance
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_billiards');
    }
};
