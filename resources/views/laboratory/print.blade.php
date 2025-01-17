<!DOCTYPE html>
<html>

<head>
    <title>Requisition Data / Print </title>
    <link rel="stylesheet" href="{{ asset('print.css') }}">
</head>

<body>
    <div class="bordered">
        SITEL 001
    </div>
    <div class="header">
        <img src="{{ asset('dist/img/spup1.png') }}" alt="Logo">
        <div class="header-content">
            <h1>Saint Paul University Philippines</h1>
            <h3>Tuguegarao City, Cagayan 3500</h3>
        </div>
    </div>

    <div class="school-title">
        <h4>SCHOOL OF INFORMATION TECHNOLOGY AND ENGINEERING</h4>
        <h2 style="margin-top: 35px"><strong>INSTRUCTOR'S REQUISITION SLIP</strong></h2>
    </div>

    <div class="date-section">
        <div class="date-box">
            <p>{{ date('F d, Y h:i A', strtotime($data['requisition']->date_time_filed)) }}</p>
            <p><strong>Date & Time Filed</strong></p>
        </div>
        <div class="date-box">
            <p>{{ date('F d, Y h:i A', strtotime($data['requisition']->date_time_needed)) }}</p>
            <p><strong>Date & Time Needed</strong></p>
        </div>
    </div>

    <div class="info-row">
        <div class="info-box">
            <p>{{ $data['requisition']->instructor_name }}</p>
            <p><strong>Instructor</strong></p>
        </div>
        <div class="info-box">
            <p>{{ $data['requisition']->subject }}</p>
            <p><strong>Subject</strong></p>
        </div>
        <div class="info-box">
            <p>{{ $data['requisition']->course_year }}</p>
            <p><strong>Course/Year</strong></p>
        </div>
    </div>

    <p class="text-activity">Title of Activity: {{ $data['requisition']->activity }}</p>

    <table>
        <thead>
            <tr>
                <th>Qty</th>
                <th>Apparatus/Equipment/Tools</th>
                <th>Specification/Brand/Model</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data['items'] as $item)
                @php
                    $itemDetail = $data['item_details']->firstWhere('id', $item->equipment_id);
                @endphp
                <tr>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $itemDetail->equipment }}</td>
                    <td>{{ $itemDetail->brand }}</td>
                    <td>{{ $item->remarks }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @php
        $dean = \App\Models\User::role('dean')->first();
        $labAssistant = \App\Models\User::role('laboratory')->first();
    @endphp

    <div class="signature-section">
        <div class="signature">
            <p>Approved by: <img style="width: 250px" src="{{ asset($data['requisition']->dean_signature) }}"></p>
            <p class="has-underline">{{ $dean ? $dean->name : 'Dean' }}</p>
        </div>
        <div class="signature">
            <p>Approved by: <img style="width: 250px" src="{{ asset($data['requisition']->labtext_signature) }}"></p>
            <p class="has-underline">{{ $labAssistant ? $labAssistant->name : "Eng'g Lab. Assistant" }}</p>
        </div>
    </div>

    <div class="page-break"></div>
    <div class="bordered">
        SITEL 002
    </div>
    <!-- Student's Slip Header -->
    <div class="header">
        <img src="{{ asset('dist/img/spup1.png') }}" alt="Logo">
        <div class="header-content">
            <h1>Saint Paul University Philippines</h1>
            <h3>Tuguegarao City, Cagayan 3500</h3>
        </div>
    </div>

    <div class="school-title">
        <h4>SCHOOL OF INFORMATION TECHNOLOGY AND ENGINEERING</h4>
        <h2 style="margin-top: 35px"><strong>STUDENT'S BORROWER'S SLIP</strong></h2>
    </div>

    <div class="date-section">
        <div class="date-box">
            <p>{{ date('F d, Y h:i A', strtotime($data['requisition']->date_time_filed)) }}</p>
            <p><strong>Date & Time Filed</strong></p>
        </div>
        <div class="date-box">
            <p>{{ date('F d, Y h:i A', strtotime($data['requisition']->date_time_needed)) }}</p>
            <p><strong>Date & Time Needed</strong></p>
        </div>
    </div>

    <div class="info-row">
        <div class="info-box">
            <p>{{ $data['requisition']->instructor_name }}</p>
            <p><strong>Instructor</strong></p>
        </div>
        <div class="info-box">
            <p>{{ $data['requisition']->subject }}</p>
            <p><strong>Subject</strong></p>
        </div>
        <div class="info-box">
            <p>{{ $data['requisition']->course_year }}</p>
            <p><strong>Course/Year</strong></p>
        </div>
    </div>
    <p class="text-activity">Title of Activity: {{ $data['requisition']->activity }}</p>
    <p class="text-activity_t">To whom It May Concern:</p>
    <p class="justify indent">This is to certify that I/WE the undersigned, have borrowed the tools, equipment,
        instrument listed below. In
        case of LOSS/DAMAGE, we are to replace or pay the item(s).</p>
    <table>
        <thead>
            <tr>
                <th>Qty</th>
                <th>Apparatus/Equipment/Tools/Specification/Brand/Model</th>
                <th>Group</th>
            </tr>
        </thead>
        <tbody>
            @if ($data['items']->isNotEmpty())
                @php
                    $itemDetail = $data['item_details']->firstWhere('id', $data['items'][0]->equipment_id);
                @endphp
                <tr>
                    <td>{{ $data['items']->first()->quantity }}</td>
                    <td>{{ $itemDetail->equipment }}<br>
                        {{ $itemDetail->description ?? '' }}<br>
                        {{ $itemDetail->brand }}<br>
                    </td>
                    <td rowspan="{{ $data['items']->count() }}">
                        @foreach ($data['students'] as $student)
                            {{ $student->student_name }}<br>
                        @endforeach
                    </td>
                </tr>

                @foreach ($data['items']->slice(1) as $item)
                    @php
                        $itemDetail = $data['item_details']->firstWhere('id', $item->equipment_id);
                    @endphp
                    <tr>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $itemDetail->equipment }}<br>
                            {{ $itemDetail->description ?? '' }}<br>
                            {{ $itemDetail->brand }}<br>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    @php
        $dean = \App\Models\User::role('dean')->first();
        $labAssistant = \App\Models\User::role('laboratory')->first();
    @endphp

    <div class="signature-section">
        <div class="signature">
            <p>Approved by: <img style="width: 250px" src="{{ asset($data['requisition']->dean_signature) }}"></p>
            <p class="has-underline">{{ $dean ? $dean->name : 'Dean' }}</p>
        </div>
        <div class="signature">
            <p>Approved by: <img style="width: 250px" src="{{ asset($data['requisition']->labtext_signature) }}"></p>
            <p class="has-underline">{{ $labAssistant ? $labAssistant->name : "Eng'g Lab. Assistant" }}</p>
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
