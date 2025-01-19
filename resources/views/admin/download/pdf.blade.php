<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MLGCL Daily Attendance Monitoring</title>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            font-size: 7;
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

        .logo{
            display: flex;
        }
        p, h4{
            margin: 0;
            font-size: 10;
        }

        .school-name{
            width: 100%;
            margin: 10px 0 0 0 ;
            display: flex;
            justify-content: space-between;
        }

        th {
            background-color: #CFE2FF;
            color: #333;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: rgb(236, 236, 236);
        }

        .name-column {
            text-align: left;
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

        }



    </style>
</head>
<body>
    <div class="container my-5">
        <div class="logo">
            <img src="{{ asset('images/new mlg logo.png') }}" alt="school-logo" class="me-3">
            <!-- <img src="http://instructor-logging.test/images/new_mlg_logo.png" alt="school-logo" class="me-3"> -->
            <div class="school-name">
                <div>
                <h4 class="mb-0">MLGCL College of Learning INC.</h4>
                <p class="mb-0">Brgy. Atabay, Hilongos, Keyte</p>
                </div>
                <p class="mb-0">{{ now()->format('F d, Y') }}</p>
            </div>
        </div>

        <table class="table table-striped table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Time In</th>
                    <th>Name</th>
                    <th>Subject Code</th>
                    <th>Description</th>
                    <th>Schedule</th>
                    <th>Room</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $index => $att)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $att->created_at->format('h:i A') }}</td>
                        <td>{{ $att->first_name }} {{ $att->last_name }}</td>
                        <td>{{ $att->subject_code ?? 'N/A' }}</td>
                        <td>{{ $att->description ?? 'N/A' }}</td>
                        <td>{{ $att->schedule ?? 'N/A' }}</td>
                        <td>{{ $att->room ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
