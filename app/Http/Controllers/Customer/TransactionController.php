<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;

class TransactionController extends Controller {
    public function transaction() {
        $orders = Order::where('shop_id', SID())->orderBy('id', 'DESC')->paginate(50);
        $total_transaction = 0;
        foreach($orders as $item){
            $total_transaction += $item->subtotal;
        }
        return view('customer.transaction.index', compact('orders','total_transaction'));
    }
}
