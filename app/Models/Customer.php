<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Database\Eloquent\Model;

class Customer extends Authenticatable
{
    use HasFactory;
    protected $table ='customer';
    protected $fillable = [
        'google_id',
        'google_token',
        'name',
        'email',
        'password',
        'phone',
        'address',
        'city',
        'state',
        'status',
        'foto'
    ];
}
