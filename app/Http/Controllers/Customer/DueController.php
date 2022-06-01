<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Consumer;
use App\Models\Due;
use App\Models\DueDetail;
use App\Models\Employee;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DueController extends Controller {
    public function category($category) {

        if ($category === 'Consumer') {
            $person = Consumer::all();
        } elseif ($category === 'Supplier') {
            $person = Supplier::all();
        } elseif ($category === 'Employee') {
            $person = Employee::all();
        }

        return response()->json($person);
    }

    public function index() {
        $data         = [];
        $data['dues'] = Due::with('dueDetails')->orderBy('id', 'desc')->paginate(50);

        return view('customer.due.index', $data);
    }

    public function create() {
        $data              = [];
        $data['consumers'] = Consumer::all();

        return view('customer.due.create', $data);
    }

    public function store(Request $request) {

// dd($request->all());

        if ($request->due_to === 'Consumer') {
            $person = Consumer::find($request->due_to_id);

            if (!$person) {
                $person = Consumer::create([
                    'shop_id' => SID(),
                    'name'    => $request->due_to_id,
                    'phone'   => $request->phone,
                ]);
            }

        } elseif ($request->due_to === 'Supplier') {
            $person = Supplier::find($request->due_to_id);

            if (!$person) {
                $person = Supplier::create([
                    'shop_id' => SID(),
                    'name'    => $request->due_to_id,
                    'phone'   => $request->phone,
                ]);
            }

        } elseif ($request->due_to === 'Employee') {
            $person = Employee::find($request->due_to_id);

            if (!$person) {
                $person = Employee::create([
                    'shop_id' => SID(),
                    'name'    => $request->due_to_id,
                    'phone'   => $request->phone,
                ]);
            }

        }

        $due = Due::create([
            'shop_id'     => SID(),
            'due_to'      => $request->due_to,
            'due_to_id'   => $person->id,
            'due_to_name' => $person->name,
            'created_at'  => $request->current_date,
        ]);

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/due/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        DueDetail::create([
            'due_id'   => $due->id,
            'amount'   => $request->amount,
            'due_type' => $request->due_type,
            'details'  => $request->details,
            'image'    => $final_name1,
        ]);

        return redirect()->back()->withToastSuccess('Due book updated!!');
    }

}
