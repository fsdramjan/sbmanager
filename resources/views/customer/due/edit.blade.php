@extends('customer.layouts.master')
@section('title', SHOP()->name)
@section('cssStyle')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

    </style>
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('backend/css/icheck-bootstrap/icheck-bootstrap.min.css') }}">

@endsection
@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('customer.due.update',$dueDetails) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                <input type="hidden" name="due_details_id" value="{{ $dueDetails->id }}">
                                <input type="hidden" name="due_id" value="{{ $dueDetails->due->id }}">

                                <div class="d-flex justify-content-start">
                                    <div class="form-group mr-2">
                                        <label for="">Select Date:</label>
                                        <input type="datetime-local" name="current_date" id="" class="form-control"
                                            {{-- value="{{ $dueDetails->deuDetails[0]->created_at }}"--}}> 
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Add Image</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                        <img src="{{ asset($dueDetails->image) }}" style="height:50px">
                                    </div>
                                </div>

                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Select to due category</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <!-- checkbox -->
                                                <div class="form-group d-flex justify-content-between">
                                                    <div class="icheck-success">
                                                        <input type="radio" name="due_to" id="radioSuccess1"
                                                            value="Consumer" @if($dueDetails->due->due_to == 'Consumer') checked @endif>
                                                        <label for="radioSuccess1">
                                                            Consumer
                                                        </label>
                                                    </div>
                                                    <div class="icheck-success">
                                                        <input type="radio" name="due_to" id="radioSuccess2"
                                                            value="Supplier" @if($dueDetails->due->due_to == 'Supplier') checked @endif>
                                                        <label for="radioSuccess2">
                                                            Supplier
                                                        </label>
                                                    </div>
                                                    <div class="icheck-success">
                                                        <input type="radio" name="due_to" id="radioSuccess3"
                                                            value="Employee" @if($dueDetails->due->due_to == 'Employee') checked @endif>
                                                        <label for="radioSuccess3">
                                                            Employee
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Select to due mode</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <!-- checkbox -->
                                                <div class="form-group d-flex justify-content-between">
                                                    <div class="icheck-danger">
                                                        <input type="radio" name="due_type" id="radiodanger4" value="Due" @if($dueDetails->due_type === 'Due') checked @endif>
                                                        <label for="radiodanger4">
                                                            Due
                                                        </label>
                                                    </div>
                                                    <div class="icheck-success">
                                                        <input type="radio" name="due_type" id="radioSuccess5"
                                                            value="Deposit" @if($dueDetails->due_type === 'Deposit') checked @endif>
                                                        <label for="radioSuccess5">
                                                            Deposit
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{--  --}}
                                <div class="form-group consumer_body">
                                    <label>Name</label>
                                    <select class="form-control js-example-tags" style="width: 100%;" name="due_to_id">
                                        <option value="{{ $dueDetails->due->due_to_id }}">{{ $dueDetails->due->due_to_name }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Phone number</label>
                                    <input type="number" class="form-control" name="phone" value="{{ $dueDetails->due->due_to_phone }}"
                                        placeholder="Enter phone number">
                                </div>
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" class="form-control" name="amount" value="{{ $dueDetails->amount }}" placeholder="Enter due amount"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Due details(optional)</label>
                                    <textarea rows="2" class="form-control" name="details" placeholder="Enter due details">{{ $dueDetails->details }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
@section('jsScript')
    {{-- submenu dependency --}}
    <script type="text/javascript">
        $(".js-example-tags").select2({
            tags: true
        });
        
        $(document).ready(function() {
            $('input[name="due_to"]').on('click', function() {
                var category = $(this).val();
                if (category) {
                    $.ajax({
                        url: "{{ url('/get-category/') }}/" + category,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var d = $('select[name="due_to_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="due_to_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            })

            
        });
    </script>
@endsection
