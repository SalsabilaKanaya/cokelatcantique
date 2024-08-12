<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    protected $fillable = [
        'user_id',
        'delivery_date',
        'notes',
        'total_price',
        'payment_method',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function address()
    {
        return $this->hasOne(OrderAddress::class, 'orderaddress_id',);
    }
}
