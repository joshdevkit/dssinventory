<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Surveying Data</title>
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
            height: 60px;
            margin-right: 10px;
        }

        .header-content {
            text-align: center;
        }

        .header-content h1 {
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
        <img src="{{ asset('dist/img/logo.png') }}" alt="Logo">
        <div class="header-content">
            <h1>Saint Paul University Philippines</h1>
            <h3>Tuguegarao City, Cagayan 3500</h3>
        </div>
    </div>

    <div class="school-title">
        <h4>SCHOOL OF INFORMATION TECHNOLOGY AND ENGINEERING</h4>
        <h5><strong>INVENTORY OF SURVEYING</strong></h5>
    </div>

    <table>
        <thead>
            <tr>
                <th>Equipment</th>
                <th>Brand</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Condition</th>
                <th>Date Acquired</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($surveying as $item => $survey)
                <tr>
                    <td>
                        <strong>{{ $survey->equipment }}</strong>
                        <div>{{ $survey->description }}</div>
                    </td>
                    <td>{{ $survey->brand }}</td>
                    <td>{{ $survey->quantity }}</td>
                    <td>{{ $survey->unit }}</td>
                    <td>{{ $survey->condition }}</td>
                    <td>{{ date('F d, Y', strtotime($survey->date_acquired)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
