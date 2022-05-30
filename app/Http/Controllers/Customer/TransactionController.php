<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;

class TransactionController extends Controller {
    public function transaction() {
        $orders            = Order::where('shop_id', SID())->orderBy('id', 'DESC')->paginate(50);
        $total_transaction = 0;
        $count             = 0;

        foreach ($orders as $item) {
            $total_transaction += $item->subtotal;
        }

        return view('customer.transaction.index', compact('orders', 'total_transaction', 'count'));
    }

    public function transactionDetails($id) {

        $data                = [];
        $data['transaction'] = $t = Order::where('id', $id)->with('orderProduct')->first();

        if (CID() || SID() !== $t->shop_id) {
            return redirect()->back()->withToastError('Unauthorized access!!');
        }

        return view('customer.transaction.details', $data);
    }

}
