<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sales extends Model
{
    use HasFactory;
    public function up()
{
    Schema::create('sales', function (Blueprint $table) {
        $table->id();
        $table->string('product_name');
        $table->integer('quantity');
        $table->decimal('amount', 10, 2);
        $table->date('sale_date');
        $table->timestamps();
    });
}

}
