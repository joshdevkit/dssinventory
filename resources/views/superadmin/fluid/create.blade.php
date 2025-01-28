@extends('layouts.superadmin')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">

                <!-- Page Heading -->


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-success ">Add Equipment</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">

                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="container-fluid">

            <div class="card card-success">
                <div class="card-header">
                    <h1 class="card-title"> Hydraulics and Fluid Mechanics</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('superadmin.fluid.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1">Equipment</label>
                                <input type="text" class="form-control" id="equipment" name="equipment"
                                    placeholder="Enter Equipment">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputPassword1">Brand</label>
                                <input type="text" class="form-control" id="brand" name="brand"
                                    placeholder="Enter Brand">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="date_acquired" name="date_acquired"
                                    class="form-label">{{ 'Date Acquired' }}</label>
                                <input type="date" class="form-control" id="date_acquired"
                                    placeholder="{{ __('date_acquired') }}" name="date_acquired"
                                    value="{{ old('date_acquired') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputCondition">{{ __('Unit') }}</label>
                                <select class="form-control select2" id="unit" name="unit"
                                    data-placeholder="Select Unit" style="width: 100%;">
                                    <option>unit</option>
                                    <option>pcs</option>
                                    <option>set</option>
                                    <option>box</option>
                                    <option>-</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Description</label>
                                    <textarea type="paragraph" class="form-control" id="description" name="description" placeholder="Enter Description"></textarea>
                                </div>
                            </div>



                        </div>
                        <div class="row" id="form-template">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputCondition">{{ __('Serial Number') }}</label>
                                    <input type="text" name="serial_no[]" id="serial_no[]" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputCondition">{{ __('condition') }}</label>
                                    <select class="form-control" id="condition[]" name="condition[]"
                                        data-placeholder="Select Condition" style="width: 100%;">
                                        <option>Good</option>
                                        <option>For Repair</option>
                                        <option>For Upgrading</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1" style="margin-top: 2rem">
                                <div class="form-group">
                                    <button type="button" id="add-row" class="btn btn-primary bg-blue-500 text-white"><i
                                            class="fas fa-plus"></i></button>
                                </div>
                            </div>

                        </div>
                        <div id="dynamic_serial">

                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                                <a type="cancel" class="btn btn-danger"
                                    href="{{ url('/superadmin/fluid') }}">{{ __('Exit') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>



@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#add-row').click(function() {
                var newRow = `
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputCondition">{{ __('Serial Number') }}</label>
                            <input type="text" name="serial_no[]" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="exampleInputCondition">{{ __('Condition') }}</label>
                            <select class="form-control" name="condition[]" data-placeholder="Select Condition" style="width: 100%;">
                                <option>Good</option>
                                <option>For Repair</option>
                                <option>For Upgrading</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1" style="margin-top: 2rem">
                        <div class="form-group">
                            <button type="button" class="btn btn-danger bg-blue-500 text-white remove-row"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                </div>`;
                $('#dynamic_serial').append(newRow);
            });

            // Remove row functionality
            $(document).on('click', '.remove-row', function() {
                $(this).closest('.row').remove();
            });
        });
    </script>
@endsection
