<?php

use App\Models\Consumer;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Supplier;

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

function GET_EMPLOYEE_BY_ID($id) {
    $employee = Employee::find($id);

    return $employee;
}

function GET_SUPPLIER_BY_ID($id) {
    $supplier = Supplier::find($id);

    return $supplier;
}

function GET_PRODUCT_BY_ID($id) {
    $product = Product::find($id);

    return $product;
}
