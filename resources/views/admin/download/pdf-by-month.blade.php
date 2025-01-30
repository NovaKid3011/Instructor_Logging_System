<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MLGCL Monthly Attendance Monitoring - {{ now()->format('F, Y') }}</title>
    <style>
        body {
    font-family: "Poppins", sans-serif;
    margin: 0;
    padding: 20px;
}

h4 {
    color: #555;
    margin: 5px 0;
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    border: 1px solid #ddd;
    text-align: left;
    font-size: 13px;
}

img {
    width: 60px;
    height: auto;
    margin: 0 10px 0 0;
}

th, td {
    text-align: center;
    border: 1px solid #ddd;
    padding: 10px;
}

.header{
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 20px    ;
}

th {
    background-color: #2c69cc;
    color: white;
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}


td[colspan] {
    text-align: center;
    font-style: italic;
    color: #999;
}

.logo {
    display: flex;
    align-items: center;
    justify-content: center;
}

p, h4 {
    margin: 0;
}

h3{
    margin: 0 0 10px 0;
}

.school-name {
    margin: 10px 0 0 0;
}


.container {
    margin: 20px;
    padding: 0;
}

@media print{
    body{
        width: 100%;
    }
}

    </style>
</head>
<body>
    <div class="container my-5">
        <div class="logo">
            <img src="{{ asset('images/New MLG logo.png') }}" alt="school-logo" class="me-3">
            <div class="school-name">
                <h4 class="mb-0">MLGCL College of Learning INC.</h4>
                <p class="mb-0">Brgy. Atabay, Hilongos, Leyte</p>
            </div>



        </div>
        @if ($attendances->isEmpty())
            <p>No attendance records found for this month.</p>
        @else
            @foreach ($attendances->groupBy(function ($att) {
                return $att->first_name . ' ' . $att->last_name;
            }) as $fullName => $userAttendances)
                <div>
                <div class="header">
                    <h3>{{ $fullName }}</h3>
        <p class="mb-0">Attendance for {{ now()->format('F, Y') }}</p>
            </div>


                    <!-- <p>{{ $userAttendances->first()->created_at->format('F Y') }}</p> -->
                    <table class="table table-striped table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th>Date</th>
                                <th>Day</th>
                                <th>Subject Code</th>
                                <th>Description</th>
                                <th>Schedule</th>
                                <th>Room</th>
                                <th>Justification</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userAttendances as $att)
                                <tr>
                                    <td>{{ $att->created_at->format('d') }}</td>
                                    <td>{{ $att->created_at->format('l') }}</td>
                                    <td>{{ $att->subject_code ?? 'N/A' }}</td>
                                    <td>{{ $att->description ?? 'N/A' }}</td>
                                    <td>{{ $att->schedule ?? 'N/A' }}</td>
                                    <td>{{ $att->room ?? 'N/A' }}</td>
                                    <td>{{ $att->justification ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        @endif
    </div>
</body>
</html>