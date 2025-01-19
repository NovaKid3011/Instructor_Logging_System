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
        <div>
    @foreach ($attendances->groupBy(function ($att) {
        return $att->first_name . ' ' . $att->last_name;
    }) as $fullName => $userAttendances)
        <div class="containner">
            <div>
                <h3>{{ $fullName }}</h3>
                <p>{{ $userAttendances->first()->created_at->format('F Y') }}</p>
            </div>
            <div class="dropdown">
            <button 
                class="btn btn-primary dropdown-toggle" 
                type="button" 
                id="downloadDropdown" 
                data-bs-toggle="dropdown" 
                aria-expanded="false" 
                data-has-data="{{ $hasTodayData ? 'true' : 'false' }}">
                Export
            </button>
            <ul class="dropdown-menu" aria-labelledby="downloadDropdown">
                <li>
                    <a 
                        class="dropdown-item" 
                        href="{{ route('pdf-byymonth', [
                            'search' => request('search'), 
                            'month' => request('month'), 
                            'instructor_id' => $userAttendances->first()->instructor_id     
                        ]) }}">
                        PDF File
                    </a>
                </li>
                <li>
                    <a 
                        class="dropdown-item" 
                        href="{{ route('csv-by-month', [
                            'search' => request('search'), 
                            'month' => request('month'), 
                            'instructor_id' => $userAttendances->first()->instructor_id
                        ]) }}" 
                        id="csvOption">
                        CSV
                    </a>
                </li>
                <li>
            <a class="dropdown-item" href="#" id="mprintOption">
                Print
            </a>
        </li>
    </ul>
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
                        <td>
                            <img src="{{ asset('images/' . $att->picture) }}" alt="Picture" width="50px">
                        </td>
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


    @endif
</div>


</div>

    </div>
</div>
@include('admin.search-instructor')
