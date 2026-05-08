<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
  public function index()
{
    $dogProducts = Product::where('category_id', 1)->take(2)->get();
    $catProducts = Product::where('category_id', 2)->take(2)->get();
    $fishProducts = Product::where('category_id', 3)->take(2)->get();

    return view('home', compact('dogProducts', 'catProducts', 'fishProducts'));
}
}