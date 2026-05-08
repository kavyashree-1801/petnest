<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{

    // SHOW
    public function index()
    {

        $wishlists = Wishlist::where('user_id', Auth::id())
                        ->with('product')
                        ->latest()
                        ->get();

        return view('wishlist.index', compact('wishlists'));
    }


    // ADD
    public function add($id)
    {

        $exists = Wishlist::where('user_id', Auth::id())
                    ->where('product_id', $id)
                    ->exists();

        if(!$exists){

            Wishlist::create([

                'user_id' => Auth::id(),

                'product_id' => $id

            ]);
        }

        return back()->with(
            'success',
            'Added to wishlist ❤️'
        );
    }


    // REMOVE
    public function remove($id)
    {

        Wishlist::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->delete();

        return back()->with(
            'success',
            'Removed from wishlist'
        );
    }

}