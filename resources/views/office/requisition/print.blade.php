<!DOCTYPE html>
<html>

<head>
    <title>Requisition Data / Print </title>
    <link rel="stylesheet" href="{{ asset('print.css') }}">
</head>

<body>
    <div class="bordered">
        UNIV-{{ $data->id }} B
    </div>
    <div class="header">
        <img src="{{ asset('dist/img/spup1.png') }}" alt="Logo">
        <div class="header-content">
            <h1>Saint Paul University Philippines</h1>
            <h3>Tuguegarao City, Cagayan 3500</h3>
        </div>
    </div>
    <div class="school-title">
        <h4>BUSINESS AFFAIRS OFFICE</h4>
        <h2 style="margin-top: 35px"><strong>REQUISITION FOR EQUIPMENTS</strong></h2>
    </div>

    <div class="date-section">
        <div class="date-box">
            <p>SOURCE OF FUND: {{ $data->source_of_fund }}</p>
            <p>PURPOSE/PROJECT: {{ $data->purpose_project }}</p>
        </div>
        <div class="date-box">
            <p>{{ date('F d, Y h:i A', strtotime($data->created_at)) }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr class="bg-secondary">
                <th>QUANTITY/UNIT</th>
                <th>ITEMS</th>
                <th>UNIT COST</th>
                <th>TOTAL</th>
                <th>PURCHASE ORDER #</th>
                <th>REMARKS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->items as $supply)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $supply->item_name }}</td>
                    <td>{{ $supply->unit_cost }}</td>
                    <td>{{ $supply->total }}</td>
                    <td>{{ $supply->purchase_order }}</td>
                    <td>{{ $supply->remarks }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
    @php
        $dean = \App\Models\User::role('dean')->first();
    @endphp

    <div class="signature-section">
        <div class="signature">
            <p>Requested by: <img style="width: 250px" src="{{ asset($data->signature) }}"></p>
            <p class="has-underline"> {{ Auth::user()->name }}</p>
            <p class="margin-top: 0;">(Signature over Printed Name)</p>
        </div>
        <div class="signature">
            <p>Approved by: <img style="width: 250px; margin-left: 6rem;" src="{{ asset($data->dean_signature) }}"></p>
            <p class="has-underline">{{ $dean ? $dean->name : 'Dean' }}</p>
            <p class="margin-top: 0;">(Signature over Printed Name)</p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            window.print();
        })
    </script>
</body>

</html>
