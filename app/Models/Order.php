<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;



class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    protected $primaryKey = 'id'; // UUID sebagai primary key

    public $incrementing = false; // Tidak menggunakan auto-increment
    protected $keyType = 'string'; // Tipe key adalah string

    protected $fillable = [
        'user_id',
        'delivery_date',
        'notes',
        'payment_proof',
        'courier',
        'service name',
        'delivery_cost',
        'total_price',
        'status'
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

    public function getDeliveryDateAttribute($value)
    {
        return Carbon::parse($value);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function userAddress()
    {
        return $this->belongsTo(UserAddress::class, 'user_id', 'user_id');
    }
}
