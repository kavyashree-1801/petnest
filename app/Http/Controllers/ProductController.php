<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{

    // PRODUCTS PAGE
    public function index(Request $request)
    {
        $query = Product::query();

        // SEARCH
        if ($request->search) {

            $query->where('name', 'LIKE', '%' . $request->search . '%');

        }

        // CATEGORY FILTER
        if ($request->category) {

            $query->where('category_id', $request->category);

        }

        // PRICE SORT
        if ($request->sort == 'low') {

            $query->orderBy('price', 'asc');

        }

        elseif ($request->sort == 'high') {

            $query->orderBy('price', 'desc');

        }

        $products = $query->get();

        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }


    // PRODUCT DETAILS PAGE
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }


    // STORE
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',

            'description' => 'required',

            'price' => 'required|numeric',

            'category_id' => 'required',

            'image' => 'required|url'

        ]);

        Product::create($request->all());

        return redirect('/');
    }


    // EDIT
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }


    // UPDATE
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->all());

        return redirect('/');
    }


    // DELETE
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect('/');
    }

}