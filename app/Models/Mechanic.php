<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mechanic extends Model
{
    use HasFactory;
    protected $table = 'mechanic';
    protected $fillable = ['name', 'address', 'phone', 'email', 'status', 'foto','user_id'];
    protected $hidden = ['created_at', 'updated_at','password'];
}
