<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Mail\CustomerResetPasswordLink;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CustomerForgotPasswordController extends Controller {
    public function forgotPassword() {
        return view('customer.auth.forgot-password');
    }

    public function storeForgotPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        $customer = Customer::where('email', $request->email)->first();

        if (!$customer) {
            return redirect()->back()->withToastError('This email is no longer with our records!!');
        }

        $url = route('customer.resetPassword', [$request->_token, 'email' => $request->email]);

        Mail::to($request->email)->send(new CustomerResetPasswordLink($url));

        DB::table('password_resets')->insert([
            'token'      => $request->_token,
            'email'      => $request->email,
            'created_at' => now(),
        ]);

        return redirect()->back()->withToastSuccess('We have sent a fresh reset password link!!');
    }

}
