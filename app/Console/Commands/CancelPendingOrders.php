<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;

class CancelPendingOrders extends Command
{
    protected $signature = 'cancel:pending-orders';

    protected $description = 'Cancel pending orders older than 15 minutes';

    public function handle()
{
$orders = \App\Models\Order::where('status', 'pending')->get();


foreach ($orders as $order) {
    if ($order->created_at->diffInMinutes(now()) >= 15) {
        $order->status = 'cancelled';
        $order->save();
    }
}

$this->info('Checked and cancelled old pending orders.');


}

}
