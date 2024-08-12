<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Shared\Models\KarakterCokelat;

class OrderItemKarakter extends Model
{
    use HasFactory;

    protected $table = 'order_item_karakter';

    protected $fillable = [
        'order_item_id',
        'karakter_cokelat_id',
        'quantity',
        'notes',
    ];

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id');
    }

    public function karakterCokelat()
    {
        return $this->belongsTo(KarakterCokelat::class, 'karakter_cokelat_id');
    }

}
