<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller {
    public function cart() {
        $data             = [];
        $data['cart']     = Cart::content();
        $data['total']    = Cart::subtotal();
        $data['discount'] = session()->get('discount') ?? null;

        if (session()->get('discount') > 0) {
            $subtotal = Cart::subtotal() - session()->get('discount');
        } else {
            $subtotal = Cart::subtotal();
        }

        session(['subtotal' => $subtotal]);

        $data['subtotal'] = session()->get('subtotal');

        return view('customer.cart', $data);
    }

    public function addToCart(Request $request) {
        $data    = [];
        $product = Product::where('id', $request->id)->first();

        if (!$product) {
            return response()->json([
                'status' => 'noSuccess',
            ]);
        }

        $data['id']               = $product->id;
        $data['name']             = $product->name;
        $data['qty']              = 1;
        $data['price']            = $product->price;
        $data['weight']           = 1;
        $data['options']['image'] = $product->image;

        Cart::add($data);

        return response()->json([
            'status'        => 'success',
            'cart_count'    => Cart::count(),
            'cart_content'  => Cart::content(),
            'cart_subtotal' => Cart::subtotal(),
        ]);
    }

    public function cc() {
        print_r(Cart::content());
    }

    public function removeFromCart($rowId) {
        Cart::remove($rowId);

        return redirect()->back()->withToastSuccess('Product removed successfully!!');
    }

    public function updateCart(Request $request) {
        $row = [];

        foreach ($request->row_id as $key => $row) {
            $rowId = $row;
            $qty   = $request->quantity[$key];
            Cart::update($rowId, $qty);
        }

        return redirect()->back()->withToastSuccess('Cart updated successfully!!');
    }

    public function extraDiscount(Request $request) {
        session(['discount' => $request->discount, 'subtotal' => $request->subtotal]);

        return response()->json();
    }

}
