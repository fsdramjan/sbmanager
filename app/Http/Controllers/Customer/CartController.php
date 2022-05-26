<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller {
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
            'status'       => 'success',
            'cart_count'   => Cart::count(),
            'cart_content' => Cart::content(),
        ]);
    }

    public function cc() {
        print_r(Cart::content());
    }

}
