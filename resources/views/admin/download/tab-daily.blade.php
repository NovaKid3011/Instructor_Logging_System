<div class="tab-content " id="reportTabsContent">
<div class="tab-pane fade {{ request()->hasAny(['month', 'search']) ? '' : 'show active' }}" id="daily" role="tabpanel" aria-labelledby="daily-tab">

        <div class="card-d p-3">
        <div class="card-header">
        <h6>Today: {{ now()->format('l, F d, Y') 
        }}</h6>
        <div class="dropdown">
    <button 
        class="btn btn-primary dropdown-toggle" 
        type="button" 
        id="downloadDropdown" 
        data-bs-toggle="dropdown" 
        aria-expanded="false" 
        data-has-data="{{ $hasTodayData ? 'true' : 'false' }}">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="20" height="20" stroke-width="2">
            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
            <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
        </svg>
        Export
    </button>
    <ul class="dropdown-menu" aria-labelledby="downloadDropdown">
        <li>
            <a 
                class="dropdown-item" 
                href="{{ route('pdf-daily', ['search' => request('search'), 'month' => request('month')]) }}">
              PDF File
            </a>
        </li>
        <li>
            <a 
                class="dropdown-item" 
                href="{{ route('csv-daily', ['search' => request('search'), 'month' => request('month')]) }}" 
                id="csvOption">
                CSV
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="#" id="dprintOption">
                Print
            </a>
        </li>
    </ul>
</div>

<script>
    document.getElementById('dprintOption').addEventListener('click', function () {
        const printWindow = window.open('{{ route('print-daily') }}', '_blank');
            printWindow.onload = function () {
                setTimeout(() => printWindow.print(), 500);
            };

    });
</script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    var downloadDropdown = document.getElementById('downloadDropdown');

    downloadDropdown.addEventListener('click', function (event) {
        var hasData = this.getAttribute('data-has-data');

        if (hasData === 'false') {

            Swal.fire({
                title: 'No records for today.',
                icon: 'info',
                confirmButtonText: 'Okay'
            });
        }
    });
});

</script>



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
            <th>Justification</th>
        </tr>
    </thead>
    <tbody>
    @if (count($attendances) > 0)
        @foreach($attendances as $att)
            @if ($att->created_at->isToday())
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $att->created_at->format('h:i A') }}</td>
                <td><img src="" alt="photo evidence"></td>
                <td>{{ $att->first_name }} {{ $att->last_name }}</td>
                <td>{{ $att->subject_code ?? 'N/A' }}</td>
                <td>{{ $att->description ?? 'N/A' }}</td>
                <td>{{ $att->schedule ?? 'N/A' }}</td>
                <td>{{ $att->room ?? 'N/A' }}</td>
                <td>{{ $att->justification ?? 'N/A' }}</td>
            </tr>
            @endif
        @endforeach
    @endif

    </tbody>
</table>


                </div>
            </div>
        </div>