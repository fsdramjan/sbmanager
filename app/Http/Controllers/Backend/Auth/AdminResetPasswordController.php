<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class AdminResetPasswordController extends Controller {
    public function resetPassword(Request $request) {
        return view('backend.auth.reset-password', ['request' => $request]);
    }

    public function storeForgotPassword(Request $request) {

        $validator = Validator::make($request->all(), [
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|confirmed|min:8', Rules\Password::defaults(),
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        $password = DB::table('password_resets')->where('email', $request->email)->where('token', $request->token)->first();

        if (!$password) {
            return redirect()->back()->withToastInfo('Something went wrong, Invalid token or email!!');
        }

        $admin = Admin::where('email', $request->email)->first();

        if ($admin && $password) {
            $admin->update(['password' => bcrypt($request->password)]);

            $password = DB::table('password_resets')->where('email', $request->email)->delete();

            return redirect()->route('admin.login')->withToastSuccess('New password reset successfully!!');
        } else {
            return redirect()->back()->withToastError('The email is no longer our record!!');
        }

    }

}
