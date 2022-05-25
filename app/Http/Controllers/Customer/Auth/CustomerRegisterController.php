<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomerRegisterController extends Controller {
    public function register() {
        return view('customer.auth.register');
    }

    public function storeRegister(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'    => 'required',
            'phone'   => 'required|unique:customers',
            'email'   => 'required|email|unique:customers,email',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        Customer::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'phone'    => $request->phone,
            'address'  => $request->address,
        ]);

        return redirect()->route('customer.login')->withToastSuccess('Your request submitted successfully!!');
    }

    public function profile() {
        $profile = Customer::findOrFail(auth()->guard('customer')->user()->id);

        return view('frontend.customer.profile', compact('profile'));
    }

    public function profileUpdate(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name'    => 'required',
            'phone'   => 'required',
            'message' => 'required',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        $profile = Customer::find($id);

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/customer/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $profile->update(
                    [
                        'image' => $final_name1,
                    ]
                );
            }

        }

        $profile->update([
            'name'        => $request->name,
            'phone'       => $request->phone,
            'message'     => $request->message,
            'details'     => $request->details,
            'designation' => $request->designation,
        ]);

        return redirect()->back()->withToastSuccess('Profile Updated successfully!!');

    }

}
