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
                    <th>Report</th>
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
            $('#instructorTable').DataTable({
                ajax: {
                    url: 'https://api-portal.mlgcl.edu.ph/api/external/employees?limit=100',
                    type: 'GET',
                    headers: {
                        'x-api-key': '{{env("API_KEY")}}'
                    },
                    beforeSend: function(jqXHR, settings) {
                        settings.url = settings.url.replace(/([?&])_=\d+/, '');  // Remove timestamp manually
                    },
                    error: function(xhr, error, thrown) {
                        console.log('Error:', xhr.responseText);

                        alert('Failed to load data. Check console for details.');
                    },
                    dataSrc: function(json) {
                        console.log('Data received:', json);
                        // Flatten the structure to get employees as separate rows
                        let employees = [];
                        json.data.forEach(item => {
                            employees.push({
                                id: item.id,
                                first_name: item.first_name,
                                middle_name: item.middle_name,
                                last_name: item.last_name,
                                image: item.image
                            });
                        });
                        return employees;
                    }
                },
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
                            return `<button class="btn btn-sm btn-primary view-btn" data-id="${row.id}">View</button>`;
                        }
                    }
                ]
            });
        });
    </script>



@endsection
