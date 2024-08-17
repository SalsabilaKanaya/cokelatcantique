<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KarakterCokelat extends Model
{
    use HasFactory;

    protected $table = 'karakter_cokelat';
    public $incrementing = false; // Mengubah incrementing menjadi false
    protected $keyType = 'string'; // Mengubah keyType menjadi string

    protected $fillable = [
        'id',
        'nama',
        'foto',
        'kategori',
        'deskripsi',
    ];

     // Override boot method untuk menghasilkan ID acak
     protected static function boot()
     {
         parent::boot();

         static::creating(function ($model) {
             $model->id = (string) Str::random(14);
         });
     }

}
