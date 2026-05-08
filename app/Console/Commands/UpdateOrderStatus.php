<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Carbon\Carbon;

class UpdateOrderStatus extends Command
{
    protected $signature = 'orders:update-status';
    protected $description = 'Auto update order delivery status';

    public function handle()
    {
        // 🔥 PROCESSING → SHIPPED (after 1 day)
        Order::where('delivery_status', 'processing')
            ->where('created_at', '<=', Carbon::now()->subDay())
            ->update(['delivery_status' => 'shipped']);

        // 🔥 SHIPPED → DELIVERED (on delivery date)
        Order::where('delivery_status', 'shipped')
            ->where('delivery_date', '<=', Carbon::now())
            ->update(['delivery_status' => 'delivered']);

        $this->info('Order statuses updated successfully!');
    }
}