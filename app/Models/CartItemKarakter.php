<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KarakterCokelat;
use Illuminate\Support\Str;

class CartItemKarakter extends Model
{
    use HasFactory;

    protected $table = 'cart_item_karakter';
    protected $primaryKey = 'id'; // UUID sebagai primary key

    public $incrementing = false; // Tidak menggunakan auto-increment
    protected $keyType = 'string'; // Tipe key adalah string

    protected $fillable = [
        'cart_item_id',
        'karakter_cokelat_id',
        'quantity',
        'notes',
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

    public function cartItem()
    {
        return $this->belongsTo(CartItem::class, 'cart_item_id');
    }

    public function karakterCokelat()
    {
        return $this->belongsTo(KarakterCokelat::class, 'karakter_cokelat_id');
    }

}
