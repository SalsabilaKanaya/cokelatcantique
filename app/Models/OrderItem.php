<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Shared\Models\KarakterCokelat;
use Shared\Models\JenisCokelat;
use Illuminate\Support\Str;


class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_item';
    protected $primaryKey = 'id'; // UUID sebagai primary key

    public $incrementing = false; // Tidak menggunakan auto-increment
    protected $keyType = 'string'; // Tipe key adalah string

    protected $fillable = [
        'order_id',
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
