<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function products()
    {
        return view('home.products');
    }
    

    public function editUser()
    {
        return view('home.edit_user');
    }

    public function sales()
    {
        return view('home.sales');
    }
}