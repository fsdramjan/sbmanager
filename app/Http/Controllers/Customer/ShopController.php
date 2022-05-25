<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller {

    public function list() {
        $data = [];

        $data['shops'] = Shop::where('customer_id', Auth::id())->get();

        return view('customer.shop.list', $data);
    }

    public function store(Request $request) {

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/shop/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        Shop::create([
            'customer_id' => Auth::id(),
            'name'        => $request->name,
            'image'       => $final_name1,
        ]);

        return redirect()->back()->withToastSuccess('New shop created successfu;;y!!');
    }

}
