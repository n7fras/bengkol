<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoProduct extends Model
{
    use HasFactory;

    protected $table = 'foto_product';
    protected $fillable = ['id_product', 'foto'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}

