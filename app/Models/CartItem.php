<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KarakterCokelat;
use App\Models\JenisCokelat;
use Illuminate\Support\Str;


class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cart_item';
    protected $primaryKey = 'id'; // UUID sebagai primary key

    public $incrementing = false; // Tidak menggunakan auto-increment
    protected $keyType = 'string'; // Tipe key adalah string

    protected $fillable = [
        'cart_id',
        'jenis_cokelat_id',
        'price',
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

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function jenisCokelat()
    {
        return $this->belongsTo(JenisCokelat::class, 'jenis_cokelat_id');
    }

    public function karakterItems()
    {
        return $this->hasMany(CartItemKarakter::class, 'cart_item_id');
    }
}
