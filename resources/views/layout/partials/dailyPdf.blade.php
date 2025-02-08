<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
        table {
            font-family: Arial, sans-serif;
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid rgb(211, 211, 211);
        }
        thead {
            background-color: #284eb6;
            color: white;
        }
        th, td {
            padding: 10px;
            font-size: 10px;
            text-align: center;
        }
        th {
            font-weight: bold;
        }
        tbody tr:nth-child(even) {
            background-color: #f3f3f3;
        }

        tbody tr:nth-child(odd) {
            background-color: #fff;
        }
        .logo_con{
            font-family: Arial, sans-serif;
        }
        .logo_con h5, .logo_con p{
            margin: 0px;
        }
        .logo_con p{
            font-size: 10px;
        }
        .main{
            border-bottom: 1px solid #838383;
        }
        .instructor{
            margin-top: 20px;
        }
        .instructor p{
            font-family: Arial, sans-serif
        }
</style>
<body>
    <div class="main" style="width: 100%; display: flex; justify-content: space-between; align-items: center;">
        <!-- Left Section: Logo and School Details -->
        <div class="logo_con" style="align-items: center; width: 50%;">
            <img src="file:///storage/app/public/images/New MLG logo.png" width="45px" alt="" style="margin-right: 10px;">
            <div class="school" style="text-align: right; margin-top: -10%; margin-right: 20%;">
                <h5 style="">MLG COLLEGE OF LEARNING, INC.</h5>
                <p style="text-align: left; margin-left: 19.5%;">ATABAY, HILONGOS, LEYTE</p>
            </div>
        </div>

        <!-- Right Section: Report Month -->
        <div style="text-align: right;">
            <h6 class="month" style="margin: 0; font-family: Arial, sans-serif;">
                {{ $attendances->first()->created_at->format('F Y') }}
            </h6>
        </div>
    </div>

    <table class="table table-striped table-bordered table-responsive" id="monthlyTable">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Time In</th>
                <th>Name</th>
                <th>Subject Code</th>
                <th>Description</th>
                <th>Schedule</th>
                <th>Room</th>
                <th>Justification</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $att)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $att->created_at->timezone('Asia/Manila')->format('h:i A') }}</td>
                    <td> {{$att->first_name}} {{$att->last_name}} </td>
                    <td>{{ $att->subject_code ?? 'N/A' }}</td>
                    <td>{{ $att->description ?? 'N/A' }}</td>
                    <td>{{ $att->schedule ?? 'N/A' }}</td>
                    <td>{{ $att->room ?? 'N/A' }}</td>
                    <td>{{ $att->justification ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


</body>
</html>
