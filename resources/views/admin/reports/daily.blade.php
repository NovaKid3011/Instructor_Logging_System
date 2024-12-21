@extends('layout.partials._head')
@section('content')

@vite('resources/css/report.css')
<div class="container mt-4">
    <div>
        <div class="card-header">
            <h4>Attendance</h4>
            <button class="print-btn no-print" onclick="window.print()">PRINT</button>
        </div>
        <div class="card card-light p-4 mt-2 border-0">
            <h6>Monday, DECEMBER 06, 2024</h6>
            <div class="table-container mt-3">
                <table class="table table-striped table-bordered table-responsive" id="myTable">
                    <thead class="table-primary">
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
                            <td>IT ELEC 102<br>PC 114<br>PC 114</td>
                            <td>askdhifhiurksg<br>fkhsgiuwrkji<br>fkhsgiuwrkji</td>
                            <td>07:30 AM - 09:00 PM at 103<br>04:00 PM - 05:30 PM at 103<br>04:00 PM - 05:30 PM at 103</td>
                            <td>103<br>103<br>103</td>
                        </tr>
                        <tr>
                            <td>03:00 PM</td>
                            <td>MR. MARVIN BROÑOLA</td>
                            <td>ENG 101<br>PC 118</td>
                            <td>noteshere<br>anothernote</td>
                            <td>03:00 PM - 04:30 PM at 201<br>06:30 PM - 08:00 PM at 202</td>
                            <td>201<br>202</td>
                        </tr>
                        <tr>
                            <td>09:00 AM</td>
                            <td>DR. APOLONIA SUAREZ</td>
                            <td>CS 201<br>PC 115</td>
                            <td>xyzexampletext<br>anotherexample</td>
                            <td>09:00 AM - 10:30 AM at 201<br>01:00 PM - 02:30 PM at 202</td>
                            <td>201<br>202</td>
                        </tr>
                        <tr>
                            <td>10:30 AM</td>
                            <td>MR. ALAN ABERILLA</td>
                            <td>MATH 203<br>PC 116</td>
                            <td>loremipsumtext<br>samplenotes</td>
                            <td>10:30 AM - 12:00 PM at 204<br>03:00 PM - 04:30 PM at 205</td>
                            <td>204<br>205</td>
                        </tr>
                        <tr>
                            <td>01:00 PM</td>
                            <td>MR. EMANUELLE BARRIENTOS</td>
                            <td>PHYSICS 101<br>PC 117</td>
                            <td>exampletext1<br>exampletext2</td>
                            <td>01:00 PM - 02:30 PM at 203<br>05:00 PM - 06:30 PM at 302</td>
                            <td>203<br>302</td>
                        </tr>
                        <tr>
                            <td>03:00 PM</td>
                            <td>MR. MARNITO C. MAHINLO</td>
                            <td>ENG 101<br>PC 118</td>
                            <td>noteshere<br>anothernote</td>
                            <td>03:00 PM - 04:30 PM at 201<br>06:30 PM - 08:00 PM at 202</td>
                            <td>201<br>202</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
