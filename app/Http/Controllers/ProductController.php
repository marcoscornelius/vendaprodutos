<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); 
        $clients = Client::all();         
        return view('products.index', compact('products', 'clients')); 
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:55',
            'price' => 'required|numeric|min:0',
        ]);

        Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
        ]);
        return redirect()->route('products.create')->with('success', 'Product registered successfully!');
    }
}