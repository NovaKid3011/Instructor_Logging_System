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
            font-size: 7px;
            padding: 20px;
        }

        h4 {
            color: #555;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
        }

        img {
            width: 60px;
            height: auto;
            margin: 0 10px 0 0;
        }

        th, td {
            text-align: center;
            border: 1px solid #ddd;
            padding: 8px;
        }

        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        p, h4 {
            margin: 0;
            font-size: 10px;
        }

        .school-name {
            margin: 10px 0 0 0;
        }

        th {
            background-color: #CFE2FF;
            color: #333;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: rgb(236, 236, 236);
        }

        td[colspan] {
            text-align: center;
            font-style: italic;
            color: #999;
        }

        @media print {
            body {
                font-size: 10px;
            }

            .container {
                margin: 20px;
                padding: 0;
            }

            table {
                border-collapse: collapse;
            }

            th, td {
                padding: 4px;
            }

            img {
                width: 60px;
                height: auto;
            }

            h3 {
                font-size: 14px;
            }

            .school-name h4 {
                font-size: 14px;
            }

            .school-name p {
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="logo">
            <img src="{{ asset('images/new_mlg_logo.png') }}" alt="school-logo" class="me-3">
            <div class="school-name">
                <h4 class="mb-0">MLGCL College of Learning INC.</h4>
                <p class="mb-0">Brgy. Atabay, Hilongos, Keyte</p>
                <p class="mb-0">Attendance for {{ now()->format('F, Y') }}</p>
            </div>
        </div>

        @if ($attendances->isEmpty())
            <p>No attendance records found for this month.</p>
        @else
            @foreach ($attendances->groupBy(function ($att) {
                return $att->first_name . ' ' . $att->last_name;
            }) as $fullName => $userAttendances)
                <div>
                    <h3>{{ $fullName }}</h3>
                    <p>{{ $userAttendances->first()->created_at->format('F Y') }}</p>
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