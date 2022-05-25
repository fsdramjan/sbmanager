<?php

use App\Models\Shop;

function CID() {
    return session('customer_id');
}

function SID() {
    return session('shop_id');
}

function shop()
{
    $shop = Shop::where('customer_id',CID())->where('id',SID())->first();
    return $shop;
}