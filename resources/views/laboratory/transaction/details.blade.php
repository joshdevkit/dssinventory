@extends('layouts.labadmin')

@section('content')
    <style>
        .signature-canvas {
            border: 1px solid #a7a4a4;
            border-radius: 0.7em;
            height: 150px;
            width: 100%;
            cursor: crosshair;
        }
    </style>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2 class="text-success">Transactions / {{ $data['requisition']->activity }} /
                            {{ $data['requisition']->category }}</h2>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Transactions</li>
                        </ol>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-black text-center">
                            This request was made at
                            {{ date('F d, Y h:i A', strtotime($data['requisition']->date_time_filed)) }}

                        </h1>

                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="mb-10 mt-3 col-md-12">
                            @php
                                $requisitionStatus = $data['requisition']->status;
                            @endphp

                            @if ($requisitionStatus == 'Declined')
                                <p>This requisition has already been declined .</p>
                            @elseif($requisitionStatus === 'Pending')
                                <form
                                    action="{{ url('/laboratory/update-requisition-details/' . $data['requisition']->id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group" id="signt">
                                        <label for="signature">Signature</label>
                                        <canvas id="userSignature" class="signature-canvas"></canvas>
                                        <button type="button" class="btn btn-danger text-black btn-sm mt-2"
                                            onclick="clearSignature('#userSignature')">Clear</button>
                                        <input type="hidden" id="signature" name="signature">
                                    </div>

                                    <div id="reason" class="form-group d-none">
                                        <label for="">Feedback for Decline</label>
                                        <textarea name="feedback" rows="3" class="form-control"></textarea>
                                    </div>

                                    <div class="d-flex">
                                        <input type="hidden" name="category" value="{{ $data['requisition']->category }}">
                                        <input type="hidden" name="requisition_id" id="requisition_id"
                                            value="{{ $data['requisition']->id }}">
                                        <button type="submit"
                                            class="btn btn-success text-black mr-3 approve">Approve</button>
                                        <button type="button"
                                            class="btn btn-danger text-black mr-3 decline">Decline</button>
                                        <button type="submit"
                                            class="d-none btn btn-danger text-black mr-3 submit_decline">Decline</button>
                                    </div>
                                </form>
                            @elseif($requisitionStatus === 'Accepted by Dean')
                                <p>
                                    <a href="{{ route('laboratory.print-requisition', ['id' => $data['requisition']->id]) }}"
                                        class="btn btn-link print_btn">This requisition has already
                                        been
                                        Accepted by
                                        Dean. Click here to Print</a>
                                </p>
                            @endif

                        </div>
                        <hr class="mb-5">
                        <div class="row">
                            <div class="col-md-4">
                                <h4>Requisition Details</h4>
                                <hr>
                                <ul>
                                    <li><strong>Category:</strong> {{ $data['requisition']->category }}</li>
                                    <li><strong>Date Filed:</strong>
                                        {{ date('F d, Y h:i A', strtotime($data['requisition']->date_time_filed)) }}</li>
                                    <li><strong>Date Needed:</strong>
                                        {{ date('F d, Y h:i A', strtotime($data['requisition']->date_time_needed)) }}</li>
                                    <li><strong>Instructor:</strong> {{ $data['requisition']->instructor_name }}</li>
                                    <li><strong>Subject:</strong> {{ $data['requisition']->subject }}</li>
                                    <li><strong>Course/Year:</strong> {{ $data['requisition']->course_year }}</li>
                                    <li><strong>Activity:</strong> {{ $data['requisition']->activity }}</li>
                                    <li><strong>Status:</strong> {{ $data['requisition']->status }}</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h4>Items</h4>
                                <hr>
                                @if ($data['items']->isNotEmpty())
                                    <ul>
                                        @foreach ($data['items'] as $item)
                                            @php
                                                $itemDetails = $data['item_details']->firstWhere(
                                                    'id',
                                                    $item->equipment_serial_id,
                                                );
                                            @endphp
                                            @if ($itemDetails)
                                                <li>
                                                    <strong>{{ $itemDetails->equipment ?? 'N/A' }}</strong><br>
                                                    <strong>Description:
                                                        {{ $itemDetails->description ?? 'N/A' }}</strong><br>
                                                    <strong>Brand:</strong> {{ $itemDetails->brand ?? 'N/A' }} <br>
                                                    <strong>Condition during borrow:</strong> {{ $item->remarks }} <br>
                                                    <strong>Product Serial:</strong>
                                                    {{ $itemDetails->serial_no ?? 'N/A' }}<br><br>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @else
                                    <p>No items found.</p>
                                @endif


                            </div>
                            <div class="col-md-4">
                                <h4><strong>Students</strong></h4>
                                <hr>
                                @if ($data['students']->isNotEmpty())
                                    <ol>
                                        @foreach ($data['students'] as $student)
                                            <li> {{ $student->student_name }}</li>
                                        @endforeach
                                    </ol>
                                @else
                                    <p>No students found.</p>
                                @endif
                            </div>

                        </div>
                        <a type="cancel" class="btn btn-danger float-right"
                            href="{{ url('/laboratory/transaction') }}">{{ __('Exit') }}</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script>
        // $(document).ready(function() {
        //     $(document).on('click', '.print_btn', function() {
        //         var requisitionID = $(this).data('id');
        //         var csrfToken = $('meta[name="csrf-token"]').attr('content');

        //         $.ajax({
        //             url: `/laboratory/requisitions/print-data/${requisitionID}`,
        //             type: 'POST',
        //             headers: {
        //                 'X-CSRF-TOKEN': csrfToken
        //             },
        //             success: function(response) {
        //                 var requisition = response.requisition;
        //                 var items = response.items;
        //                 var item_details = response.item_details;
        //                 var students = response.students;

        //                 // Prepare a single list of all students
        //                 var studentList = '<ol style="list-style-type: decimal;">';
        //                 students.forEach((student, index) => {
        //                     studentList += `<li>${student.student_name}</li>`;
        //                 });
        //                 studentList += '</ol>';

        //                 var html = `
    //                 <div class="printable-area" style="font-family: Arial, sans-serif;">
    //                     <!-- Instructor's Requisition Slip -->
    //                     <div style="page-break-after: always; border: 1px solid #000; padding: 20px;">
    //                         <div style="text-align: center; margin-bottom: 20px;">
    //                             <img src="{{ asset('path_to_logo') }}" alt="University Logo" style="height: 100px; margin-bottom: 10px;">
    //                             <h2 style="margin: 0;">Saint Paul University Philippines</h2>
    //                             <p style="margin: 0;">Tuguegarao City, Cagayan 3500</p>
    //                             <h3 style="margin: 5px 0;">School of Information Technology and Engineering</h3>
    //                             <h1 style="margin: 10px 0;">INSTRUCTOR'S REQUISITION SLIP</h1>
    //                         </div>

    //                         <table width="100%" border="1" cellpadding="10" style="border-collapse: collapse;">
    //                             <tr>
    //                                 <td><strong>Date & Time Filed:</strong> ${requisition.date_time_filed}</td>
    //                                 <td><strong>Date & Time Needed:</strong> ${requisition.date_time_needed}</td>
    //                             </tr>
    //                             <tr>
    //                                 <td><strong>Instructor:</strong> ${requisition.instructor_name}</td>
    //                                 <td><strong>Subject:</strong> ${requisition.subject}</td>
    //                             </tr>
    //                             <tr>
    //                                 <td><strong>Course & Year:</strong> ${requisition.course_year}</td>
    //                                 <td><strong>Title of Activity:</strong> ${requisition.activity}</td>
    //                             </tr>
    //                         </table>

    //                         <h2>Item Details</h2>
    //                         <table width="100%" border="1" cellpadding="5" style="border-collapse: collapse;">
    //                             <thead>
    //                                 <tr>
    //                                     <th>Qty</th>
    //                                     <th>Apparatus/Equipment/Tools</th>
    //                                     <th>Specification Brand/Model</th>
    //                                     <th>Remarks</th>
    //                                 </tr>
    //                             </thead>
    //                             <tbody>`;
        //                 items.forEach((item, index) => {
        //                     html += `
    //                                 <tr>
    //                                     <td>${item.quantity}</td>
    //                                     <td>${item_details[index].equipment}</td>
    //                                     <td>${item_details[index].brand}</td>
    //                                     <td>${item.remarks}</td>
    //                                 </tr>`;
        //                 });
        //                 html += `
    //                             </tbody>
    //                         </table>

    //                         <br><br>
    //                         <div style="text-align: left;">
    //                             <p><strong>Approved by:</strong> SITE Dean</p>
    //                             <p><strong>Prepared by:</strong> Eng’s Lab Assistant</p>
    //                         </div>
    //                     </div>

    //                     <!-- Student's Borrower's Slip -->
    //                     <div style="border: 1px solid #000; padding: 20px;">
    //                         <div style="text-align: center; margin-bottom: 20px;">
    //                             <img src="{{ asset('path_to_logo') }}" alt="University Logo" style="height: 100px; margin-bottom: 10px;">
    //                             <h2 style="margin: 0;">Saint Paul University Philippines</h2>
    //                             <p style="margin: 0;">Tuguegarao City, Cagayan 3500</p>
    //                             <h3 style="margin: 5px 0;">School of Information Technology and Engineering</h3>
    //                             <h1 style="margin: 10px 0;">STUDENT'S BORROWER'S SLIP</h1>
    //                         </div>

    //                         <table width="100%" border="1" cellpadding="10" style="border-collapse: collapse;">
    //                             <tr>
    //                                 <td><strong>Date & Time Filed:</strong> ${requisition.date_time_filed}</td>
    //                                 <td><strong>Date & Time Needed:</strong> ${requisition.date_time_needed}</td>
    //                             </tr>
    //                             <tr>
    //                                 <td><strong>Instructor:</strong> ${requisition.instructor_name}</td>
    //                                 <td><strong>Subject:</strong> ${requisition.subject}</td>
    //                             </tr>
    //                             <tr>
    //                                 <td><strong>Course & Year:</strong> ${requisition.course_year}</td>
    //                                 <td><strong>Title of Activity:</strong> ${requisition.activity}</td>
    //                             </tr>
    //                         </table>

    //                         <h2>Item Details</h2>
    //                         <table width="100%" border="1" cellpadding="5" style="border-collapse: collapse;">
    //                             <thead>
    //                                 <tr>
    //                                     <th>Qty</th>
    //                                     <th>Apparatus/Equipment/Tools</th>
    //                                     <th>Specification Brand/Model</th>
    //                                     <th>Group</th>
    //                                 </tr>
    //                             </thead>
    //                             <tbody>`;
        //                 items.forEach((item, index) => {
        //                     html += `
    //                                 <tr>
    //                                     <td>${item.quantity}</td>
    //                                     <td>${item_details[index].equipment}</td>
    //                                     <td>${item_details[index].brand}</td>
    //                                     <td>
    //                                         ${studentList}
    //                                     </td>
    //                                 </tr>`;
        //                 });
        //                 html += `
    //                             </tbody>
    //                         </table>

    //                         <br><br>
    //                         <div style="text-align: left;">
    //                             <p><strong>Approved by:</strong> Instructor</p>
    //                             <p><strong>Prepared by:</strong> Eng’s Lab Assistant</p>
    //                         </div>
    //                     </div>
    //                 </div>`;

        //                 // Open new window for printing
        //                 var newWindow = window.open('', '_blank');
        //                 newWindow.document.write(html);
        //                 newWindow.document.write(
        //                     '<style>body { font-family: Arial, sans-serif; }</style>');
        //                 newWindow.document.close();
        //                 newWindow.focus();
        //                 newWindow.print(); // Trigger the print dialog
        //                 newWindow.close();
        //             },
        //         });
        //     });
        // });
    </script>




    <script>
        $(document).ready(function() {
            setupSignatureCanvas('#userSignature', '#signature');
            $(document).on('click', '.decline', function() {
                $('.submit_decline').removeClass('d-none')
                $('.decline').addClass('d-none')
                $('#reason').removeClass('d-none')
                $('.approve').addClass('d-none')
                $('#signt').addClass('d-none')
            })
        });

        function setupSignatureCanvas(canvasId, inputId) {
            const $canvas = $(canvasId);
            const canvas = $canvas[0];
            const ctx = canvas.getContext('2d');
            let drawing = false;

            canvas.width = $canvas.width();
            canvas.height = $canvas.height();

            $canvas.on('mousedown touchstart', function(e) {
                drawing = true;
                ctx.beginPath();
                ctx.moveTo(getX(e), getY(e));
            });

            $canvas.on('mousemove touchmove', function(e) {
                if (drawing) {
                    ctx.lineTo(getX(e), getY(e));
                    ctx.strokeStyle = '#000';
                    ctx.lineWidth = 2;
                    ctx.lineCap = 'round';
                    ctx.stroke();
                }
            });

            $canvas.on('mouseup touchend', function() {
                drawing = false;
                ctx.closePath();
                saveSignature(canvasId, inputId);
            });

            $canvas.on('mouseleave touchcancel', function() {
                drawing = false;
            });

            function getX(event) {
                return (event.pageX || event.originalEvent.touches[0].pageX) - $canvas.offset().left;
            }

            function getY(event) {
                return (event.pageY || event.originalEvent.touches[0].pageY) - $canvas.offset().top;
            }
        }

        function clearSignature(canvasId) {
            const canvas = $(canvasId)[0];
            const ctx = canvas.getContext('2d');
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }

        function saveSignature(canvasId, inputId) {
            const canvas = $(canvasId)[0];
            const signatureData = canvas.toDataURL('image/png');
            $(inputId).val(signatureData);
        }
    </script>
@endsection
