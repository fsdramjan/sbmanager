<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Consumer;
use App\Models\Order;
use Illuminate\Http\Request;

class QuickSellController extends Controller {
    public function quicksell() {
        $data              = [];
        $data['consumers'] = Consumer::all();

        return view('customer.transaction.quicksell', $data);
    }

    public function storeQuicksell(Request $request) {
        $data                   = [];
        $data['shop_id']        = SID();
        $data['consumer_id']    = $request->consumer_id;
        $data['total']          = $request->subtotal;
        $data['subtotal']       = $request->subtotal;
        $data['cash']           = $request->subtotal;
        $data['payment_method'] = 'Quick Sell';
        $data['note']           = $request->note;
        $data['profit']         = $request->profit;

        $order = Order::create($data);

        if ($request->hasFile('receipt')) {

            $image_file = $request->file('receipt');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/quicksell/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);

                $order->receipt = $final_name1;
                $order->save();
            }

        }

        return redirect()->back()->withToastSuccess('Order placed successfully!!');

    }

    public function editQuicksell($id) {
        $order     = Order::find($id);
        $consumers = Consumer::all();

        if (!$order || SID() !== $order->shop_id) {
            return redirect()->back()->withToastError('Unauthorized access!!');
        }

        return view('customer.transaction.edit-quicksell', compact('order', 'consumers'));
    }

    public function updateQuicksell(Request $request, $id) {
        $order                  = Order::find($id);
        $data                   = [];
        $data['shop_id']        = SID();
        $data['consumer_id']    = $request->consumer_id;
        $data['total']          = $request->subtotal;
        $data['subtotal']       = $request->subtotal;
        $data['cash']           = $request->subtotal;
        $data['payment_method'] = 'Quick Sell';
        $data['note']           = $request->note;
        $data['profit']         = $request->profit;
        $data['created_at']     = $request->current_date;

        $order->update($data);

        if ($request->hasFile('receipt')) {

            $image_file = $request->file('receipt');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/quicksell/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);

                $order->receipt = $final_name1;
                $order->save();
            }

        }

        return redirect()->route('customer.transaction')->withToastSuccess('Order update successfully!!');
    }

}
