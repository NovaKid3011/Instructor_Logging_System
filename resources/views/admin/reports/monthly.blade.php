
@extends('layout.partials._head')
@section('content')

@vite('resources/css/report.css')

    <div class="container mt-4">
        
        <div class="card-header">
        <h4 class="mb-4">DECEMBER</h4>
        <div style="position: relative; width: 250px;">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-search"
                style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%); pointer-events: none;">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                <path d="M21 21l-6 -6" />
            </svg>
            <input
                type="search" placeholder="Search Instructor"
                style="width: 100%; padding: 5px 5px 5px 40px; border: 1px solid #ccc; border-radius: 50px; box-sizing: border-box;" />
        </div>

        </div>
        <div class="card-header">
                <h5> DR. APOLONIA SUAREZ</h5>
                <button class="print-btn no-print" onclick="window.print()">   
                PRINT</button>
            </div>
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-primary">
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
                    <td>1:00</td>
                    <td>Present</td>
                </tr>
                <tr>
                    <td>MON</td>
                    <td>2:30-4:00</td>
                    <td>GEN. ED. 102</td>
                    <td>101</td>
                    <td>2:23</td>
                    <td>Present</td>
                    
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
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection