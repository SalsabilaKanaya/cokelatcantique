<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class UserAddress extends Model
{
    use HasFactory;

    protected $table = 'user_address';

    protected $primaryKey = 'id'; // UUID sebagai primary key

    public $incrementing = false; // Tidak menggunakan auto-increment
    protected $keyType = 'string'; // Tipe key adalah string

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'province_id',
        'province_name',
        'city_id',
        'city_name',
        'address',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid(); // Generate UUID
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

