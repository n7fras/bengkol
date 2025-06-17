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
    Schema::create('internalusers', function (Blueprint $table) {
        $table->id();
        $table->string('username');
        $table->string('name');
        $table->enum('role', ['Super Admin', 'Admin Input', 'Supervisor']);
        $table->string('email')->unique();
        $table->string('phone');
        $table->string('address');
        $table->boolean('status')->default(1); // Aktif secara default
        $table->string('password');
        $table->string('foto')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internalusers');
    }
};
