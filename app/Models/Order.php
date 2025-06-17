<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $fillable = [
        'id_customer',
        'status',
        'num_tracking',
        'courier',
        'delivery_service',
        'shipping_cost',
        'shipping_estimate',
        'weight_total',
        'total_price',
        'shipping_address',
        'post_code'
    ];
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class , 'id_order');

    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }
}
