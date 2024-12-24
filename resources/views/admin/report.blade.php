@extends('layout.partials._head')
@section('content')

@vite('resources/css/report.css')
<div class="container mt-4">
<ul class="nav-tab nav-tabs display-flex" id="reportTabs" role="tablist" style="list-style: none; padding: 0;">
    <li class="nav-item" role="presentation">
        <button 
            class="nav-link active" 
            id="daily-tab" 
            data-bs-toggle="tab" 
            data-bs-target="#daily" 
            type="button" 
            role="tab" 
            aria-controls="daily" 
            aria-selected="true"
            style="font-weight: bold; text-decoration:none; border-radius: 0; padding: 10px 20px;"
        >
            DAILY
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button 
            class="nav-link" 
            id="monthly-tab" 
            data-bs-toggle="tab" 
            data-bs-target="#monthly" 
            type="button" 
            role="tab" 
            aria-controls="monthly" 
            aria-selected="false"
            style="font-weight: bold; text-decoration:none; border-radius: 0; padding: 10px 20px;"
        >
            MONTHLY
        </button>
    </li>
</ul>



    <div class="tab-content mt-4" id="reportTabsContent">
        <div class="tab-pane fade show active" id="daily" role="tabpanel" aria-labelledby="daily-tab">
            
            <div class="card-d p-4 mt-2 border-0">
            <div class="card-header">
                <h6>Monday, DECEMBER 06, 2024</h6>
                <button class="print-btn no-print" onclick="window.print()">PRINT</button>
            </div>
                <div class="table-container mt-3">
                    <table class="table table-striped table-bordered table-responsive" id="myTable">
                        <thead class="table-primary">
                            <tr>
                                <th>Time In</th>
                                <th>Picture</th>
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
                                <td></td>
                                <td>MR. MARK JOSEPH C. GIGANTE</td>
                                <td>IT ELEC 102</td>
                                <td>Example Description</td>
                                <td>07:30 AM - 09:00 PM at 103</td>
                                <td>103</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="monthly" role="tabpanel" aria-labelledby="monthly-tab">
            <div class="card-header">
            <select name="month" id="month-select" style="padding: 5px; border-radius: 5px;">
                <option value="" disabled selected>Select a month</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
            <div class="tab"></div>
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
            <button class="print-btn no-print" onclick="window.print()">PRINT</button>
        
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
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="2">2</td>
                        <td>MON</td>
                        <td>1:00-2:30</td>
                        <td>GEN. ED. 102</td>
                        <td>101</td>
                        <td>01:00</td>
                        <td>Present</td>
                    </tr>
                    <tr>
                        <td>MON</td>
                        <td>2:30-4:00</td>
                        <td>GEN. ED. 102</td>
                        <td>101</td>
                        <td>02:23</td>
                        <td>Present</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection