@extends('layouts.superadmin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class = "text-success">Transactions</h1>
                    </div>
                 
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>User Name</th>
                                            <th>Quantity</th>
                                            <th>Purpose</th>
                                            <th>Datetime Borrowed</th>
                                            <th>Status</th>
                                            <th>Days Not Returned</th>
                                            <th>Datetime Returned</th>
                                            @hasrole('laboratory')
                                                <th>Actions</th>
                                            @endhasrole
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($requisitions as $requisition)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $requisition->instructor_name }}</td>
                                                <td>
                                                    @if ($requisition->category === 'Construction')
                                                        {{ $requisition->construction_item_quantity }}
                                                    @elseif($requisition->category === 'Testings')
                                                        {{ $requisition->testing_item_quantity }}
                                                    @elseif($requisition->category === 'Surveying')
                                                        {{ $requisition->surveying_item_quantity }}
                                                    @elseif($requisition->category === 'Fluids')
                                                        {{ $requisition->fluid_item_quantity }}
                                                    @elseif($requisition->category === 'ComputerEngineering')
                                                        {{ $requisition->computer_engineering_item_quantity }}
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $requisition->activity }}
                                                </td>
                                                <td>{{ date('F d, Y h:i A', strtotime($requisition->date_time_filed)) }}
                                                </td>
                                                <td>{{ $requisition->status }}
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($requisition->date_time_filed)->diffInDays(now()) }}
                                                    days
                                                </td>

                                                <td></td>
                                                @hasrole('laboratory')
                                                    <td class="d-flex flex-auto">
                                                        @if ($requisition->status != 'Approved and Prepared')
                                                            <div class="dropdown">
                                                                <a class="btn btn-secondary dropdown-toggle" href="#"
                                                                    role="button" data-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fas fa-cog"></i> Configure
                                                                </a>
                                                                <div class="dropdown-menu">
                                                                    @if ($requisition->status === 'Pending')
                                                                        <a class="dropdown-item status-option"
                                                                            data-status="Approved"
                                                                            data-id="{{ $requisition->id }}"
                                                                            href="{{ route('borrows.show', ['id' => $requisition->id]) }}">Approved</a>
                                                                        <a class="dropdown-item status-option"
                                                                            data-status="Declined"
                                                                            data-id="{{ $requisition->id }}"
                                                                            href="{{ route('borrows.show', ['id' => $requisition->id]) }}">Declined</a>
                                                                    @elseif ($requisition->status === 'Approved')
                                                                        <a class="dropdown-item status-option"
                                                                            data-status="Received"
                                                                            data-id="{{ $requisition->id }}"
                                                                            href="#">Received</a>
                                                                    @elseif($requisition->status == 'Accepted by Dean')
                                                                        <a class="dropdown-item status-option"
                                                                            data-status="Returned"
                                                                            data-id="{{ $requisition->id }}"
                                                                            href="#">Returned</a>
                                                                        <a class="dropdown-item status-option"
                                                                            data-status="Damaged"
                                                                            data-id="{{ $requisition->id }}"
                                                                            href="#">Damaged</a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
                                                @endhasrole
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>



@endsection
@section('scripts')
