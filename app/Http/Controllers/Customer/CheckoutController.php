<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Consumer;
use App\Models\Employee;
use App\Models\Order;
use App\Models\OrderProduct;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller {
    public function checkout() {

        if (session()->get('order')) {
            $session_order = Order::find(session()->get('order'));
            if($session_order->payment_method === 'Cash'){
                $cash = Cart::subtotal();
            }else {
                $cash = 0;
            }
            $session_order->update([
                'total'    => Cart::subtotal(),
                'discount' => session()->get('discount'),
                'subtotal' => session()->get('subtotal'),
                'cash'     => $cash,
            ]);

            foreach (Cart::content() as $cart) {
                $check = OrderProduct::where('order_id', session()->get('order'))->where('product_id', $cart->id)->first();

                if ($check) {
                    $check->update(['quantity' => $cart->qty]);
                } else {
                    OrderProduct::create([
                        'product_id' => $cart->id,
                        'order_id'   => session()->get('order'),
                        'quantity'   => $cart->qty,
                        'price'      => $cart->price,
                    ]);
                }

            }

            session()->forget('discount');
            session()->forget('subtotal');
            session()->forget('order');
            Cart::destroy();

            return redirect()->route('customer.transaction')->withToastSuccess('Order updated successfully');
        }

        $data              = [];
        $data['subtotal']  = session()->get('subtotal');
        $data['consumers'] = Consumer::all();
        $data['employees'] = Employee::all();

        return view('customer.checkout', $data);
    }

}
