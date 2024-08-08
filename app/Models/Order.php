<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    protected $primaryKey = 'order_id'; // Menetapkan primary key khusus
    public $incrementing = false; // Non-incrementing karena menggunakan custom primary key
    protected $keyType = 'unsignedBigInteger'; // Tipe data primary key

    protected $fillable = [
        'user_id',
        'status',
        'delivery_date',
        'notes',
        'total_price',
        'payment_method',
    ];

    public function user()
    {
        return $this->belongsTo(AkunUser::class, 'user_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }

    public function address()
    {
        return $this->hasOne(OrderAddress::class, 'orderaddress_id',);
    }
}
