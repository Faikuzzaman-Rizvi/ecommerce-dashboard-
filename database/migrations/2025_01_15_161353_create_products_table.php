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
            $table->string('title');
            $table->string('short_des',500);
            $table->text('long_des')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->boolean('discount')->default(false);
            $table->string('image');
            $table->boolean('stock')->default(true);
            $table->integer('star')->default(0);
            $table->enum('remark', ['popular', 'new', 'top', 'special', 'trending', 'regular'])->default('regular');
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict');
            $table->foreignId('brand_id')->constrained('brands')->onDelete('restrict');
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
