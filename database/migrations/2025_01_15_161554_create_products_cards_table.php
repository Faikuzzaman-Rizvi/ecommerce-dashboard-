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
        Schema::create('products_cards', function (Blueprint $table) {
            $table->id();
            $table->string('email',50);
            $table->unsignedBigInteger('product_id');
            $table->string('color',200);
            $table->string('size', 200);

            $table->foreign('email')->references('email')->on('profiles')->onUpdate('cascade')
            ->onDelete('restrict');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')
            ->onDelete('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_cards');
    }
};
