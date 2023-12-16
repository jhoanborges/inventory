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
            $table->id();
            $table->string('name');
            $table->string('sku')->unique()->nullable();
            $table->string('slug')->unique()->nullable();
            $table->text('tags')->nullable();
            $table->string('original_barcode')->nullable();
            $table->integer('unit_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('description')->nullable();
            $table->text('notes')->nullable();
            $table->text('image')->nullable();
            $table->text('images')->nullable();
            $table->decimal('price', $precision = 8, $scale = 2)->nullable();
            $table->timestamps();
            $table->datetime('deleted_at')->nullable();
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
