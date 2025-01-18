@extends('layout.partials._head')

@section('content')

<div class="pt-3 px-5" id="employee"></div>

<div class="container mt-2">
    <div class="mx-3">
        <form id="filterForm" class="d-flex justify-content-end mb-3">
            <select name="month" id="month-select" style="padding: 5px; border:none;" class="search_form">
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
                <option class="" value="12" {{ request('month') == '12' ? 'selected' : '' }}>December</option>
            </select>
            <div class="form-outline">
                <input id="search-input" type="search" placeholder="Search instructor..." value="{{ request('search') }}" name="search" class="form-control p-1" style="font-size: small" hidden>
            </div>
            <button type="submit" class="btn btn-primary p-1" style="font-size: small">
                <i class="fas fa-search"></i> Search
                <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-search"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
            </button>
        </form>



        <div class="table-container ">
            @if (request('month') == null)
                <p class="fs-6 d-flex justify-content-center text-secondary">Please select a month.</p>
            @elseif ($attendances->isEmpty())
                <p>No record available for this month.</p>
            @else
                <div>
                @foreach ($attendances->groupBy(function ($att) {
                    return $att->first_name . ' ' . $att->last_name;
                    }) as $fullName => $userAttendances)
                    <div class="containner d-flex justify-content-between">
                        <div>
                            <p>{{ $userAttendances->first()->created_at->format('F Y') }}</p>
                        </div>
                        <a class="print"
                            href="{{ route('instructor.monthly_report', ['month' => request('month'),  'instructor_id' => request('id')]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="20" height="20" stroke-width="2">
                                <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
                            </svg>
                            Download CSV
                        </a>
                    </div>

                    <table class="table table-striped table-bordered table-responsive" id="monthlyTable">
                        <thead class="table-primary">
                            <tr>
                                <th>Date</th>
                                <th>Day</th>
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


<script>
    $(document).ready(function() {
        $('#monthlyTable').DataTable();
    });

    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    }

    const fname = getUrlParameter('first_name');
    const lname = getUrlParameter('last_name');
    const mname = getUrlParameter('middle_name');
    const image = getUrlParameter('image');

    $('#employee').html(`
        <a href="{{ route('instructor') }}" class="text-decoration-none text-dark">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-chevron-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
            Back
        </a>
        <div class="d-flex align-items-center mt-4">
            <img class="border border-primary" src="${image}" alt="Profile Image" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
            <div>
                <p class="mx-3 mb-0 fs-5">${lname}, ${fname} ${mname}</p>
                <small class="mx-3 px-1 text-secondary">Instructor</small>
            </div>
        </div>
    `);
</script>

<script>
    document.getElementById('filterForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const month = document.getElementById('month-select').value;
        const search = document.getElementById('search-input').value;
        const urlParams = new URLSearchParams(window.location.search);

        if (month) {
            urlParams.set('month', month);
        } else {
            urlParams.delete('month');
        }

        if (search) {
            urlParams.set('search', search);
        } else {
            urlParams.delete('search');
        }

        window.location.search = urlParams.toString();
    });
</script>

<script>
    document.getElementById('filterForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const month = document.getElementById('month-select').value;
        const search = document.getElementById('search-input').value;
        const urlParams = new URLSearchParams(window.location.search);

        if (month) {
            urlParams.set('month', month);
        } else {
            urlParams.delete('month');
        }

        if (search) {
            urlParams.set('search', search);
        } else {
            urlParams.delete('search');
        }

        // Update the download link with the current URL parameters
        const downloadLink = document.getElementById('download-csv-link');
        const baseDownloadUrl = downloadLink.getAttribute('href').split('?')[0];
        downloadLink.href = `${baseDownloadUrl}?${urlParams.toString()}`;

        window.location.search = urlParams.toString();
    });
</script>


@endsection
