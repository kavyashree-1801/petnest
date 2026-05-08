<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Feedback;
use App\Models\PetReminder;
use Carbon\Carbon;

class AdminController extends Controller
{
    // DASHBOARD
    public function dashboard()
    {
        $orders = Order::with('items')->get();

        // 💰 TOTAL REVENUE
        $revenue = $orders->sum(function ($order) {
            return $order->items->sum(function ($item) {
                return $item->price * $item->quantity;
            });
        });

        // 📊 MONTHLY ORDER COUNT
        $monthly = Order::selectRaw('MONTH(created_at) as m, COUNT(*) as total')
            ->groupBy('m')
            ->pluck('total', 'm')
            ->toArray();

        $months = [];

        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = $monthly[$i] ?? 0;
        }

        // 💰 MONTHLY REVENUE
        $monthlyRevenueRaw = Order::with('items')->get()
            ->groupBy(function ($order) {
                return $order->created_at->format('n');
            })
            ->map(function ($orders) {
                return $orders->sum(function ($order) {
                    return $order->items->sum(fn($item) => $item->price * $item->quantity);
                });
            })
            ->toArray();

        $monthlyRevenue = [];

        for ($i = 1; $i <= 12; $i++) {
            $monthlyRevenue[$i] = $monthlyRevenueRaw[$i] ?? 0;
        }

        // 🧾 STATUS COUNTS
        $statusCounts = [

            Order::where('delivery_status', 'processing')->count(),

            Order::where('delivery_status', 'shipped')->count(),

            Order::where('delivery_status', 'delivered')->count(),

            Order::where('delivery_status', 'cancelled')->count(),

        ];

        // 🐾 PET REMINDERS
        $totalReminders = PetReminder::count();

        $upcomingReminders = PetReminder::where('status', 'upcoming')->count();

        $completedReminders = PetReminder::where('status', 'completed')->count();

        $todayReminders = PetReminder::whereDate('reminder_date', now())->count();

        $recentReminders = PetReminder::latest()->take(5)->get();

        return view('admin.dashboard', [

            'users' => User::count(),

            'products' => Product::count(),

            'orders' => Order::count(),

            'contacts' => Contact::count(),

            'feedbacks' => Feedback::count(),

            'revenue' => $revenue,

            // charts
            'months' => array_keys($months),

            'monthlyCounts' => array_values($months),

            'monthlyRevenue' => array_values($monthlyRevenue),

            'statusCounts' => $statusCounts,

            // recent orders
            'recentOrders' => Order::with('items')->latest()->take(5)->get(),

            // reminders
            'totalReminders' => $totalReminders,

            'upcomingReminders' => $upcomingReminders,

            'completedReminders' => $completedReminders,

            'todayReminders' => $todayReminders,

            'recentReminders' => $recentReminders,

        ]);
    }

    // USERS
    public function users(Request $request)
    {
        $query = $request->search;

        $users = User::where('role', 'user')
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'like', "%$query%")
                  ->orWhere('email', 'like', "%$query%");
            })
            ->latest()
            ->paginate(5);

        return view('admin.users', compact('users'));
    }

    // PRODUCTS
    public function products(Request $request)
    {
        $query = $request->search;

        $products = Product::when($query, function ($q) use ($query) {
                $q->where('name', 'like', "%$query%");
            })
            ->latest()
            ->paginate(6);

        return view('admin.products', compact('products'));
    }

    // ORDERS
    public function orders(Request $request)
    {
        $query = $request->search;

        Order::where('status', 'cancelled')
            ->update(['delivery_status' => 'cancelled']);

        $orders = Order::with('items')
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query);
            })
            ->latest()
            ->paginate(5);

        return view('admin.orders', compact('orders'));
    }

    public function updateOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->status = $request->status;

        if ($request->status == 'cancelled') {
            $order->delivery_status = 'cancelled';
        } else {
            $order->delivery_status = $request->delivery_status;
        }

        if (!$request->delivery_date && $order->delivery_status == 'processing') {
            $order->delivery_date = now()->addDays(3);
        } else {
            $order->delivery_date = $request->delivery_date;
        }

        $order->save();

        return back()->with('success', 'Order updated!');
    }

    // DELIVERY AUTO SYSTEM
    public function delivery(Request $request)
    {
        $today = Carbon::today();

        $ordersAll = Order::where('status', '!=', 'cancelled')->get();

        foreach ($ordersAll as $order) {

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

        $status = $request->status;

        $orders = Order::when($status, function ($q) use ($status) {
                $q->where('delivery_status', $status);
            })
            ->latest()
            ->paginate(5);

        return view('admin.delivery', compact('orders'));
    }

    public function updateDelivery(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->delivery_status = $request->delivery_status;
        $order->delivery_date = $request->delivery_date;

        $order->save();

        return back()->with('success', 'Delivery updated!');
    }

    // CONTACTS
    public function contacts()
    {
        return view('admin.contacts', [
            'contacts' => Contact::latest()->paginate(5)
        ]);
    }

    // FEEDBACKS
    public function feedbacks()
    {
        return view('admin.feedbacks', [
            'feedbacks' => Feedback::latest()->paginate(5)
        ]);
    }

    // NOTIFICATIONS
    public function notifications()
    {
        return response()->json(
            Order::latest()->take(5)->get(['id','status','created_at'])
        );
    }

    // VIEW ORDER
    public function viewOrder($id)
    {
        $order = Order::with('items')->findOrFail($id);

        $order->total = $order->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('admin.view-order', compact('order'));
    }

    // 🐾 PET REMINDERS
    public function petReminders()
    {
        $reminders = PetReminder::latest()->paginate(10);

        return view('admin.pet-reminders', compact('reminders'));
    }
}