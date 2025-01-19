@extends('layout.partials._head')
@section('content')

<style>
    
    body{
    background-color: #e8f1fb;
}
.card-header {
    display: flex;
    justify-content: space-between;
    background-color: #fff;
    align-items: center;
}
.card-header-meow{
    display: flex;
    justify-content: flex-end;
    /* height: 100px; */

}

.card-d{
    box-shadow: 0 10px 20px 10px rgba(0, 0, 0, 0.1);
    margin-top: 0;
    padding: 0;
}
.tab-pane{
    background-color: #fff;

}
.nav-tab{
    display: flex;
    background-color: #e8f1fb;
}
.nav-link :active{
    border: none;
}
/* .nav-link:hover{
    background-color: #a8c4e5;
} */

.containner{
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid #b3b5b7;
    padding-top: 10px;
}

.containner p, h3{
    margin:0;
}
.print{
    background-color: #0c8c00;
    color: #fff;
    border: none;
    padding: 6px;
    margin-top: 25px 0 25px 0;
    border-radius: 4px;
    height: fit-content;
    text-decoration: none;
}

#reportTabs{
    display: flex;
    margin: 0;
}
.nav-link.active {
    background-color: #007bff;
    color: white;
}
.nav-link {
    transition: background-color 0.3s ease;
}
    form {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 10px;
    }

    .form-outline input {
        width: 100%;
        padding: 10px 10px 10px 40px;
        border: 1px solid #CFE2FF;
        border-radius: 4px 0 0 4px;
    }

    .btn-primary {
        padding: 10px ;
        border-radius: 0 4px 4px 0;
    }
    
    h6{
        margin:0;
        padding:0;
        font-weight: 500;
    }
    
    img{
        height: 50px;
        width: auto;
    }

    .result {
        margin-top: 20px;
        padding: 10px;
        border: 1px solid #CFE2FF;
        border-radius: 4px;
    }

    .result ul {
        list-style: none;
        padding: 0;
    }

    .result ul li {
        margin: 5px 0;
    }

    .result ul li a {
        text-decoration: none;
        color: #007bff;
    }

    .result ul li a:hover {
        text-decoration: underline;
    }


</style>
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
        <div>
            <h6>List of Instructors who timed in today:</h6>
            <div class="text-secondary">
                {{ now()->format('l, F d, Y') }}
            </div>
            
        </div>
        @if(isset($attendances) && count($attendances) > 0 && $attendances->first()->created_at->isToday())
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
            <th>Subject Code</th>
            <th>Description</th>
            <th>Schedule</th>
            <th>Room</th>
        </tr>
    </thead>
    <tbody>
    @if (count($attendances) > 0)
        @foreach($attendances as $att)
            @if ($att->created_at->isToday())
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $att->created_at->format('h:i A') }}</td>
                <td><img src="{{ Storage::url('webcam/' . $att->photo) }}" alt="photo evidence"></td>
                <td>{{ $att->first_name }} {{ $att->last_name }}</td>
                <td>{{ $att->subject_code ?? 'N/A' }}</td>
                <td>{{ $att->description ?? 'N/A' }}</td>
                <td>{{ $att->schedule ?? 'N/A' }}</td>
                <td>{{ $att->room ?? 'N/A' }}</td>
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

    @if ($attendances->isEmpty())
        <p>No record available for this month.</p>
    @else
        @isset($search)
            <div>
                <div class="containner">
                    <div>
                        <h3>{{ $attendances->first()->first_name }} {{ $attendances->first()->last_name }}</h3>
                    <p>{{ $attendances->first()->created_at->format('F Y') }}</p>
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
                            <th>Subject Code</th>
                            <th>Description</th>
                            <th>Schedule</th>
                            <th>Room</th>
                            <th>Justification</th></tbody>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendances as $att)
                            <tr>
                                <td>{{ $att->created_at->format('d') }}</td>
                                <td>{{ $att->created_at->format('l') }}</td>
                                <td>
                                    <td><img src="{{ Storage::url('webcam/' . $att->photo) }}" alt="photo evidence"></td>
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
        @else
        <div>
    @foreach ($attendances->groupBy(function ($att) {
        return $att->first_name . ' ' . $att->last_name;
    }) as $fullName => $userAttendances)
        <div class="containner">
            <div>
                <h3>{{ $fullName }}</h3>
                <p>{{ $userAttendances->first()->created_at->format('F Y') }}</p>
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
                    <th>Subject Code</th>
                    <th>Description</th>
                    <th>Schedule</th>
                    <th>Room</th>
                    <th>Justification</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userAttendances as $att)
                    <tr>
                        <td>{{ $att->created_at->format('d') }}</td>
                        <td>{{ $att->created_at->format('l') }}</td>
                            <td><img src="{{ Storage::url('webcam/' . $att->photo) }}" alt="photo evidence"></td>
                        <td>{{ $att->subject_code ?? 'N/A' }}</td>
                        <td>{{ $att->description ?? 'N/A' }}</td>
                        <td>{{ $att->schedule ?? 'N/A' }}</td>
                        <td>{{ $att->room ?? 'N/A' }}</td>
                        <td>{{ $att->justification ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</div>


        @endisset
    @endif
</div>


</div>

    </div>
</div>
@include('admin.search-instructor')



@endsection
