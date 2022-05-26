<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Instructor;
use App\Models\User;
use Illuminate\Http\Request;

class BackendManagementController extends Controller {

    public function customerList() {
        $customers = Customer::orderBy('id', 'desc')->paginate(50);

        return view('backend.auth.customer-list', compact('customers'));
    }

    public function userList() {
        $users = user::orderBy('id', 'desc')->paginate(50);

        return view('backend.auth.user-list', compact('users'));
    }
}
