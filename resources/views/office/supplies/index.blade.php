@extends('layouts.officeadmin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
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
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class = "text-success">Office Supplies</h1>
                    </div>
                    <div class="col-sm-6">

                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">

                                <a href="{{ route('supplies.create') }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-plus"></i> Add Supplies
                                </a>
                                <div class="flex float-right">
                                    <button class="btn btn-primary btn-sm ml-2" id="print-btn">
                                        <i class="fas fa-print"></i> Print
                                    </button>
                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="adminLteDataTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>QTY</th>
                                            <th>Unit</th>
                                            <th>Name of Equipment</th>
                                            <th>Description/Specification</th>
                                            <th>Location/Room</th>
                                            <th>Date Delivered</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($supplies as $supply)
                                            <tr data-entry-id="{{ $supply->id }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $supply->items->count() }}</td>
                                                <td>{{ $supply->unit }}</td>
                                                <td>{{ $supply->item }}</td>
                                                <td>{{ $supply->brand_description }}</td>
                                                <td>{{ $supply->location }}</td>
                                                <td>{{ $supply->date_delivered }}</td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group"
                                                        aria-label="Basic example">
                                                        <a href="{{ route('supplies.show', $supply->id) }}"
                                                            class="btn btn-info bg-blue-500 py-2 rounded-lg mr-2 text-white">View
                                                            More</a>
                                                        <form action="{{ route('supplies.edit', $supply->id) }}">
                                                            <button class="btn btn-secondary">
                                                                <i class="fa fa-pencil-alt"></i>
                                                            </button>
                                                        </form>
                                                        &nbsp
                                                        <form action="{{ route('supplies.destroy', $supply->id) }}"
                                                            method="POST" onsubmit="return confirm('Are you sure?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger bg-red-500 text-white">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            @empty
                                            <tr>
                                                <td colspan="7" class="text-center">{{ __('Data Empty') }}</td>
                                            </tr>
                                        @endforelse

                                    </tbody>

                                </table>

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
        <!-- /.content -->
    </div>
@endsection
@section('scripts')
    <script>
        document.getElementById('print-btn').addEventListener('click', function() {
            let dataTable = document.querySelector('#adminLteDataTable').cloneNode(true);

            let theadRow = dataTable.querySelector('thead tr');
            theadRow.removeChild(theadRow.lastElementChild);

            let tbodyRows = dataTable.querySelectorAll('tbody tr');
            tbodyRows.forEach(function(row) {
                row.removeChild(row.lastElementChild);
            });

            let printWindow = window.open('', '', 'width=1200,height=1200');

            printWindow.document.write(`
<html>
<head>
<title>Print Computer Engineering Data</title>
<style>
@media print {
    @page {
        size: portrait;
        margin: 1cm;
    }

    body {
        font-family: "Times New Roman", serif;
    }

    h1,
    h2,
    h3 {
        text-align: center;
    }

    h1 {
        font-family: "Old English Text MT", serif;
    }

    h2 {
        font-weight: bold;
        text-transform: uppercase;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table th,
    table td {
        border: 1px solid black;
        padding: 5px;
        text-align: left;
        font-size: 12px;
    }

    table th {
        background-color: #f2f2f2;
    }
}

.header {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
}

.header img {
    width: 50px;
    height: 50px;
    margin-right: 10px;
}

.header-content {
    text-align: center;
}

.header-content h1 {
    font-weight: normal;
    font-family: "Old English Text MT", serif;
    margin: 0;
}

.header-content h3 {
    font-family: "Times New Roman", serif;
    margin: 0;
}

.school-title {
    text-align: center;
    margin-bottom: 20px;
}
</style>
</head>
<body>
<div class="header">
    <img src="{{ asset('dist/img/spup1.png') }}" alt="Logo">
    <div class="header-content">
        <h1>Saint Paul University Philippines</h1>
        <h3>Tuguegarao City, Cagayan 3500</h3>
    </div>
</div>

<div class="school-title">
    <h4>SCHOOL OF INFORMATION TECHNOLOGY AND ENGINEERING</h4>
    <h5><strong>SITE SUPPLIES</strong></h5>
</div>
${dataTable.outerHTML}
</body>
</html>
`);

            printWindow.document.close();

            printWindow.onload = function() {
                printWindow.print();
                printWindow.close();
            };
        });
    </script>


    <script>
        $(document).ready(function() {
            var lowStockSupplies = [];

            $('tr[data-entry-id]').each(function() {
                var row = $(this);
                var supplyId = row.data('entry-id');
                var itemCount = parseInt(row.find('td:nth-child(2)').text().trim(), 10);

                if (itemCount < 10) {
                    lowStockSupplies.push(supplyId);
                }
            });

            if (lowStockSupplies.length > 0) {
                $.ajax({
                    url: 'low-stock-notification',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        supply_ids: lowStockSupplies,
                    },
                    success: function(response) {
                        console.log("Low stock notifications sent.");
                    },
                    error: function(xhr, status, error) {
                        console.error("Failed to send low stock notifications: " + error);
                    }
                });
            }
        });
    </script>

    <script>
        $(document).ready(function() {

            let requestIds = [];
            $('#adminLteDataTable tbody tr').each(function() {
                const row = $(this);
                const targetId = row.find('td:nth-child(1)').text().trim();
                const totalCount = row.find('td:nth-child(2)').text().trim();

                if (targetId && totalCount <= 10) {
                    row.addClass('table-danger');
                }
            });
        });
    </script>
@endsection
