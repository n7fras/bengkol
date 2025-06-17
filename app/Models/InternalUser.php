<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; 
use Laravel\Sanctum\HasApiTokens;
class InternalUser extends Authenticatable
{
    use HasApiTokens, HasFactory,Notifiable;
    protected $table = 'internalusers';
    protected $fillable = [
        'name',
        'username',
        'role',
        'email',
        'phone',
        'address',
        'status',
        'password',
        'foto',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function proudcts(){
        return $this->hasMany(Product::class,'user_id','id');
        
    }
}
