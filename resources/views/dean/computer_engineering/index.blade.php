@extends('layouts.dean')

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
                        <h1 class = "text-success">Computer Engineering's List of Equipment</h1>
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
                                <button class="btn btn-primary btn-sm float-right ml-2" id="print-btn">
                                    <i class="fas fa-print"></i> Print
                                </button>
                                <button class="btn btn-primary btn-sm float-right" id="print-all-btn">
                                    <i class="fas fa-print"></i> Print All
                                </button>
                                <!-- /.card-header -->

                                <!-- /.card-body -->
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped for_printall">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Equipment</th>
                                            <th>Brand</th>
                                            <th>Quantity</th>
                                            <th>Unit</th>
                                            <th>Condition</th>
                                            <th>Date Acquired</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($computerEngineering as $computer)
                                            <tr data-entry-id="{{ $computer->id }}">

                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $computer->equipment }}</td>
                                                <td>{{ $computer->brand }}</td>
                                                <td>{{ $computer->items->count() }}</td>
                                                <td>{{ $computer->unit }}</td>
                                                <td>{{ $computer->condition }}</td>
                                                <td>{{ $computer->date_acquired }}</td>

                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">{{ __('Data Empty') }}</td>
                                            </tr>
                                        @endforelse

                                    </tbody>

                                </table>

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
            let dataTable = document.querySelector('#example1').cloneNode(true);

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
            <title>Print Data</title>
            <style>
                @media print {
            @page {
                size: landscape;
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
            width: 80px;
            height: 80px;
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
                <h5><strong>INVENTORY OF TESTINGS</strong></h5>
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

        $(document).ready(function() {
            $('#print-all-btn').on('click', function() {
                // Check if the DataTable is initialized
                var table = $('#example1').DataTable();

                if (table) {
                    // Destroy the DataTable instance before printing
                    table.destroy();
                }

                // Now remove the 'id' and any other DataTable related properties
                var tableElement = $('#example1'); // Get the table element itself
                tableElement.removeAttr('id').removeClass('dataTable');

                // Clone the table (without DataTable functionalities)
                var dataTableClone = tableElement.clone(true,
                    true); // Clone with all child elements and events

                // Open a new window for printing
                var printWindow = window.open('', '', 'width=1200,height=1200');

                printWindow.document.write(`
            <html>
                <head>
                    <title>Print Data</title>
                    <style>
                        @media print {
                            @page {
                                size: landscape;
                                margin: 1cm;
                            }
                            body {
                                font-family: "Times New Roman", serif;
                            }
                            h1, h2, h3 {
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
                            table th, table td {
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
                            width: 80px;
                            height: 80px;
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
                        <h5><strong>INVENTORY OF TESTINGS</strong></h5>
                    </div>
                    ${dataTableClone[0].outerHTML} <!-- Add cloned table -->
                </body>
            </html>
        `);

                printWindow.document.close();

                // Delay print to ensure content is fully rendered
                printWindow.onload = function() {
                    setTimeout(function() {
                        printWindow.print();
                        printWindow.close();
                    }, 500);
                };
            });
        });
    </script>
@endsection
