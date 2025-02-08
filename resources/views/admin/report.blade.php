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

    .td_image img{
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
        @if(empty($attendances))
            <p>No record.</p>
        @elseif(count($attendances) > 0 || $attendances->first()->created_at->isToday())
            <div class="containner d-flex justify-content-between align-items-center">
                <form action="{{ route('report.daily_report', ['month' => request('month'), 'search' => request('search')]) }}"  id="exportType" class="d-flex justify-content-end mb-2" method="GET" onsubmit="exportForm(event)">
                    <input type="hidden" name="month" value="{{ request('month') }}">
                    <input type="hidden" name="instructor_id" value="{{ request('id') }}">
                    <select name="download" id="download" style="padding: 5px; border: 1px solid #bebebe; border-radius: 5px 0 0 5px" class="search_form">
                        <option value="" disabled selected>Export Option</option>
                        <option value="1" {{request('download') == 1 ? 'selected' : ''}}>Download CSV</option>
                        <option value="2" {{request('download') == 2 ? 'selected' : ''}}>PDF File</option>
                        <option value="3" {{request('download') == 3 ? 'selected' : ''}}>Print</option>
                    </select>
                    <button type="submit" class="btn btn-primary px-3 py-1" style="font-size: small; border-radius: 0 5px 5px 0">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-upload"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 9l5 -5l5 5" /><path d="M12 4l0 12" /></svg>
                    </button>
                </form>
            </div>
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
                <td class="td_image"><img src="{{ Storage::url('webcam/' . $att->photo) }}" alt="photo evidence"></td>
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
    <div class="d-flex align-items-center justify-content-between" style="width: 100%;">
        <a class="text-decoration-none text-light btn btn-primary btn-sm" href="{{route("instructor")}}" style="border-radius: 5px; font-size: 12px;">
            <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-download"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 11l5 5l5 -5" /><path d="M12 4l0 12" /></svg>
            Download individual reports
        </a>
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
</div>
<div class="exportAction d-flex flex-row-reverse">
    <div class="containner d-flex justify-content-between align-items-center">
        <form action="{{ route('report.monthly_report', ['month' => request('month'), 'search' => request('search')]) }}"  id="exportType" class="d-flex justify-content-end mb-2" method="GET" onsubmit="downloadForm(event)">
            <input type="hidden" name="month" value="{{ request('month') }}">
            <input type="hidden" name="instructor_id" value="{{ request('id') }}">
            <select name="export" id="export" style="padding: 5px; border: 1px solid #bebebe; border-radius: 5px 0 0 5px" class="search_form">
                <option value="" disabled selected>Export Option</option>
                <option value="1" {{request('export') == 1 ? 'selected' : ''}}>Download CSV</option>
                <option value="2" {{request('export') == 2 ? 'selected' : ''}}>PDF File</option>
                <option value="3" {{request('export') == 3 ? 'selected' : ''}}>Print</option>
            </select>
            <button type="submit" class="btn btn-primary px-3 py-1" style="font-size: small; border-radius: 0 5px 5px 0">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-upload"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 9l5 -5l5 5" /><path d="M12 4l0 12" /></svg>
            </button>
        </form>
    </div>
</div>

<div class="table-container">

    @if ($attendances->isEmpty())
        <p>No record available for this month.</p>
    @else

        @foreach ($attendances->groupBy(fn($att) => $att->instructor_id) as $userAttendances)
            <div class="containner">
                <div>
                    <h5>{{ $userAttendances->first()->last_name }}, {{ $userAttendances->first()->first_name }}</h5>
                    <p>{{ $userAttendances->first()->created_at->format('F Y') }}</p>
                </div>
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
    @endif
</div>



</div>


</div>

    </div>
</div>
@include('admin.search-instructor')

<script>
    function exportForm() {
        var option = document.getElementById('download').value;
        if(option === '') {
            alert('Please select an export method.');
            event.preventDefault();
        }
    }
</script>

<script>
    function downloadForm() {
        var option = document.getElementById('export').value;
        if(option === '') {
            alert('Please select an export method.');
            event.preventDefault();
        }
    }
</script>

@endsection
