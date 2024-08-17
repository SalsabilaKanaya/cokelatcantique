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


// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Foundation\Auth\User as Authenticatable;

// class LoginAdmin extends Model
// {
//     use HasFactory;

//     protected $table = 'login_admin'; 

//     protected $fillable = ['username', 'password'];
// }