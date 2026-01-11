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
        Schema::table('products', function (Blueprint $table) {
            $table->json('options')->nullable()->after('price');
            $table->float('compare_price')->nullable()->after('options');
            $table->float('rate')->default(0)->after('compare_price');
            $table->boolean('featured')->default(0)->after('rate');
            $table->enum('status',['active', 'draft','archived'])->default('active')->after('featured');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            Schema::dropIfExists('products');
        });
    }
};
