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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_customer')->nullable();
            $table->string('status');
            $table->string('num_tracking')->nullable();
            $table->string('courier')->nullable();
            $table->string('delivery_service')->nullable();
            $table->string('shipping_cost')->nullable();
            $table->string('shipping_estimate')->nullable();
            $table->integer('weight_total')->nullable();
            $table->double('total_price')->nullable();
            $table->text('shipping_address')->nullable();
            $table->string('post_code')->nullable();
            // Tambahkan ke migration (jika belum ada)
$table->string('kode_order')->nullable(); // contoh: ORDER-654fd789abc
$table->integer('grand_total')->default(0);
            $table->string('payment_method')->nullable(); // contoh: 'transfer', 'cod', dll
            $table->string('payment_status')->default('unpaid'); // contoh: 'paid', 'unpaid', 'pending'
            $table->timestamps();
            $table->foreign('id_customer')->references('id')->on('customer')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
