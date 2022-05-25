<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomerLoginController extends Controller {
    public function login() {
        return view('customer.auth.login');
    }

    public function storeLogin(Request $request) {
        $validator = Validator::make($request->all(), [
            'phone'    => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if (Auth::guard('customer')->attempt(['phone' => $request->phone, 'password' => $request->password])) {
            return redirect()->route('customer.shop.list')->withToastSuccess('Login Successfull!!');
        }

        return redirect()->route('customer.login')->withToastError('Invalid Credentitials!!');
    }

    public function logout(Request $request) {
        Auth::guard('customer')->logout();

        return redirect()
            ->route('customer.login')
            ->withToastSuccess('Logout Successful!!');
    }

}
