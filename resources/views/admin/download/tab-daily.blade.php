<div class="tab-content " id="reportTabsContent">
<div class="tab-pane fade {{ request()->hasAny(['month', 'search']) ? '' : 'show active' }}" id="daily" role="tabpanel" aria-labelledby="daily-tab">

        <div class="card-d p-3">
        <div class="card-header">
        <h6>Today: {{ now()->format('l, F d, Y') 
        }}</h6>
       
       <div class="d-inline-flex" style="border: 1px solid #bebebe; border-radius: 5px; width:200px; font-size:inherit;"
       data-has-data = "false">
    <select 
        name="download" 
        id="downloadDropdownd" 
        class="form-select"         
        style="padding: 5px; border: 1px; border-radius: 8px; outline: none; font-size:small;">
        <option value="" disabled selected>Export Option</option>
        <option 
            value="{{ route('csv-daily', ['search' => request('search'), 'month' => request('month')]) }}">
            Download CSV
        </option>
        <option 
            value="{{ route('pdf-daily', ['search' => request('search'), 'month' => request('month')]) }}">
            PDF File
        </option>
        <option 
            value="{{ route('print-daily', ['search' => request('search'), 'month' => request('month')]) }}">
            Print
        </option>
    </select>
    <button 
        class="btn btn-primary" 
        style="padding: 5px 20px; border-radius: 0; border: none;" 
        type="button" 
        onclick="handleExport()">
        <i class="bi bi-upload me-1"></i>
    </button>
</div>

<script>
    function handleExport() {
        const dropdown = document.getElementById("downloadDropdownd");
        const selectedValue = dropdown.value;
        const hasData = dropdown.getAttribute('data-has-data');

        if (hasData === "false") {
            Swal.fire({
                title: 'No records for today.',
                icon: 'info',
                confirmButtonText: 'Okay'
            });
        } else if (selectedValue) {
            if (selectedValue === "print") {
                window.print();
            } else {
                window.location.href = selectedValue;
            }
        } else {
            Swal.fire({
                title: 'Please select an export option.',
                icon: 'warning',
                confirmButtonText: 'Okay'
            });
        }
    }
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