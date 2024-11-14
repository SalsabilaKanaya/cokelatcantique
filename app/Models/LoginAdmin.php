<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoginAdmin extends Authenticatable
{
    use HasFactory;

    protected $table = 'login_admin'; // Menentukan nama tabel

    protected $fillable = ['username', 'password'];
}