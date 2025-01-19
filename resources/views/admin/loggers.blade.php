@extends('layout.partials._head')

@section('content')


<div class="container mt-5">
    <div class="btn_container d-grid d-md-flex justify-content-between align-items-center">
        <p>Please select the part-time instructors.</p>
        <button type="button" id="submitId" class="btn btn-primary">Save</button>
    </div>
    <div class="pt-3">
        <table id="loggersTable" class=" shadow bg-body-tertiary rounded">
            <thead class="text-white " style="background-color: #4468cc;">
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                </tr>
            </thead>
            <tbody class="text-dark">
                <!-- Rows will be populated here -->
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
    let selectedIds = @json(collect($data)->filter(fn($item) => $item['selected'])->pluck('id'));
    console.log(selectedIds);
    var table = $('#loggersTable').DataTable({
        data: @json($data),  // Pass the data from the controller to the DataTable
        columns: [
            {
                data: null,
                render: function(data) {
                    return `<input type="checkbox" class="selectRow" data-id="${data.id}" ${selectedIds.includes(data.id) ? 'checked' : ''} />`;
                },
                orderable: false
            },
            { data: 'id' },
            {
                data: 'image',
                render: function(data, type, row) {
                    return data
                        ? `<img src="${data}" alt="Profile Image" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">`
                        : 'No image';
                }
            },
            { data: 'last_name' },
            { data: 'first_name' },
            { data: 'middle_name' },
        ],
        columnDefs: [
            { targets: 0, width: '30px' },
            { targets: 1, width: '50px' }
        ],
        paging: true
    });

        // Handle individual row selection (optional)
        $('#loggersTable tbody').on('change', '.selectRow', function() {
            const id = $(this).data('id');
            if($(this).is(':checked')) {
                if(!selectedIds.includes(id)) {
                    selectedIds.push(id);
                }
            }else{
                selectedIds = selectedIds.filter(selectedId => selectedId !== id);
            }
        });

        //save data
        $('#submitId').on('click', function() {
            $.ajax({
                url: '{{route("selectedIds")}}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    selected_ids: selectedIds,
                },
                success: function(response) {
                    alert(response.message);
                    table.ajax.reload();
                },
            });

        });

    });

</script>

@endsection
