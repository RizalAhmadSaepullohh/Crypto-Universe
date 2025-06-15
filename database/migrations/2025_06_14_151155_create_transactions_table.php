<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')->constrained()->onDelete('cascade');
            $table->foreignId('cryptocurrency_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['buy', 'sell']);
            $table->decimal('amount', 15, 8);
            $table->decimal('price_at_transaction', 15, 2);
            $table->timestamp('transaction_date');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('transactions');
    }
};