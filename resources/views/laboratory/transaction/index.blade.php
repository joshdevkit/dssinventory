@extends('layouts.labadmin')

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
                                <div class="table-responsive">
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
                                                    <td>{{ $requisition->id }}</td>
                                                    <td>{{ $requisition->instructor_name }}</td>
                                                    <td>
                                                        @if ($requisition->category === 'Constructions')
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
                                                    <td>
                                                        {{ date('F d, Y h:i A', strtotime($requisition->date_time_filed)) }}
                                                    </td>
                                                    <td>{{ $requisition->status }}
                                                    </td>
                                                    <td>
                                                        {{ $requisition->status === 'Returned' ? '' : \Carbon\Carbon::parse($requisition->date_time_filed)->diffInDays(now()) . ' days' }}

                                                    </td>

                                                    <td>
                                                        {{ $requisition->status === 'Returned' ? date('F d, Y h:i A', strtotime($requisition->returned_date)) : '' }}
                                                    </td>
                                                    @hasrole('laboratory')
                                                        <td class="d-flex flex-auto">
                                                            <a class="btn btn-primary btn-sm mr-3"
                                                                href="{{ route('borrows.show', ['id' => $requisition->id]) }}"><i
                                                                    class="fas fa-eye"></i></a>
                                                            @if (
                                                                $requisition->status != 'Approved and Prepared' &&
                                                                    $requisition->status != 'Returned' &&
                                                                    $requisition->status != 'Damaged' &&
                                                                    $requisition->status != 'Repaired' &&
                                                                    $requisition->status != 'Declined' &&
                                                                    $requisition->status != 'XXX')
                                                                <div class="dropdown">
                                                                    <a class="btn btn-secondary dropdown-toggle" href="#"
                                                                        role="button" data-toggle="dropdown"
                                                                        aria-expanded="false">
                                                                        <i class="fas fa-cog"></i> Action
                                                                    </a>
                                                                    <div class="dropdown-menu">
                                                                        @if ($requisition->status === 'Pending')
                                                                            @if (
                                                                                $requisition->computer_engineering_actual_quantity > 0 ||
                                                                                    $requisition->testing_actual_quantity > 0 ||
                                                                                    $requisition->surveying_actual_quantity > 0 ||
                                                                                    $requisition->fluid_actual_quantity > 0 ||
                                                                                    $requisition->computer_engineering_actual_quantity > 0)
                                                                                <a class="dropdown-item" data-status="Approved"
                                                                                    data-id="{{ $requisition->id }}"
                                                                                    href="{{ route('borrows.show', ['id' => $requisition->id]) }}">Approved</a>
                                                                            @endif
                                                                            <a class="dropdown-item " data-status="Declined"
                                                                                data-id="{{ $requisition->id }}"
                                                                                href="{{ route('borrows.show', ['id' => $requisition->id]) }}">Declined</a>
                                                                        @elseif ($requisition->status === 'Approved')
                                                                            <a class="dropdown-item status-option"
                                                                                data-status="Received"
                                                                                data-id="{{ $requisition->id }}"
                                                                                href="#">Received</a>
                                                                        @elseif($requisition->status == 'Accepted by Dean')
                                                                            <a class="dropdown-item status-option"
                                                                                data-status="Received"
                                                                                data-id="{{ $requisition->id }}"
                                                                                href="#">Received</a>
                                                                        @elseif($requisition->status == 'Received')
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
                                                            @elseif($requisition->status === 'Damaged')
                                                                <a class="btn btn-secondary dropdown-toggle" href="#"
                                                                    role="button" data-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fas fa-cog"></i> Action
                                                                </a>
                                                                <div class="dropdown-menu">

                                                                    <a class="dropdown-item status-option"
                                                                        data-status="Repaired" data-id="{{ $requisition->id }}"
                                                                        href="#">Repaired</a>
                                                                    <a class="dropdown-item status-option" data-status="XXX"
                                                                        data-id="{{ $requisition->id }}" href="#">XXX</a>
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
            </div>

        </section>
    </div>
    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Change Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to set the status to <strong id="statusText"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger bg-red-500 text-white" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success bg-green-600 text-white"
                        id="confirmStatusBtn">Confirm</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            var selectedStatus = '';
            var requestId = '';
            $('.status-option').on('click', function(event) {
                event.preventDefault();
                selectedStatus = $(this).data('status');
                requestId = $(this).data('id');
                $('#statusText').text(selectedStatus);
                $('#statusModal').modal('show');
            });

            $('#confirmStatusBtn').on('click', function() {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('lab.transactions.update') }}',
                    method: 'POST',
                    data: {
                        id: requestId,
                        status: selectedStatus,
                        _token: csrfToken
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#statusModal').modal('hide');
                        setTimeout(() => {
                            location.reload()
                        }, 1500);
                        console.log(response)
                    },
                });
            });
        });

        $(document).ready(function() {

            let requestIds = [];
            $('#example1 tbody tr').each(function() {
                const row = $(this);
                const requestId = row.find('td:nth-child(1)').text().trim();
                const dateText = row.find('td:nth-child(5)').text().trim(); // Parse the date
                const dateValue = new Date(dateText); // Get the current date
                const currentDate = new Date(); // Calculate the difference in time
                const diffTime = Math.abs(currentDate - dateValue); // Convert time difference to days
                const daysNotReturned = Math.ceil(diffTime / (1000 * 60 * 60 *
                    24)); // Use the daysNotReturned value as needed
                console.log(daysNotReturned);
                const status = row.find('td:nth-child(6)').text().trim();

                if (daysNotReturned >= 3 && status === 'Received') {
                    requestIds.push(requestId);
                    $.ajax({
                        url: '{{ route('notify.user') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            request_ids: requestIds,
                        },
                        success: function(response) {
                            if (status !== 'Returned') {
                                row.addClass('table-danger');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(
                                `Failed to notify borrower for request ID ${requestId}: ${error}`
                            );
                        }
                    });
                }
            });
        });
    </script>
@endsection
