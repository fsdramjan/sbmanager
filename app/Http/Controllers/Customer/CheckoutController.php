<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Consumer;
use App\Models\Employee;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $data = [];
        $data['subtotal'] = session()->get('subtotal');
        $data['consumers'] = Consumer::all();
        $data['employees'] = Employee::all();

        return view('customer.checkout',$data);
    }
}
