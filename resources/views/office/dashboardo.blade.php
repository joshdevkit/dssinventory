@extends('layouts.officeadmin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class = "text-success">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">

                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    @php
                        $boxes = [
                            'supplies' => 'Supplies',
                        ];
                    @endphp
                    @foreach ($boxes as $key => $title)
                        <div class="col-lg-6 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $totals[$key] }}</h3>
                                    <p>{{ $title }}</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-clipboard"></i>
                                </div>
                                <a href="{{ url('/office/supplies') }}" class="small-box-footer">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach

                    @php
                        $boxes = [
                            'equipment' => 'Equipments',
                        ];
                    @endphp
                    @foreach ($boxes as $key => $title)
                        <div class="col-lg-6 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $totals[$key] }}</h3>
                                    <p>{{ $title }}</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-exchange-alt"></i>
                                </div>
                                <a href="{{ url('/office/equipment') }}" class="small-box-footer">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach


                </div>

                <div class="card">
                    <div class="card-header">
                        <h4>Latest Transaction</h4>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Purpose</th>
                                    <th>Datetime Borrowed</th>
                                    <th>Status</th>
                                    <th>Days Not Returned</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $request)
                                    @if ($request->item_type === 'Equipments')
                                        <tr>
                                            <td>{{ $request->id }}</td>
                                            <td>{{ $request->requested_by_name }}</td>
                                            <td>{{ $request->equipment_item }}</td>
                                            <td>{{ $request->quantity_requested }}</td>
                                            <td>{{ $request->purpose }}</td>
                                            <td>{{ $request->created_at }}</td>
                                            <td>{{ $request->status }}</td>
                                            <td>
                                                {{ now()->diffInDays($request->created_at) }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">
                                Number of transactions (Site Office)
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <canvas id="pieChart2"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>
    </div>


    <script>
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



    <script>
        $(document).ready(function() {

            $.ajax({
                url: "{{ route('site-office.chart') }}",
                method: 'GET',
                success: function(data) {

                    const labels = Object.keys(data);
                    const values = Object.values(data);
                    var ctx = $('#pieChart2')[0].getContext('2d');
                    var pieChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Requisitions by Category',
                                data: values,
                                backgroundColor: ['#FF5733', '#33A1FF', '#FFEB33',
                                    '#33FF57'
                                ],
                                borderColor: ['#FF5733', '#33A1FF', '#FFEB33',
                                    '#33FF57'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.label + ': ' + tooltipItem
                                                .raw;
                                        }
                                    }
                                }
                            }
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        });
    </script>
@endsection
