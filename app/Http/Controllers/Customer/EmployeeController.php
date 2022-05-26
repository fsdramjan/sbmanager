<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $employees = Employee::where('shop_id',SID())->paginate(50);

        return view('customer.contact.employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('customer.contact.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/employee/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        Employee::create([
            'shop_id'     => SID(),
            'name'        => $request->name,
            'phone'       => $request->phone,
            'email'       => $request->email,
            'image'       => $final_name1 ?? null,
            'designation' => $request->designation,
            'employee_id' => $request->employee_id,
            'salary'      => $request->salary,
            'address'     => $request->address,
        ]);

        return redirect()->route('customer.employees.index')->withToastSuccess('employee added successfully!!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee) {
        return view('customer.contact.employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee) {

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $image_path = public_path($employee->image);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/employee/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $employee->update(
                    [
                        'image' => $final_name1,
                    ]
                );
            }

        }

        $employee->update([
            'name'        => $request->name,
            'phone'       => $request->phone,
            'email'       => $request->email,
            'designation' => $request->designation,
            'employee_id' => $request->employee_id,
            'salary'      => $request->salary,
            'address'     => $request->address,
        ]);

        return redirect()->route('customer.employees.index')->withToastSuccess('Employee updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee) {
        $image_path = public_path($employee->image);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $employee->delete();

        return redirect()->back()->withToastSuccess('Employee deleted successfully!!');
    }

}
