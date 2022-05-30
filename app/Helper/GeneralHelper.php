<?php

use App\Models\Consumer;
use App\Models\Product;
use App\Models\Shop;

function CID() {
    return session('customer_id');
}

function SID() {
    return session('shop_id');
}

function SHOP() {
    $shop = Shop::where('customer_id', CID())->where('id', SID())->first();

    return $shop;
}

function GET_CONSUMER_BY_ID($id) {
    $consumer = Consumer::find($id);

    return $consumer;
}

function GET_PRODUCT_BY_ID($id) {
    $product = Product::find($id);

    return $product;
}
