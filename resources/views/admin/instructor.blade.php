@extends('layout.partials._head')

@section('content')


<div class="container mt-5">
    <!-- Users Table -->
    <div class="">
        <table id="instructorTable">
            <thead class="text-white " style="background-color: #4468cc;">
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody class="text-dark">
                <!-- Rows will be populated here -->
            </tbody>
        </table>
    </div>
</div>



{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const api_key = '{{env("API_KEY")}}';

        fetch(`https://api-portal.mlgcl.edu.ph/api/external/employee-subjects`, {
            headers: {
                'x-api-key': api_key
            }
        }).then(res => {
            console.log('Response status:', res.status);
            if (!res.ok) {
                throw new Error(`HTTP error! Status: ${res.status}`);
            }
            return res.json();
        })
        .then(response => {
            console.log('Data received:', response);

            const data = response.data;

            if (!Array.isArray(response.data)) {
                console.error('Expected an array but got:', data);
                return;
            }
            populateTable(data);
        })
        .catch(error => {
            console.error('Fetch error:', error);
        });

        function populateTable(data) {
            const tbody = document.querySelector('#instructorTable tbody');
            console.log('Populating table with data:', data);

            data.forEach(item => {
                const row = document.createElement('tr');

                const idCell = document.createElement('td');
                idCell.textContent = item.id;
                row.appendChild(idCell);

                const fCell = document.createElement('td');
                fCell.textContent = item.employee.first_name; // Assuming the API returns a 'name' field
                row.appendChild(fCell);

                const mCell = document.createElement('td');
                mCell.textContent = item.employee.middle_name; // Assuming the API returns a 'name' field
                row.appendChild(mCell);

                const lCell = document.createElement('td');
                lCell.textContent = item.employee.last_name; // Assuming the API returns a 'name' field
                row.appendChild(lCell);

                const profileCell = document.createElement('td');
                const profileImage = item.employee.image ? `<img src="${item.employee.image}" alt="Profile Image" width="50">` : 'No image';
                profileCell.innerHTML = profileImage;
                row.appendChild(profileCell);

                tbody.appendChild(row);
            });
        }
    });
</script> --}}


    <script>
        $(document).ready(function() {
            $('#instructorTable').DataTable({
                ajax: {
                    url: 'https://api-portal.mlgcl.edu.ph/api/external/employee-subjects',
                    type: 'GET',
                    headers: {
                        'x-api-key': '{{env("API_KEY")}}'
                    },
                    dataSrc: function(json) {
                        console.log('Data received:', json);
                        let employees = [];
                        let ids = new Set();
                        json.data.forEach(item => {
                            if (!ids.has(item.employee.id)) {
                                ids.add(item.employee.id);
                                employees.push({
                                    id: item.employee.id,
                                    first_name: item.employee.first_name,
                                    middle_name: item.employee.middle_name,
                                    last_name: item.employee.last_name,
                                    image: item.employee.image
                                });
                            }
                        });
                        return employees;
                    }
                },
                columns: [
                    { data: 'id' },
                    { data: 'first_name' },
                    { data: 'middle_name' },
                    { data: 'last_name' },
                    {
                        data: 'image',
                        render: function(data, type, row) {
                            return data 
                                        ? `<img src="${data}" alt="Profile Image" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">` 
                                        : 'No image';

                        }
                    }
                ]
            });
        });
    </script>



@endsection
