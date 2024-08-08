<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_item';
    protected $primaryKey = 'orderitem_id'; // Menetapkan primary key khusus
    public $incrementing = false; // Non-incrementing karena menggunakan custom primary key
    protected $keyType = 'unsignedBigInteger'; // Tipe data primary key

    protected $fillable = [
        'order_id',
        'jenis_cokelat_id',
        'karakter_cokelat_id',
        'quantity',
        'price',
        'note',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id'); // Menetapkan foreign key yang sesuai
    }

    public function jenisCokelat()
    {
        return $this->belongsTo(JenisCokelat::class, 'id');
    }

    public function karakterCokelat()
    {
        return $this->belongsTo(KarakterCokelat::class, 'id');
    }
}
