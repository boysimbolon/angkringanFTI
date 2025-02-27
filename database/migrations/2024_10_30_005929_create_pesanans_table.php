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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemesan');
            $table->foreignId('menu1')->constrained('menus')->onDelete('cascade');
            $table->foreignId('menu2')->nullable()->constrained('menus')->onDelete('cascade');
            $table->integer('jumlah1');
            $table->integer('jumlah2')->nullable(); // Mengatur jumlah2 sebagai nullable
            $table->decimal('total_harga', 10, 0);
            $table->text('catatan')->nullable();
            $table->string('mode_pembayaran');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
