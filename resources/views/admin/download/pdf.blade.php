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
    padding: 20px;
}

h4 {
    color: #555;
    margin: 5px 0;
    font-size: 14px; /* Adjusted for better scaling */
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    border: 1px solid #ddd;
    text-align: left;
    font-size: 13px; /* Consistent text size */
}

img {
    width: 60px;
    height: auto;
    margin: 0 10px 0 0;
}

th, td {
    text-align: center;
    border: 1px solid #ddd;
    padding: 8px; /* Slightly smaller padding for uniformity */
}

.header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 20px;
}

th {
    background-color: #2c69cc;
    color: white;
    font-weight: bold;
    font-size: 14px; /* Bold header text for readability */
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #e0ebff; /* Optional hover effect */
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

h3 {
    margin: 0 0 10px 0;
    font-size: 16px; /* Clear and noticeable name display */
}

.school-name {
    margin: 10px 0 0 0;
}

.container {
    margin: 20px;
    padding: 0;
}

@media print {
    body {
        margin: 0;
        padding: 10px;
        font-size: 8px; 
    }

    .header {
        justify-content: center; 
    }

    table {
        width: 100%;
        font-size: 8px;
    }

    th, td {
        padding: 6px;
    }

    img {
        width: 50px;
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
                <p class="mb-0">Brgy. Atabay, Hilongos, Leyte</p>
                </div>
                
            </div>
        </div>

        <h3 class="date">Attendance for {{ now()->format('F d, Y') }}</h3>

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
ty