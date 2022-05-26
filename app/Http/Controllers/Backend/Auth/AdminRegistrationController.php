<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AdminRegistrationController extends Controller {
    public function adminList() {
        $admins = Admin::all();

        return view('backend.auth.admin-list', compact('admins'));
    }

    public function customerList() {
        $customers = User::all();

        return view('backend.auth.customer-list', compact('customers'));
    }

    public function createAdmin() {
        return view('backend.auth.create-admin');
    }

    public function storeAdmin(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'phone'    => 'required|numeric',
            'email'    => 'required|email|unique:admins',
            'password' => 'required',
            'address'  => 'required',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/admin/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        $admin           = new Admin();
        $admin->name     = $request->name;
        $admin->phone    = $request->phone;
        $admin->email    = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->address  = $request->address;
        $admin->image    = $final_name1 ?? '';
        $admin->status   = 1;

        // $admin->admin_user    = $request->admin_user;
        // $admin->company       = $request->company;
        // $admin->main_menu     = $request->main_menu;
        // $admin->product       = $request->product;
        // $admin->collection    = $request->collection;
        // $admin->offer         = $request->offer;
        // $admin->order_history = $request->order_history;

        $admin->save();

        return redirect()->route('admin.adminList')->withToastSuccess('New Amin Registered Successfully!!');
    }

    public function editAdmin(Admin $admin) {
        return view('backend.auth.edit-admin', compact('admin'));
    }

    public function updateAdmin(Request $request, Admin $admin) {
        
        $validator = Validator::make($request->all(), [
            'name'    => 'required',
            'phone'   => 'required',
            'email'   => 'required|email|unique:admins,email,' . $admin->id,
            'address' => 'required',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $image_path = public_path($admin->image);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/admin/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $admin->image = $final_name1;
                $admin->save();

            }

        }

        $admin->name    = $request->name;
        $admin->phone   = $request->phone;
        $admin->email   = $request->email;
        $admin->address = $request->address;

        // $admin->admin_user    = $request->admin_user;
        // $admin->company       = $request->company;
        // $admin->main_menu     = $request->main_menu;
        // $admin->product       = $request->product;
        // $admin->collection    = $request->collection;
        // $admin->offer         = $request->offer;
        // $admin->order_history = $request->order_history;

        $admin->save();
        return redirect()->route('admin.adminList')->withToastSuccess('The admin updated successfully!!');
    }

    public function activeAdmin(Request $request, Admin $admin) {
        $admin->status = 1;
        $admin->save();

        return redirect()->back()->withToastSuccess('The admin activated successfully!!');
    }

    public function inactiveAdmin(Request $request, Admin $admin) {
        $admin->status = 0;
        $admin->save();

        return redirect()->back()->withToastSuccess('The admin inactivated successfully!!');
    }

    public function deleteAdmin(Request $request, Admin $admin) {
        $image_path = public_path($admin->image);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $admin->delete();

        return redirect()->back()->withToastSuccess('The admin deleted successfully!!');
    }

    public function userList() {
        $users = User::orderBy('id', 'desc')->paginate(50);

        return view('backend.auth.user-list', compact('users'));
    }

}
