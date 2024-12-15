@extends('layout.dashboard')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Schedule</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="resources/css/report-daily.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
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
<body>
    <div class="container mt-4">
        <h4 class="text-center mb-4">DECEMBER</h4>
        <div class="card-header">
                <h4> DR. APOLONIA SUAREZ</h4>
                <button class="print-btn no-print" onclick="window.print()">   
                
                PRINT</button>
            </div>
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>DATE</th>
                    <th>DAY</th>
                    <th>TIME</th>
                    <th>SUBJECT CODE</th>
                    <th>ROOM</th>
                    <th>TIME OF ARRIVAL</th>
                    <th> STATUS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="2">2</td>
                    <td>MON</td>
                    <td>1:00-2:30</td>
                    <td>GEN. ED. 102</td>
                    <td>101</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>MON</td>
                    <td>2:30-4:00</td>
                    <td>GEN. ED. 102</td>
                    <td>101</td>
                    <td></td>
                    <td></td>
                    
                </tr>
                <tr>
                    <td rowspan="2">5</td>
                    <td>THU</td>
                    <td>1:00-2:30</td>
                    <td>GEN. ED. 102</td>
                    <td>101</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>THU</td>
                    <td>2:30-4:00</td>
                    <td>GEN. ED. 102</td>
                    <td>101</td>
                    <td></td>
                </tr>
                <tr>
                    <td rowspan="2">9</td>
                    <td>MON</td>
                    <td>1:00-2:30</td>
                    <td>GEN. ED. 102</td>
                    <td>101</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>MON</td>
                    <td>2:30-4:00</td>
                    <td>GEN. ED. 102</td>
                    <td>101</td>
                    <td></td>
                </tr>
                <tr>
                    <td rowspan="2">12</td>
                    <td>THU</td>
                    <td>1:00-2:30</td>
                    <td>GEN. ED. 102</td>
                    <td>101</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>THU</td>
                    <td>2:30-4:00</td>
                    <td>GEN. ED. 102</td>
                    <td>101</td>
                    <td></td>
                </tr>
                <tr>
                    <td rowspan="2">16</td>
                    <td>MON</td>
                    <td>1:00-2:30</td>
                    <td>GEN. ED. 102</td>
                    <td>101</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>MON</td>
                    <td>2:30-4:00</td>
                    <td>GEN. ED. 102</td>
                    <td>101</td>
                    <td></td>
                </tr>
                <tr>
                    <td rowspan="2">19</td>
                    <td>THU</td>
                    <td>1:00-2:30</td>
                    <td>GEN. ED. 102</td>
                    <td>101</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>THU</td>
                    <td>2:30-4:00</td>
                    <td>GEN. ED. 102</td>
                    <td>101</td>
                    <td></td>
                </tr>
                <tr>
                    <td rowspan="2">23</td>
                    <td>MON</td>
                    <td>1:00-2:30</td>
                    <td>GEN. ED. 102</td>
                    <td>101</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>MON</td>
                    <td>2:30-4:00</td>
                    <td>GEN. ED. 102</td>
                    <td>101</td>
                    <td></td>
                </tr>
                <tr>
                    <td rowspan="2">26</td>
                    <td>THU</td>
                    <td>1:00-2:30</td>
                    <td>GEN. ED. 102</td>
                    <td>101</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>THU</td>
                    <td>2:30-4:00</td>
                    <td>GEN. ED. 102</td>
                    <td>101</td>
                    <td></td>
                </tr>
                <tr>
                    <td rowspan="2">30</td>
                    <td>MON</td>
                    <td>1:00-2:30</td>
                    <td>GEN. ED. 102</td>
                    <td>101</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>MON</td>
                    <td>2:30-4:00</td>
                    <td>GEN. ED. 102</td>
                    <td>101</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection