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
        //
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_code')->unique();
            $table->string('product_name');
            $table->enum('product_type', ['125 CC', '150 CC']);
            $table->string('product_description');
            $table->decimal('product_price', 10, 2);
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('id_merk');
            $table->string('product_stock');
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->unsignedBigInteger('user_id'); // Tambahkan kolom user_id
        $table->foreign('user_id')->references('id')->on('internalusers')->onDelete('cascade'); 
            $table->foreign('id_merk')->references('id_merk')->on('merk')->onDelete('cascade');
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
