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
            <h6>Today: {{ now()->format('l, F d, Y') }}</h6>                
            <button class="print-btn no-print" onclick="window.print()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="20" height="20" stroke-width="2"> <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path> <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path> <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path> </svg> PRINT</button>            </div>
                <div class="table-container mt-3">
                <table class="table table-striped table-bordered table-responsive" id="myTable">
    <thead class="table-primary">
        <tr>
            <th>#</th>
            <th>Time In</th>
            <th>Picture</th>
            <th>Name</th>
            <th>Subject Code</th>
            <th>Description</th>
            <th>Schedule</th>
            <th>Room</th>
            <th>Justification</th>
        </tr>
    </thead>
    <tbody>
        @if (count($attendance) > 0)

        @foreach($attendance as $att)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>7:00 AM</td>
            <td><img src="" alt="photo evidence"></td>
            <td>{{ $att->first_name }} {{ $att->last_name }}</td>
            <td>{{ $atts->subject_code ?? 'N/A' }}</td>
            <td>{{ $att->description ?? 'N/A' }}</td>
            <td>{{ $att->schedule ?? 'N/A' }}</td>
            <td>{{ $att->room ?? 'N/A' }}</td>
            <td>{{ $att->justification ?? 'N/A' }}</td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>


                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="monthly" role="tabpanel" aria-labelledby="monthly-tab">
    <div class="card-d p-4">
    
    <div class="card-header-meow">
    <form action="{{ route('report') }}" method="GET">
                    <div class="form-outline">
                        <!-- <input type="text" name="search" value="{{ request('search') }}" placeholder="Search"> -->
    
                    <input id="search-input" type="search" placeholder="Search instructor..." value="{{ request('search') }}" name="search" class="form-control p-1">
                    </div>
                    <button type="submit" class="btn btn-primary p-1">
                        <i class="fas fa-search"></i> Search
                    </button>
                </form>

    <select name="month" id="month-select" style="padding: 5px; border:none;">
        <option value="" disabled selected>{{ now()->format('F')}}</option>
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
        <h3>Mr. Sample Layout</h3>
        <p >December 2024</p>
        </div>
        <button class="print-btn no-print" onclick="window.print()">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="20" height="20" stroke-width="2"> <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path> <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path> <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path> </svg> PRINT</button>
    </div>

        <table class="table table-striped table-bordered table-responsive" id="myTable">
            
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
                    <tr><td colspan="9">No attendance data available yet.</td></tr>
                @endif
                @isset($search)
                    <div>
                        <p>Search Results for "{{ $search }}"</p>
                        @if($results->isEmpty())
                            <p>No results found.</p>
                        @else
                            <ul>
                                @foreach($results as $result)
                                    <a href="">{{ $result->first_name }}</a>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endisset

            </tbody>
        </table>
    </div>
</div>

    </div>
</div>



@endsection