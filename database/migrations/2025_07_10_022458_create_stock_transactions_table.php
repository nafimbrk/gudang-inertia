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
        Schema::create('stock_transactions', function (Blueprint $table) {
            $table->id();

            // Relasi item
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');

            // Relasi user yang input transaksi
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Tipe transaksi: 'in' untuk masuk, 'out' untuk keluar
            $table->enum('type', ['in', 'out']);

            // Jumlah barang
            $table->integer('quantity');

            // Tanggal transaksi
            $table->date('date');

            // Catatan tambahan
            $table->text('note')->nullable();

            // Tambahan opsional (jika mau relasi lain di masa depan)
            $table->foreignId('warehouse_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained()->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_transactions');
    }
};
