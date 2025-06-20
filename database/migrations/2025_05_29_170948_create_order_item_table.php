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
        Schema::create('order_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_order')->nullable();
            $table->unsignedBigInteger('id_product')->nullable();
            $table->integer('quantity')->default(1);
            $table->double('price')->default(0);
            $table->timestamps();
            $table->foreign('id_order')->references('id')->on('order')->onDelete('cascade');
            $table->foreign('id_product')->references('id')->on('products')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_item');
    }
};
