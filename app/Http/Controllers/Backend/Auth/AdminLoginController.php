<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminLoginController extends Controller {
    public function login() {
        return view('backend.auth.login');
    }

    public function storeLogin(Request $request) {
        $validator = Validator::make($request->all(), [
            'email'    => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('admin.login')->withToastError('Invalid Credentitials!!');

    }

    public function logout(Request $request) {
        Auth::guard('admin')->logout();

        return redirect()
            ->route('admin.login')
            ->withToastSuccess('Logout Successful!!');
    }

}
