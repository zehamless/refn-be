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
            $table->uuid('invoice_id')->index();
            $table->decimal('total_amount',12, 2);
            $table->enum('status', ['unpaid', 'processing', 'completed', 'cancelled'])->default('unpaid');
            $table->enum('order_type', ['delivery', 'pickup'])->default('delivery');
            $table->text('notes')->nullable();
            $table->decimal('paid', 12, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
