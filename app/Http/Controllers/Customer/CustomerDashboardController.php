<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Customer;

class CustomerDashboardController extends Controller {
    public function dashboard() {
        $id              = auth()->guard('customer')->user()->id;
        $data            = [];
        // $data['courses'] = Course::where('customer_id', $id)->get();

        return view('frontend.customer.dashboard', $data);
    }
}
