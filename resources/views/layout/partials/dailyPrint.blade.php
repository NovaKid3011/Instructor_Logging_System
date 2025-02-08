<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset("images/New MLG logo.png")}}" type="image/png">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<script>
    window.onload = function() {
        window.print();
    }
    window.onafterprint = function() {
      window.location.href = document.referrer;
    };
</script>
<style>
        .main_body{
            padding: 20px 30px;
        }
        table {
            margin-top: 0;
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
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: Arial, sans-serif;
        }
        .logo_con h5, .logo_con p{
            margin: 0px;
        }
        .logo_con p{
            font-size: 10px;
        }
        .main{
            display: flex;
            justify-content: space-between;
            width: 90vw;
            padding-bottom: 10px;
            border-bottom: 1px solid #838383;
        }
        .instructor{
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }
        .instructor p{
            font-family: Arial, sans-serif
        }
</style>
<body>
    <div class="main_body">
        <div class="main">
            <!-- Left Section: Logo and School Details -->
            <div class="logo_con">
                <img src="{{asset("images/New MLG logo.png")}}" width="50px" alt="">
                <div class="school">
                    <h5 style="">MLG COLLEGE OF LEARNING, INC.</h5>
                    <p>ATABAY, HILONGOS, LEYTE</p>
                </div>
            </div>

            <!-- Right Section: Report Month -->
            <div style="text-align: right;">
                <h6 class="month" style="margin: 0; font-family: Arial, sans-serif; padding-top:35px;">
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
    </div>



</body>
</html>
