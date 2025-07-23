<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProduct = Product::where('is_featured', 1)->take(6)->get();
        return view('welcome', compact('featuredProduct'));
    }
}
