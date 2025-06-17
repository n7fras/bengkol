<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('customer', function (Blueprint $table) {
        $table->id();
        $table->string('google_id')->nullable()->unique();
        $table->string('name')->nullable();
        $table->string('foto')->nullable();
        $table->string('email')->nullable()->unique();
        $table->string('password')->nullable();
        $table->string('phone')->nullable();
        $table->string('address')->nullable();
        $table->string('city')->nullable();
        $table->string('state')->nullable();
        $table->string('status')->default('active');
        $table->string('google_token')->nullable();
        $table->string('remember_token')->nullable();
        $table->timestamps();

    });
   
}


public function down()
{
    Schema::table('customer', function (Blueprint $table) {
        $table->dropColumn(['google_id', 'google_token']);
    });
}

};
