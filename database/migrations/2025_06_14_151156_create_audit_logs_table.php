<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('action'); // e.g., 'created', 'updated', 'deleted'
            $table->string('model_type'); // e.g., 'App\Models\Transaction'
            $table->unsignedBigInteger('model_id');
            $table->text('details')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('audit_logs');
    }
};