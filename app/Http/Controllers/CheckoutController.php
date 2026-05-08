<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    // 🛒 SHOW CHECKOUT PAGE
    public function index()
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $cart = session()->get('cart', []);

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout', compact('cart', 'total'));
    }

    // 💾 STORE ORDER
    public function store(Request $request)
    {
        // ✅ VALIDATION
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Cart is empty!');
        }

        // 💰 TOTAL
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // 🔥 TRACKING ID
        $trackingId = 'TRK-' . strtoupper(Str::random(8));

        // 🧾 CREATE ORDER
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'total' => $total,
            'status' => 'pending',
            'tracking_id' => $trackingId,
            'delivery_status' => 'pending',
            'delivery_date' => null,
        ]);

        // 🛍️ SAVE ITEMS
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }

        // 🧹 CLEAR CART
        session()->forget('cart');

        // 💳 SAVE ORDER ID
        session()->put('order_id', $order->id);

        return redirect('/payment');
    }
}