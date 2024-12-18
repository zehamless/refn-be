<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->uuid('order_id')->index()->primary(false);
            $table->decimal('total_amount',10, 2);
            $table->enum('status', ['not_paid', 'processing', 'completed', 'cancelled'])->default('not_paid');
            $table->enum('order_type', ['deliver', 'pickup'])->default('deliver');
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
