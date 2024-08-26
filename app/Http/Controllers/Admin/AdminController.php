<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function loginAdmin()
    {
        return view('admin.login_admin'); // Mengembalikan tampilan login_admin
    }

    public function orderList()
    {
        return view('admin.order_list'); // Mengembalikan tampilan order_list
    }

    public function detailOrder()
    {
        return view('admin.detail_order'); // Mengembalikan tampilan detail_order
    }
}