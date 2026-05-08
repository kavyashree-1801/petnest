<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index()
    {
        $this->autoUpdateStatus();

        $orders = Order::with('items')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('orders', compact('orders'));
    }

    public function trackPage()
    {
        return view('track');
    }

    public function trackOrder(Request $request)
    {
        $request->validate([
            'tracking_id' => 'required'
        ]);

        $this->autoUpdateStatus();

        $trackingId = str_replace('=', '-', $request->tracking_id);

        $order = Order::where('tracking_id', $trackingId)
            ->with('items')
            ->first();

        return view('track', compact('order'));
    }

    // 🔥 CENTRAL LOGIC
    private function autoUpdateStatus()
    {
        $today = Carbon::today();

        $orders = Order::where('status', '!=', 'cancelled')->get();

        foreach ($orders as $order) {

            if (!$order->delivery_date) continue;

            $deliveryDate = Carbon::parse($order->delivery_date);

            if ($today->lt($deliveryDate->copy()->subDay())) {
                $order->delivery_status = 'processing';
            } 
            elseif ($today->eq($deliveryDate->copy()->subDay())) {
                $order->delivery_status = 'shipped';
            } 
            elseif ($today->gte($deliveryDate)) {
                $order->delivery_status = 'delivered';
            }

            $order->save();
        }
    }
}