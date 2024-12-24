@extends('layout.partials._head')
@section('content')

@vite('resources/css/report.css')
<div class="container mt-3">
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
            style="font-weight: bold; text-decoration:none; border: none; border-radius: 0; padding: 10px 20px;"
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
            style="font-weight: bold; text-decoration:none; border: none; border-radius: 0; padding: 10px 20px;"
        >
            MONTHLY
        </button>
    </li>
</ul>



    <div class="tab-content " id="reportTabsContent">
        <div class="tab-pane fade show active" id="daily" role="tabpanel" aria-labelledby="daily-tab">
            
            <div class="card-d p-4">
            <div class="card-header">
                <h6>Today Mon, DECEMBER 06, 2024</h6>
                <button class="print-btn no-print" onclick="window.print()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="20" height="20" stroke-width="2"> <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path> <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path> <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path> </svg> PRINT</button>            </div>
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
                            <tr>
                                <td>07:30 AM</td>
                                <td></td>
                                <td>DetDet Gwapa</td>
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
    <div class="card-d p-4">
    
    <div class="card-header-meow">
        
        <div style="position: relative; width: 200px;">
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
        <select name="month" id="month-select" style="padding: 5px; border:none;">
            <option value="" disabled selected>This month</option>
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
    </div>
    <div class="table-container">
    <div class="containner">
        <div>
        <h3>Mr. Emanuelle Barrientos</h3>
        <p >December 2024</p>
        </div>
        <button class="print-btn no-print" onclick="window.print()">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="20" height="20" stroke-width="2"> <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path> <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path> <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path> </svg> PRINT</button>
    </div>


        <table class="table table-striped table-bordered table-responsive" id="monthlyTable">
            
        <thead class="table-primary">
                <tr>
                    <th>Date</th>
                    <th>Day</th>
                    <th>Picture</th>
                    <th>Subject Code</th>
                    <th>Description</th>
                    <th>Schedule</th>
                    <th>Room</th>
                    <th>Status</th>
                    <th>Justification (if absent)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    
                    <td>2</td>
                    <td>Mon</td>
                    <td><img src="{{ '/images/cat.jpg'}}" alt="meow" width="50px"></td>
                    <td>GEN. ED. 102</td>
                    <td>Example Description</td>
                    <td>01:00 PM - 02:30 PM at 101</td>
                    <td>101</td>
                    <td>Present</td>
                    <td>N/A</td>
                </tr>
                @if(isset($attendances) && $attendances->count())
                @foreach($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->id }}</td>
                        <td>{{ $attendance->time_in }}</td>
                        <td><img src="{{ asset('images/' . $attendance->picture) }}" alt="Picture" width="50px"></td>
                        <td>{{ $attendance->subject_code }}</td>
                        <td>{{ $attendance->description }}</td>
                        <td>{{ $attendance->schedule }}</td>
                        <td>{{ $attendance->room }}</td>
                        <td>{{ $attendance->status }}</td>
                        <td>N/A</td>
                    </tr>
                @endforeach
                @else
                    <tr><td colspan="9">No attendance data available.</td></tr>
                @endif

            </tbody>
        </table>
    </div>
</div>

    </div>
</div>

@endsection