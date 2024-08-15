<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $table = 'user_address';

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'province_id',
        'city_id',
        'province_name',
        'city_name',
        'address',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

