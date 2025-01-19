@extends('layout.partials._head')

@section('content')

<<<<<<< HEAD
<div class="pt-3 px-5" id="employee"></div>

<style>
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

.else{
    text-align: center;
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
</style>

<div class="container mt-2">
    <div class="mx-3">
        <form id="filterForm" class="d-flex justify-content-end mb-3">
            <select name="month" id="month-select" style="padding: 5px; border:none;" class="search_form">
                <option value="" disabled selected>Filter by month</option>
=======
<div class="instructor-cons mt-4">
    <a href="{{route("instructor")}}" class="px-4 text-decoration-none text-dark">
        <svg  xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l4 4" /><path d="M5 12l4 -4" /></svg>
        Back
    </a>
    <div class="d-flex justify-content-between align-items-center mt-4 pt-2">
        <div class="px-4 employee-con d-flex align-items-center" id="employee"></div>

        <form action="{{route("instructor.monthly", ['id' => request('id')])}}" id="filterForm" class="d-flex justify-content-end mb-2 mx-4 px-1" style="height: 35px">
            <select name="month" id="month-select" style="padding: 5px; border: none;" class="search_form">
                <option value="" disabled selected>Select month</option>
>>>>>>> 2c85b84b872e7005a88169006673644fb3fb4313
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
            <button type="submit" class="btn btn-primary px-3 py-1" style="font-size: small;">
                <i class="fas fa-search"></i> Filter by month
                <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-filter"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z" /></svg>
            </button>
        </form>
    </div>
</div>

<div class="container">
    <div class="mx-3 mt-4">
        <div class="table-container ">
<<<<<<< HEAD
            @if (request('month') == null)
                <p class="fs-6 d-flex justify-content-center text-secondary">Please select a month.</p>
            @elseif ($attendances->isEmpty())
                <p class="else">No record available for this month.</p>
            @else
=======
            @if ($attendances->isEmpty())
                <p class="d-flex justify-content-center text-secondary">No record available for this month.</p>
            @elseif ($attendances)
>>>>>>> 2c85b84b872e7005a88169006673644fb3fb4313
                <div>
                @foreach ($attendances->groupBy(function ($att) {
                    return $att->first_name . ' ' . $att->last_name;
                    }) as $fullName => $userAttendances)
                    <div class="containner d-flex justify-content-between">
                        <div>
                            <p>{{ $userAttendances->first()->created_at->format('F Y') }}</p>
                        </div>
                        <form action="{{ route('instructor.monthly_report', ['month' => request('month'), 'instructor_id' => request('id')]) }}" id="filterForm" class="d-flex justify-content-end mb-2" method="GET">
                            <input type="hidden" name="month" value="{{ request('month') }}">
                            <input type="hidden" name="instructor_id" value="{{ request('id') }}">
                            <select name="download" id="download" style="padding: 5px; border: 1px solid #bebebe; border-radius: 5px 0 0 5px" class="search_form">
                                <option value="" disabled selected>Export Option</option>
                                <option value="1" {{request('download') == 1 ? 'selected' : ''}}>Download CSV</option>
                                <option value="2" {{request('download') == 2 ? 'selected' : ''}}>PDF File</option>
                                <option value="3" {{request('download') == 3 ? 'selected' : ''}}>Print</option>
                            </select>
                            <div class="form-outline">
                                <input id="download-type" type="search" placeholder="Search instructor..." value="{{ request('search') }}" name="search" class="form-control p-1" style="font-size: small" hidden>
                            </div>
                            <button type="submit" class="btn btn-primary px-3 py-1" style="font-size: small; border-radius: 0 5px 5px 0">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-upload"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 9l5 -5l5 5" /><path d="M12 4l0 12" /></svg>
                            </button>
                        </form>
                        {{-- <form action="{{ route('instructor.monthly_report', ['month' => request('month'),  'instructor_id' => request('id')]) }}">
                            <div class="input-group" style="width:230px">
                                <button type="submit" class="btn btn-primary px-2 py-1" style="font-size: small">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="22"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-download"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 11l5 5l5 -5" /><path d="M12 4l0 12" /></svg>
                                </button>
                                <select class="form-select" id="inputGroupSelect01">
                                <option selected disabled>Download Option</option>
                                <option value="1">
                                    <a class="print "
                                        href="">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="20" height="20" stroke-width="2">
                                            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                                            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                            <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
                                        </svg>
                                        Download CSV
                                    </a>
                                </option>
                                <option value="2">PDF File</option>
                                <option value="3">Print</option>
                                </select>
                            </div>
                        </form> --}}
                    </div>
            @else
                <div class="containner d-flex justify-content-between align-items-center">
                    <div>
                        <p class="fs-6">{{ $attendances->first()->created_at->format('F Y') }}</p>
                    </div>
                    <form action="{{ route('instructor.monthly_report', ['month' => request('month'), 'instructor_id' => request('id')]) }}"  id="exportType" class="d-flex justify-content-end mb-2" method="GET" onsubmit="exportForm(event)">
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

                <table class="table table-striped table-bordered table-responsive" id="monthlyTable">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Time in</th>
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
                        @foreach ($attendances as $att)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $att->created_at->timezone('Asia/Manila')->format('h:i A') }}</td>
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
            </div>
        @endif
    </div>
</div>


<script>
        let selectedIds = @json(collect($data)->filter(fn($item) => $item['selected'])->pluck('id'));

        let filteredData = @json($data).filter(item => item.selected);

    function displyInstructor(data) {
        const parentCon = document.querySelector('.employee-con');

        const image = document.createElement('img');
        image.src = `${data.image}`;
        image.style.width = '130px';
        image.style.borderRadius = '50%';
        image.style.border = '1px solid #284eb6';
        image.style.height = '130px';

        const fName = document.createElement('div');
        fName.className = 'fname';
        fName.textContent = `${data.last_name}, ${data.first_name} ${data.middle_name ? data.middle_name[0] + '.' : ''}`;
        fName.style.fontSize = '25px';
        fName.style.marginLeft = '25px';

        parentCon.appendChild(image);
        parentCon.appendChild(fName);

    }
    function addChildTag(){
        const childCon = document.querySelector('.fname');
        const pTag = document.createElement('p');
        pTag.textContent = 'Instructor';
        pTag.style.fontSize = '13px';
        pTag.style.marginLeft = '3px';
        pTag.style.color = '#909090';

        childCon.appendChild(pTag);
    }

    filteredData.forEach(item => {
        displyInstructor(item);
        addChildTag();
    });



</script>

<script>
    function exportForm() {
        var option = document.getElementById('download').value;
        if(option === '') {
            alert('Please select an export method');
            event.preventDefault();
        }
        // else{
        //     // setTimeout(() => {
        //     //    alert('Exported successfully');
        //     // }, 1000);
        //     // return true;
        // }
    }
</script>

{{-- <script>
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

        window.location.search = urlParams.toString();
    });
</script> --}}

{{-- <script>
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

        // // Update the download link with the current URL parameters
        // const downloadLink = document.getElementById('download-csv-link');
        // const baseDownloadUrl = downloadLink.getAttribute('href').split('?')[0];
        // downloadLink.href = `${baseDownloadUrl}?${urlParams.toString()}`;

        // window.location.search = urlParams.toString();
    });
</script> --}}


@endsection
