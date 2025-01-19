@extends('layout.partials._head')

@section('content')


<div class="container mt-5">
    <!-- Users Table -->
    <div class="">
        <table id="instructorTable" class=" shadow bg-body-tertiary rounded">
            <thead class="text-white " style="background-color: #4468cc;">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Monthly Report</th>
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
        let filteredData = @json($data).filter(item => item.selected);
        console.log(selectedIds);
        var table = $('#instructorTable').DataTable({
            data: filteredData,
            columns: [
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
                    {
                        data: null,
                        render: function(data, type, row) {
                            // Construct the URL with additional data as query parameters
                            const url = `{{ route('instructor.monthly', '') }}/${row.id}?id=${encodeURIComponent(row.id)}`;
                            return `<a href="${url}" class="btn btn-sm btn-primary view-btn" data-id="${row.id}">View</a>`;
                        }
                    }
            ],
        });
    });
</script>





@endsection
