<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('order_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->string('name');
            $table->decimal('price', 12, 2);
            $table->integer('quantity');
            $table->string('color');
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
