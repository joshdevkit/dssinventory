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
                                                        <button class="btn btn-secondary show-items" data-toggle="modal"
                                                            data-target="#itemsOnRequestEquipment"
                                                            data-id="{{ $request->id }}">
                                                            Click to show items
                                                        </button>
                                                    @endif
                                                </td>
                                                <td>{{ $request->quantity_requested }}</td>
                                                <td>{{ $request->purpose }}</td>
                                                <td>{{ date('F d, Y h:i A', strtotime($request->created_at)) }}</td>
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
                                                                <a class="dropdown-item status-option"
                                                                    data-status="Approved" data-id="{{ $request->id }}"
                                                                    href="#">Approved</a>
                                                                {{-- <a class="dropdown-item"
                                                                    href="{{ route('office-transactions-details-data', ['id' => $request->id]) }}">View
                                                                    Request
                                                                    Details</a> --}}
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
                                                                <i class="fas fa-cog"></i> Actions
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
                                                                <i class="fas fa-cog"></i> Actions
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
                                                                role="button" data-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="fas fa-cog"></i> Actions
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

    <!-- equipment request items -->
    <div class="modal fade" id="itemsOnRequestEquipment" tabindex="-1" aria-labelledby="itemsOnRequestEquipmentLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="itemsOnRequestEquipmentLabel">Equipment Request Items</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="list-group" id="items_display">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="select-items-good">Select items you wish to mark
                        as good</button>
                    <button type="button" class="btn btn-success d-none" id="submit-selected-items">Submit
                        Selected</button>
                    <button type="button" class="btn btn-danger d-none" id="cancel-select-items">Cancel</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
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

            $(document).on('click', '.show-items', function() {
                var requestId = $(this).data('id');
                $.ajax({
                    url: "{{ route('office-admin.transactions-details', ['']) }}/" + requestId,
                    method: 'GET',
                    data: {
                        id: requestId
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        var itemsDisplay = $('#items_display');
                        itemsDisplay.empty();

                        if (response.length === 0) {
                            itemsDisplay.append(
                                '<div class="list-group-item text-center text-muted">No items found</div>'
                            );
                        } else {
                            const items = response; // Save the response data to a variable

                            items.forEach(function(item) {
                                console.log(item);

                                var itemHtml = `
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="item-details">
                                        <strong>Equipment Item:</strong> ${item.equipment_item} <br>
                                        <strong>Serial No:</strong> ${item.equipment_serial}
                                    </div>
                            `;
                                if (item.status === 'Returned' && item
                                    .equipment_status === "Queue") {
                                    itemHtml += `
                                <div>
                                    <button class="btn btn-danger btn-sm mark-damaged" data-item-id="${item.equipment_serial_id}">
                                        <i class="fas fa-times-circle"></i> Damaged
                                    </button>
                                `;
                                    if (item.equipment_notes === null && item
                                        .equipment_status != "Good") {
                                        itemHtml += `
                                    <button class="btn btn-info btn-sm add-note" data-item-id="${item.equipment_serial_id}">
                                        <i class="far fa-copy"></i> Add Notes
                                    </button>
                                `;
                                    }
                                    itemHtml += `</div>`;
                                }
                                itemHtml += '</div>';
                                $('#items_display').append(itemHtml);
                            });




                            $('#select-items-good').on('click', function() {
                                $('.item-details').each(function(index, element) {
                                    const item = items[index];
                                    if (item.equipment_status !== 'Good') {
                                        const itemId = item.equipment_serial_id;
                                        $(element).prepend(`
                                        <input type="checkbox" class="item-checkbox" data-item-id="${itemId}" style="margin-right: 10px;">
                                    `);
                                    }
                                });
                                $(this).addClass('d-none');
                                $('#submit-selected-items').removeClass('d-none');
                                $('#cancel-select-items').removeClass('d-none');
                            });

                            $('#submit-selected-items').on('click', function() {
                                var selectedItems = [];
                                $('.item-checkbox:checked').each(function() {
                                    selectedItems.push($(this).data('item-id'));
                                });

                                $.ajax({
                                    url: '{{ route('office.submit-good-items') }}',
                                    method: 'POST',
                                    data: {
                                        selected_items: selectedItems,
                                        _token: '{{ csrf_token() }}'
                                    },
                                    success: function(response) {
                                        console.log(response);
                                        if (response.status == "success") {
                                            location.reload()
                                        }
                                    },
                                    error: function(response) {
                                        alert(
                                            'Failed to submit selected items.'
                                        );
                                    }
                                });
                            });

                            $('#cancel-select-items').on('click', function() {
                                $('.item-checkbox').remove();
                                $('#select-items-good').removeClass('d-none');
                                $('#submit-selected-items').addClass('d-none');
                                $('#cancel-select-items').addClass('d-none');
                            });
                        }
                    }


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

            $(document).on('click', '.add-note', function() {
                var itemId = $(this).data('item-id');
                var itemDiv = $(this).closest('.list-group-item');

                var notesHtml = `
                    <div class="form-group mt-2" id="note-added-section-${itemId}">
                        <label for="added-notes-${itemId}">Notes:</label>
                        <textarea class="form-control" id="added-notes-${itemId}" rows="3" placeholder="Enter notes..."></textarea>
                        <button class="btn btn-primary btn-sm mt-2 submit-added-notes" data-item-id="${itemId}">Submit</button>
                        <button class="btn btn-secondary btn-sm mt-2 cancel-added-notes" data-item-id="${itemId}">Cancel</button>
                    </div>
                `;

                itemDiv.after(notesHtml);

                $(this).prop('disabled', true);
            });

            $(document).on('click', '.cancel-added-notes', function() {
                var itemId = $(this).data('item-id');
                $(`#note-added-section-${itemId}`).remove();
                $(`button.add-note[data-item-id="${itemId}"]`).prop('disabled', false);
            });

            $(document).on('click', '.submit-added-notes', function() {
                var itemId = $(this).data('item-id');
                var notes = $(`#added-notes-${itemId}`).val();

                $.ajax({
                    url: '{{ route('office.submit-added-notes') }}',
                    method: 'POST',
                    data: {
                        item_id: itemId,
                        notes: notes,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            $(`#note-added-section-${itemId}`).remove();
                            $(`button.add-note[data-item-id="${itemId}"]`).prop('disabled',
                                false);
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        } else {
                            alert('Failed to submit notes.');
                        }
                    },
                    error: function(response) {
                        alert('Failed to submit notes.');
                    }
                });
            });


        });
    </script>
@endsection
