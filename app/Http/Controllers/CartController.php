<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }

    public function add($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "image" => $product->image,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Added to cart!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart');

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back();
    }

    public function update(Request $request, $id)
{
    $cart = session()->get('cart');

    if(isset($cart[$id])) {

        if($request->quantity <= 0){
            unset($cart[$id]);
        } else {
            $cart[$id]['quantity'] = $request->quantity;
        }

        session()->put('cart', $cart);
    }

    return redirect()->back();
}
}