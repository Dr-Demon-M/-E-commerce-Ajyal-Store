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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // PK
            $table->foreignId('store_id')
                ->constrained('stores', 'id')
                ->cascadeOnDelete();
            $table->foreignId('category_id')
                ->constrained('categories', 'id')
                ->nullOnDelete();
            $table->string('name');
            $table->string('product_image')->nullable();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->integer('price');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
