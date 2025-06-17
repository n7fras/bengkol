<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merk extends Model
{
    use HasFactory;

    protected $table = 'merk'; // karena tidak pakai 'merks'

    protected $primaryKey = 'id_merk';

    protected $fillable = ['merk_name'];
    public function products()
{
    return $this->hasMany(Product::class, 'id_merk', 'id_merk');
}

}
