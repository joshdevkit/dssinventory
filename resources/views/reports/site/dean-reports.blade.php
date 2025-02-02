@extends('layouts.dean')

@section('content')
    <div class="content-wrapper">
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
                        <h1 class="text-success">Reports</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <p class="text-muted">Select a report type to view detailed information.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="btn-group" role="group" aria-label="Report options">
                            <button type="button" class="btn btn-primary" id="equipment_report">Equipment</button>
                            <button type="button" class="btn btn-secondary" id="supplies_report">Supplies</button>
                        </div>
                        <p class="text-muted mt-4">Choose an action whether reports of equipment Items or supplies.
                        </p>
                    </div>
                    <div class="card-body">
                        <div id="equipment_section" class="d-none mt-4">
                            <h4>Equipment Report</h4>
                            <p class="text-muted">Choose a reporting period and specify the dates to generate the report.
                            </p>

                            <!-- Action buttons -->
                            <div class="d-flex mb-3 mt-4">
                                <button class="btn btn-success" id="btn_weekly_report">Weekly</button>
                                <button class="btn btn-info mx-2" id="btn_monthly_report">Monthly</button>
                                <div class="ml-auto">
                                    <button class="btn btn-info" id="btn_print_report">Print</button>
                                    <button class="btn btn-warning ml-2" id="btn_print_all">Print All</button>
                                </div>
                            </div>

                            <p class="text-muted mt-3">You can print the current report or all available reports.</p>

                            <div id="weekly_section" class="d-none mb-3 row align-items-center">
                                <div class="col-auto">
                                    <label>From:</label>
                                    <input type="date" class="form-control" id="weekly_from">
                                </div>
                                <div class="col-auto">
                                    <label>To:</label>
                                    <input type="date" class="form-control" id="weekly_to">
                                </div>
                            </div>

                            <div id="monthly_section" class="d-none mb-3">
                                <label>Select Month:</label>
                                <select class="form-control" id="monthly_select">
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>

                            <table id="equipmentTable" class="table table-bordered table-striped mt-5">
                                <thead>
                                    <tr>
                                        <th class="w-25">ITEM</th>
                                        <th>QUANTITY REQUESTED</th>
                                        <th>REQUESTED BY</th>
                                        <th>PURPOSE</th>
                                        <th>STATUS</th>
                                        <th>DATE REQUESTED</th>
                                    </tr>
                                </thead>
                                <tbody id="data_equipment">

                                </tbody>
                            </table>
                        </div>

                        <div id="supplies_section" class="d-none mt-4">
                            <h4>Supplies Report</h4>
                            <p class="text-muted">Choose a reporting period and specify the dates to generate the report.
                            </p>

                            <div class="d-flex mb-3 mt-4">
                                <button class="btn btn-success" id="btn_supplies_weekly_report">Weekly</button>
                                <button class="btn btn-info mx-2" id="btn_supplies_monthly_report">Monthly</button>
                                <div class="ml-auto">
                                    <button class="btn btn-info" id="btn_supplies_print_report">Print</button>
                                    <button class="btn btn-warning ml-2" id="btn_supplies_print_all">Print All</button>
                                </div>
                            </div>

                            <p class="text-muted mt-3">You can print the current report or all available reports.</p>

                            <div id="weekly_supplies_section" class="d-none mb-3 row align-items-center">
                                <div class="col-auto">
                                    <label>From:</label>
                                    <input type="date" class="form-control" id="weekly_supplies_from">
                                </div>
                                <div class="col-auto">
                                    <label>To:</label>
                                    <input type="date" class="form-control" id="weekly_supplies_to">
                                </div>
                            </div>

                            <div id="monthly_supplies_section" class="d-none mb-3">
                                <label>Select Month:</label>
                                <select class="form-control" id="monthly_supplies_select">
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>

                            <table id="suppliesTable" class="table table-bordered table-striped mt-5">
                                <thead>
                                    <tr>
                                        <th class="w-25">ITEM</th>
                                        <th>QUANTITY REQUESTED</th>
                                        <th>REQUESTED BY</th>
                                        <th>PURPOSE</th>
                                        <th>DATE REQUESTED</th>
                                    </tr>
                                </thead>
                                <tbody id="data_supplies">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            let originalData = [];
            let originalSuppliesData = [];

            $('#equipment_report').click(function() {
                $('#equipment_section').removeClass('d-none');
                $("#supplies_section").addClass('d-none')
                $.ajax({
                    url: '{{ route('auth.site-filter-reports') }}',
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        filterType: "equipment",
                    },
                    success: function(response) {
                        console.log(response);
                        originalData = response; // Store the response data
                        populateEquipmentTable(response);
                        $('#equipmentTable').DataTable();
                    }
                });
            });

            $('#btn_weekly_report').click(function() {
                $('#weekly_section').removeClass('d-none');
                $('#monthly_section').addClass('d-none');
            });

            $('#btn_monthly_report').click(function() {
                $('#monthly_section').removeClass('d-none');
                $('#weekly_section').addClass('d-none');
            });

            $('#weekly_from, #weekly_to').on('change', function() {
                filterEquipmentTable(originalData); // Pass the originalData to the filter function
            });

            $('#monthly_select').on('change', function() {
                filterEquipmentTable(originalData); // Pass the originalData to the filter function
            });

            function populateEquipmentTable(data) {
                let tableBody = $('#data_equipment');
                tableBody.empty();

                data.forEach(function(item) {
                    let formattedDate = new Date(item.date_added).toLocaleString();

                    let tableRow = `<tr>
                                <td>Item: ${item.equipment_item} - Serial No: ${item.equipment_serial_no}</td>
                                <td>${item.quantity_requested}</td>
                                <td>${item.request_by}</td>
                                <td>${item.purpose}</td>
                                <td>${item.borrow_status}</td>
                                <td>${formattedDate}</td>
                            </tr>`;
                    tableBody.append(tableRow);
                });
            }

            function filterEquipmentTable(data) {
                let fromDate = new Date($('#weekly_from').val());
                let toDate = new Date($('#weekly_to').val());
                let selectedMonth = $('#monthly_select').val();
                let filteredData = [];

                if ($('#weekly_section').is(':visible')) {
                    filteredData = data.filter(function(item) {
                        let itemDate = new Date(item.date_added);
                        return itemDate >= fromDate && itemDate <= toDate;
                    });
                } else if ($('#monthly_section').is(':visible')) {
                    filteredData = data.filter(function(item) {
                        let itemDate = new Date(item.date_added);
                        return itemDate.getMonth() + 1 == selectedMonth;
                    });
                }

                populateEquipmentTable(filteredData);
            }

            function populateSuppliesTable(data) {
                let tableBody = $('#data_supplies');
                tableBody.empty();

                data.forEach(function(item) {
                    let formattedDate = new Date(item.date_added).toLocaleString();

                    let tableRow = `<tr>
                                <td>Item: ${item.item}</td>
                                <td>${item.quantity_requested}</td>
                                <td>${item.request_by}</td>
                                <td>${item.purpose}</td>
                                <td>${formattedDate}</td>
                            </tr>`;
                    tableBody.append(tableRow);
                });
            }

            function resetFilters() {
                $('#weekly_from').val('');
                $('#weekly_to').val('');
                $('#monthly_select').val('');
                $('#weekly_section').addClass('d-none');
                $('#monthly_section').addClass('d-none');
            }

            $('#supplies_report').click(function() {
                resetFilters();
                $('#supplies_section').removeClass('d-none');
                $('#equipment_section').addClass('d-none');

                $.ajax({
                    url: '{{ route('auth.site-filter-reports') }}',
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        filterType: "supplies",
                    },
                    success: function(response) {
                        console.log(response);
                        originalSuppliesData = response;
                        populateSuppliesTable(response);
                        $('#suppliesTable').DataTable();
                    }
                });
            });

            $('#btn_supplies_weekly_report').click(function() {
                $('#weekly_supplies_section').removeClass('d-none');
                $('#monthly_supplies_section').addClass('d-none');
            });

            $('#btn_supplies_monthly_report').click(function() {
                $('#monthly_supplies_section').removeClass('d-none');
                $('#weekly_supplies_section').addClass('d-none');
            });

            $('#weekly_supplies_from, #weekly_supplies_to').on('change', function() {
                filterSuppliesTable(originalSuppliesData);
            });

            $('#monthly_supplies_select').on('change', function() {
                filterSuppliesTable(originalSuppliesData);
            });

            function populateSuppliesTable(data) {
                let tableBody = $('#data_supplies');
                tableBody.empty();

                data.forEach(function(item) {
                    let formattedDate = new Date(item.date_added).toLocaleString();

                    let tableRow = `<tr>
                                <td>${item.item}</td>
                                <td>${item.quantity_requested}</td>
                                <td>${item.requested_by}</td>
                                <td>${item.purpose}</td>
                                <td>${formattedDate}</td>
                            </tr>`;
                    tableBody.append(tableRow);
                });
            }

            function filterSuppliesTable(data) {
                let fromDate = new Date($('#weekly_supplies_from').val());
                let toDate = new Date($('#weekly_supplies_to').val());
                let selectedMonth = $('#monthly_supplies_select').val();
                let filteredData = [];

                if ($('#weekly_supplies_section').is(':visible')) {
                    filteredData = data.filter(function(item) {
                        let itemDate = new Date(item.date_added);
                        return itemDate >= fromDate && itemDate <= toDate;
                    });
                } else if ($('#monthly_supplies_section').is(':visible')) {
                    filteredData = data.filter(function(item) {
                        let itemDate = new Date(item.date_added);
                        return itemDate.getMonth() + 1 == selectedMonth;
                    });
                }

                populateSuppliesTable(filteredData);
            }




            //print EQUIPMENT REPORTS

            $('#btn_print_report').on('click', function() {
                let dataTable = document.querySelector('#equipmentTable').cloneNode(true);
                let theadRow = dataTable.querySelector('thead tr');
                let tbodyRows = dataTable.querySelectorAll('tbody tr');

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
                        <h5><strong>OFFICE EQUIPMENT REPORTS</strong></h5>
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
            })

            $('#btn_print_all').on('click', function() {
                // Check if the DataTable is initialized
                var table = $('#equipmentTable').DataTable();

                if (table) {
                    // Destroy the DataTable instance before printing
                    table.destroy();
                }

                // Now remove the 'id' and any other DataTable related properties
                var tableElement = $('#equipmentTable'); // Get the table element itself
                tableElement.removeAttr('id').removeClass('dataTable');

                // Clone the table (without DataTable functionalities)
                var dataTableClone = tableElement.clone(true,
                    true); // Clone with all child elements and events

                // Remove the last child of the header row
                let theadRow = dataTableClone.find('thead tr'); // Get the header row from the cloned table

                // Remove the last child from each row in the tbody
                let tbodyRows = dataTableClone.find(
                    'tbody tr'); // Get all rows from the tbody of the cloned table
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
                                <h5><strong>OFFICE EQUIPMENT REPORTS</strong></h5>
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
            })


            //PRINT SUPPLIES REPORTS
            //btn_supplies_print_report
            //btn_supplies_print_all

            $('#btn_supplies_print_report').on('click', function() {
                let dataTable = document.querySelector('#suppliesTable').cloneNode(true);
                let theadRow = dataTable.querySelector('thead tr');
                let tbodyRows = dataTable.querySelectorAll('tbody tr');

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
                        <h5><strong>OFFICE SUPPLIES REPORTS</strong></h5>
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
            })

            $('#btn_supplies_print_all').on('click', function() {
                // Check if the DataTable is initialized
                var table = $('#suppliesTable').DataTable();

                if (table) {
                    // Destroy the DataTable instance before printing
                    table.destroy();
                }

                // Now remove the 'id' and any other DataTable related properties
                var tableElement = $('#suppliesTable'); // Get the table element itself
                tableElement.removeAttr('id').removeClass('dataTable');

                // Clone the table (without DataTable functionalities)
                var dataTableClone = tableElement.clone(true,
                    true); // Clone with all child elements and events

                // Remove the last child of the header row
                let theadRow = dataTableClone.find('thead tr'); // Get the header row from the cloned table

                // Remove the last child from each row in the tbody
                let tbodyRows = dataTableClone.find(
                    'tbody tr'); // Get all rows from the tbody of the cloned table
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
                                <h5><strong>OFFICE SUPPLIES REPORTS</strong></h5>
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
            })
        });
    </script>
@endsection
