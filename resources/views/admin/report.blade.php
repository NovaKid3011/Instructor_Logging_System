@extends('layout.partials._head')
@section('content')

@vite('resources/css/report.css')
<div class="container mt-3">
<ul class="nav-tab nav-tabs display-flex" id="reportTabs" role="tablist" style="list-style: none; padding: 0;">
    <li class="nav-item" role="presentation">
        <button 
            class="nav-link {{ request()->hasAny(['month', 'search']) ? '' : 'active' }}" 
            id="daily-tab" 
            data-bs-toggle="tab" 
            data-bs-target="#daily" 
            type="button" 
            role="tab" 
            aria-controls="daily" 
            aria-selected="{{ request()->hasAny(['month', 'search']) ? 'false' : 'true' }}"
            style="font-weight: bold; text-decoration:none; border: none; border-radius: 0; padding: 10px 20px;"
        >
            DAILY
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button 
            class="nav-link {{ request()->hasAny(['month', 'search']) ? 'active' : '' }}" 
            id="monthly-tab" 
            data-bs-toggle="tab" 
            data-bs-target="#monthly" 
            type="button" 
            role="tab" 
            aria-controls="monthly" 
            aria-selected="{{ request()->hasAny(['month', 'search']) ? 'true' : 'false' }}"
            style="font-weight: bold; text-decoration:none; border: none; border-radius: 0; padding: 10px 20px;"
        >
            MONTHLY
        </button>
    </li>
</ul>




<div class="tab-content " id="reportTabsContent">
<div class="tab-pane fade {{ request()->hasAny(['month', 'search']) ? '' : 'show active' }}" id="daily" role="tabpanel" aria-labelledby="daily-tab">

        <div class="card-d p-3">
        <div class="card-header">
        <h6>Today: {{ now()->format('l, F d, Y') }}</h6>                
        @if(count($attendance) > 0 && $attendance->first()->created_at->isToday())
        <a class="print" href="{{ route('report.daily_report', ['search' => request('search'), 'month' => request('month')]) }}">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="20" height="20" stroke-width="2">
            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
            <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
        </svg>
        Download CSV
    </a>
@else
    <span class="print">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="20" height="20" stroke-width="2">
        <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
        <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
        <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
    </svg>
        Download CSV
    </span>
@endif
           
        </div>
            <div class="table-container mt-3">
            <table class="table table-striped table-bordered table-responsive" id="myTable">
    <thead class="table-primary">
        <tr>
            <th>#</th>
            <th>Time In</th>
            <th>Picture</th>
            <th>Name</th>   
            <!-- <th>Subject Code</th>
            <th>Description</th>
            <th>Schedule</th>
            <th>Room</th> -->
            <!-- <th>Justification</th> -->
        </tr>
    </thead>
    <tbody>
    @if (count($attendance) > 0)
        @foreach($attendance as $att)
            @if ($att->created_at->isToday())
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $att->created_at->format('h:i A') }}</td>                
                <td><img src="" alt="photo evidence"></td>
                <td>{{ $att->first_name }} {{ $att->last_name }}</td>
                <!-- <td>{{ $att->subject_code ?? 'N/A' }}</td>
                <td>{{ $att->description ?? 'N/A' }}</td>
                <td>{{ $att->schedule ?? 'N/A' }}</td>
                <td>{{ $att->room ?? 'N/A' }}</td> -->
                <!-- <td>{{ $att->justification ?? 'N/A' }}</td>     -->
            </tr>
            @endif
        @endforeach
    @endif

    </tbody>
</table>


                </div>
            </div>
        </div>
        <div class="tab-pane fade {{ request()->hasAny(['month', 'search']) ? 'show active' : '' }}" id="monthly" role="tabpanel" aria-labelledby="monthly-tab">
        <div class="card-d p-4">
    
    <div class="card-header-meow">
    <form action="{{ route('report') }}" method="GET">
        <select name="month" id="month-select" style="padding: 5px; border:none;">
            <option value="" disabled selected>Filter by month</option>
            <option value="1" {{ request('month') == '1' ? 'selected' : '' }}>January</option>
            <option value="2" {{ request('month') == '2' ? 'selected' : '' }}>February</option>
            <option value="3" {{ request('month') == '3' ? 'selected' : '' }}>March</option>
            <option value="4" {{ request('month') == '4' ? 'selected' : '' }}>April</option>
            <option value="5" {{ request('month') == '5' ? 'selected' : '' }}>May</option>
            <option value="6" {{ request('month') == '6' ? 'selected' : '' }}>June</option>
            <option value="7" {{ request('month') == '7' ? 'selected' : '' }}>July</option>
            <option value="8" {{ request('month') == '8' ? 'selected' : '' }}>August</option>
            <option value="9" {{ request('month') == '9' ? 'selected' : '' }}>September</option>
            <option value="10" {{ request('month') == '10' ? 'selected' : '' }}>October</option>
            <option value="11" {{ request('month') == '11' ? 'selected' : '' }}>November</option>
            <option value="12" {{ request('month') == '12' ? 'selected' : '' }}>December</option>
        </select>
        <div class="form-outline">
            <input id="search-input" type="search" placeholder="Search instructor..." value="{{ request('search') }}" name="search" class="form-control p-1" style="font-size: small">
        </div> 
        <button type="submit" class="btn btn-primary p-1" style="font-size: small">
            <i class="fas fa-search"></i> Search
        </button>
    </form>
</div>

<div class="table-container">

    @if ($attendance->isEmpty())
        <p>No record available for this month.</p>
    @else
        @isset($search)
            <div>
                <div class="containner">
                    <div>
                        <h3>{{ $attendance->first()->first_name }} {{ $attendance->first()->last_name }}</h3>
                    <p>{{ $attendance->first()->created_at->format('F Y') }}</p>
                    </div>
                    <a class="print" href="{{ route('report.monthly_report', ['search' => request('search'), 'month' => request('month')]) }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="20" height="20" stroke-width="2">
                            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                            <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
                        </svg>
                        Download CSV
                    </a>
                </div>

                <table class="table table-striped table-bordered table-responsive" id="myTable">
                    <thead class="table-primary">
                        <tr>
                            <th>Date</th>
                            <th>Day</th>
                            <th>Picture</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendance as $att)
                            <tr>
                                <td>{{ $att->created_at->format('d') }}</td>
                                <td>{{ $att->created_at->format('l') }}</td>
                                <td>
                                    <img src="{{ asset('images/' . $att->picture) }}" alt="Picture" width="50px">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
        <div>
                <div class="containner">
                    <div>
                        <h3>{{ $attendance->first()->first_name }} {{ $attendance->first()->last_name }}</h3>
                    <p>{{ $attendance->first()->created_at->format('F Y') }}</p>
                    </div>
                    <a class="print" href="{{ route('report.monthly_report', ['search' => request('search'), 'month' => request('month')]) }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="20" height="20" stroke-width="2">
                            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                            <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
                        </svg>
                        Download CSV
                    </a>
                </div>

                <table class="table table-striped table-bordered table-responsive" id="myTable">
                    <thead class="table-primary">
                        <tr>
                            <th>Date</th>
                            <th>Day</th>
                            <th>Picture</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendance as $att)
                            <tr>
                                <td>{{ $att->created_at->format('d') }}</td>
                                <td>{{ $att->created_at->format('l') }}</td>
                                <td>
                                    <img src="{{ asset('images/' . $att->picture) }}" alt="Picture" width="50px">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @endisset
    @endif
</div>


</div>

    </div>
</div>
@include('admin.search-instructor')



@endsection