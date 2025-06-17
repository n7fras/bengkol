<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'product_code',
        'product_name',
        'product_type',
        'product_description',
        'merk',
        'product_price',
        'product_image',
        'product_stock',
    ];
    public function internaluser(){
        return $this->belongsTo(InternalUser::class,'user_id','id');
    }
    public function merk()
    {
        return $this->belongsTo(Merk::class, 'id_merk', 'id_merk');
    }
    public function fotoTambahan()
{
    return $this->hasMany(FotoProduct::class, 'id_product');
}

}
