<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Shared\Models\KarakterCokelat;
use Shared\Models\JenisCokelat;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_item';

    protected $fillable = [
        'order_id',
        'jenis_cokelat_id',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function jenisCokelat()
    {
        return $this->belongsTo(JenisCokelat::class, 'jenis_cokelat_id');
    }

    public function karakterItems()
    {
        return $this->hasMany(OrderItemKarakter::class, 'order_item_id');
    }
}
