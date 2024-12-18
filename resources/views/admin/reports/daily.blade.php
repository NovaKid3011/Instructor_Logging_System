@extends('layout.dashboard')
@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="resources/css/report-daily.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
                .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .print-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
        }
        @media print {
    #sidebar {
        display: none !important;
    }

    .content {
        width: 100% !important;
        margin: 0;
    }

    .no-print, .navbar, .footer {
        display: none !important;
    }

    body {
        font-size: 11px;
    }
}


    </style>
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div>
            <div class="card-header">
                <h4> Attendance</h4>
                <button class="print-btn no-print" onclick="window.print()">   
                
                PRINT</button>
            </div>
            <div class="card p-4 mt-2 border-0">
                <h6>Monday DECEMBER 06, 2024</h6>
                <div class="table-container mt-3">
                    <table class="table ">
                        <thead class="table-dark">
                            <tr>
                                <th>Time In</th>
                                <th>Name</th>
                                <th>Subject Code</th>
                                <th>Description</th>
                                <th>Schedule</th>
                                <th>Room</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>07:30 AM</td>
                                <td>MR. MARK JOSEPH C. GIGANTE</td>
                                <td>IT ELEC 102<br> PC 114<br> PC 114</td>
                                <td>askdhifhiurksg<br> fkhsgiuwrkji<br> fkhsgiuwrkji</td>
                                <td> 07:30 AM - 09:00 PM at 103<br>
                                     04:00 PM - 05:30 PM at 103
                                     <br>
                                     04:00 PM - 05:30 PM at 103</td>
                                <td>103<br>103</td>
                            </tr>

                            <tr>
                                <td>03:00 PM</td>
                                <td>MR. MARVIN BROÑOLA</td>
                                <td>ENG 101<br> PC 118</td>
                                <td>noteshere<br> anothernote</td>
                                <td>03:00 PM - 04:30 PM at 201<br>06:30 PM - 08:00 PM at 202</td>
                                <td>201<br>202</td>
                            </tr>

                            <tr>

                            <tr>
                                <td>09:00 AM</td>
                                <td>DR. APOLONIA SUAREZ</td>
                                <td>CS 201<br> PC 115</td>
                                <td>xyzexampletext<br> anotherexample</td>
                                <td>09:00 AM - 10:30 AM at 201<br>01:00 PM - 02:30 PM at 202</td>
                                <td>201<br>202</td>
                                
                            </tr>
                            <tr>
                                <td>10:30 AM</td>
                                <td>MR. ALAN ABERILLA</td>
                                <td>MATH 203<br> PC 116</td>
                                <td>loremipsumtext<br> samplenotes</td>
                                <td>10:30 AM - 12:00 PM at 204<br>03:00 PM - 04:30 PM at 205</td>
                                <td>204<br>205</td>
                            </tr>
                            <tr>
                                <td>01:00 PM</td>
                                <td> MR. EMANUELLE BARRIENTOS</td>
                                <td>PHYSICS 101<br> PC 117</td>
                                <td>exampletext1<br> exampletext2</td>
                                <td>01:00 PM - 02:30 PM at 203<br>05:00 PM - 06:30 PM at 302</td>
                                <td>203<br>302</td>
                                
                            </tr>
                            <tr>
                                <td>03:00 PM</td>
                                <td>MR. MARNITO C. MAHINLO</td>
                                <td>ENG 101<br> PC 118</td>
                                <td>noteshere<br> anothernote</td>
                                <td>03:00 PM - 04:30 PM at 201<br>06:30 PM - 08:00 PM at 202</td>
                                <td>201<br>202</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
    

@endsection