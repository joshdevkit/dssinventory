@extends('layouts.officeadmin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class = "text-success">Transactions</h1>
                    </div>
                    <div class="col-sm-6">

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
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Instructor</th>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>Purpose</th>
                                            <th>Datetime Borrowed</th>
                                            <th>Status</th>
                                            <th>Days Not Returned</th>
                                            <th>Datetime Returned</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($requests as $request)
                                            <tr>
                                                <td>{{ $request->id }}</td>
                                                <td>{{ $request->requested_by_name }}</td>
                                                <td>
                                                    @if ($request->item_type === 'Supplies')
                                                        {{ $request->supply_item }}
                                                    @elseif ($request->item_type === 'Equipments')
                                                        {{ $request->equipment_item }}
                                                    @endif
                                                </td>
                                                <td>{{ $request->quantity_requested }}</td>
                                                <td>{{ $request->purpose }}</td>
                                                <td>{{ $request->created_at }}</td>
                                                <td>{{ $request->status }}</td>
                                                <td>
                                                    {{ $request->item_type === 'Equipments' ? now()->diffInDays($request->created_at) : '' }}
                                                </td>
                                                <td>
                                                    @if ($request->status === 'Returned')
                                                        {{ date('F d, Y h:i A', strtotime($request->updated_at)) }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($request->status === 'Pending' && $request->item_type === 'Equipments')
                                                        <div class="dropdown">
                                                            <a class="btn btn-secondary dropdown-toggle" href="#"
                                                                role="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fas fa-cog"></i> Actions
                                                            </a>
                                                            <div class="dropdown-menu">
                                                                @if ($request->equipment_quantity > 0)
                                                                    <a class="dropdown-item status-option"
                                                                        data-status="Approved"
                                                                        data-id="{{ $request->id }}"
                                                                        href="#">Approved</a>
                                                                @endif
                                                                <a class="dropdown-item status-option"
                                                                    data-status="Declined" data-id="{{ $request->id }}"
                                                                    href="#">Declined</a>

                                                            </div>
                                                        </div>
                                                        {{-- <a class="btn btn-success status-option" data-status="Approved"
                                                            data-id="{{ $request->id }}" href="#">Approve</a>
                                                        <a class="btn btn-danger status-option" data-status="Declined"
                                                            data-id="{{ $request->id }}" href="#">Declined</a> --}}
                                                    @elseif ($request->status === 'Approved' && $request->item_type === 'Equipments')
                                                        <div class="dropdown">
                                                            <a class="btn btn-secondary dropdown-toggle" href="#"
                                                                role="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fas fa-cog"></i> Actions
                                                            </a>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item status-option"
                                                                    data-status="Received" data-id="{{ $request->id }}"
                                                                    href="#">Received</a>

                                                            </div>
                                                        </div>
                                                    @elseif ($request->status === 'Received' && $request->item_type === 'Equipments')
                                                        <div class="dropdown">
                                                            <a class="btn btn-secondary dropdown-toggle" href="#"
                                                                role="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fas fa-cog"></i> Configure
                                                            </a>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item status-option"
                                                                    data-status="Returned" data-id="{{ $request->id }}"
                                                                    href="#">Returned</a>
                                                                <a class="dropdown-item status-option" data-status="Damaged"
                                                                    data-id="{{ $request->id }}"
                                                                    href="#">Damaged</a>
                                                            </div>
                                                        </div>
                                                    @elseif ($request->status === 'Damaged' && $request->item_type === 'Equipments')
                                                        <div class="dropdown">
                                                            <a class="btn btn-secondary dropdown-toggle" href="#"
                                                                role="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fas fa-cog"></i> Actions
                                                            </a>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item status-option"
                                                                    data-status="Repaired" data-id="{{ $request->id }}"
                                                                    href="#">Repaired</a>
                                                                <a class="dropdown-item status-option" data-status="XXX"
                                                                    data-id="{{ $request->id }}" href="#">XXX</a>
                                                            </div>
                                                        </div>
                                                        {{-- <a class="btn btn-warning status-option" data-status="Repaired"
                                                            data-id="{{ $request->id }}" href="#">Repaired</a>
                                                        <a class="btn btn-danger status-option" data-status="XXX"
                                                            data-id="{{ $request->id }}" href="#">XXX</a> --}}
                                                    @endif

                                                    @if ($request->status === 'Pending' && $request->item_type === 'Supplies')
                                                        <div class="dropdown">
                                                            <a class="btn btn-secondary dropdown-toggle" href="#"
                                                                role="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fas fa-cog"></i> Configure
                                                            </a>
                                                            <div class="dropdown-menu">
                                                                @if ($request->supply_quantity > 0)
                                                                    <a class="dropdown-item status-option"
                                                                        data-status="Approved"
                                                                        data-id="{{ $request->id }}"
                                                                        href="#">Approved</a>
                                                                @endif
                                                                <a class="dropdown-item status-option"
                                                                    data-status="Declined" data-id="{{ $request->id }}"
                                                                    href="#">Declined</a>
                                                            </div>
                                                        </div>
                                                    @elseif ($request->status === 'Approved' && $request->item_type === 'Supplies')
                                                        <div class="dropdown">
                                                            <a class="btn btn-secondary dropdown-toggle" href="#"
                                                                role="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fas fa-cog"></i> Configure
                                                            </a>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item status-option"
                                                                    data-status="Received" data-id="{{ $request->id }}"
                                                                    href="#">Received</a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
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
                    <button type="button" class="btn btn-danger bg-red-500 text-white"
                        data-dismiss="modal">Cancel</button>
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
                    url: "{{ url('site-office/transactions/update') }}",
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
                const daysNotReturned = parseInt(row.find('td:nth-child(8)').text().trim(), 10);
                const status = row.find('td:nth-child(7)').text().trim();

                if (daysNotReturned >= 3 && status === 'Received') {
                    requestIds.push(requestId);
                    $.ajax({
                        url: '/office/notify-borrower',
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
