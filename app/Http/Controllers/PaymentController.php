<?php

namespace App\Http\Controllers;

use Razorpay\Api\Api;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function pay()
    {
        $order = Order::find(session('order_id'));

        if (!$order) {
            return redirect('/checkout')->with('error', 'Order not found');
        }

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $razorpayOrder = $api->order->create([
            'receipt' => 'order_' . $order->id,
            'amount' => $order->total * 100,
            'currency' => 'INR'
        ]);

        $order->razorpay_order_id = $razorpayOrder['id'];
        $order->save();

        return view('payment', [
            'order' => $order,
            'razorpayOrderId' => $razorpayOrder['id']
        ]);
    }

    public function verify(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {
            // ✅ VERIFY PAYMENT
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ]);

            $order = Order::with('items')->find(session('order_id'));

            if (!$order) {
                return redirect('/checkout')->with('error', 'Order not found');
            }

            // ✅ UPDATE ORDER
            $order->payment_id = $request->razorpay_payment_id;
            $order->status = 'paid';
            $order->delivery_status = 'processing';
            $order->delivery_date = Carbon::now()->addDays(3);
            $order->save();

            // ===== EMAIL =====
            $apiKey = config('services.brevo.key');

            $productRows = '';
            foreach ($order->items as $item) {
                $productRows .= "
                    <tr>
                        <td style='padding:8px;border:1px solid #ddd;'>{$item->product_name}</td>
                        <td style='padding:8px;border:1px solid #ddd;'>{$item->quantity}</td>
                        <td style='padding:8px;border:1px solid #ddd;'>₹{$item->price}</td>
                    </tr>
                ";
            }

            $html = "
            <div style='font-family:Arial,sans-serif;background:#f4f6f8;padding:20px'>
                <div style='max-width:600px;margin:auto;background:#fff;border-radius:10px;overflow:hidden'>

                    <div style='background:#ff6b6b;color:white;padding:20px;text-align:center'>
                        <h1 style='margin:0;'>🐾 PetNest</h1>
                        <p>Order Confirmation</p>
                    </div>

                    <div style='padding:20px'>
                        <h2>Thank you for your order!</h2>

                        <p><strong>Order ID:</strong> {$order->id}</p>
                        <p><strong>Status:</strong> Paid</p>

                        <p>
                            <strong>Tracking ID:</strong>
                            <span style='color:#2196F3;font-weight:bold'>
                                {$order->tracking_id}
                            </span>
                        </p>

                        <table style='width:100%;border-collapse:collapse;margin-top:10px'>
                            <tr style='background:#f2f2f2'>
                                <th style='padding:8px;border:1px solid #ddd;'>Product</th>
                                <th style='padding:8px;border:1px solid #ddd;'>Qty</th>
                                <th style='padding:8px;border:1px solid #ddd;'>Price</th>
                            </tr>
                            {$productRows}
                        </table>

                        <h3 style='margin-top:15px;color:#28a745'>
                            Total: ₹{$order->total}
                        </h3>

                        <div style='text-align:center;margin-top:20px'>
                            <a href='http://127.0.0.1:8000/track'
                               style='background:#2196F3;color:white;padding:10px 20px;text-decoration:none;border-radius:5px'>
                               Track Your Order
                            </a>
                        </div>
                    </div>

                    <div style='background:#f1f1f1;padding:10px;text-align:center;font-size:12px;color:#777'>
                        Thank you for shopping with PetNest 🐾
                    </div>

                </div>
            </div>
            ";

            // ✅ SEND EMAIL (SAFE)
            try {
                Http::withHeaders([
                    'api-key' => $apiKey,
                    'content-type' => 'application/json',
                ])->post('https://api.brevo.com/v3/smtp/email', [
                    'sender' => [
                        'name' => 'PetNest',
                        'email' => 'kavyashreedm01@gmail.com'
                    ],
                    'to' => [['email' => $order->email]],
                    'subject' => 'Order Confirmed',
                    'htmlContent' => $html
                ]);
            } catch (\Exception $mailError) {
                // ❗ Ignore email failure (don’t break payment flow)
            }

            session()->forget('cart');

            return redirect('/order-success');

        } catch (\Exception $e) {

            // ❌ PAYMENT FAILED
            $order = Order::find(session('order_id'));

            if ($order) {
                $order->status = 'cancelled';
                $order->delivery_status = 'cancelled';
                $order->save();
            }

            return redirect('/checkout')->with('error', 'Payment failed.');
        }
    }

    public function retry($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status === 'cancelled') {
            return redirect('/orders')->with('error', 'Order expired!');
        }

        session()->put('order_id', $order->id);

        return redirect('/payment');
    }
}