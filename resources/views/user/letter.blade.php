@extends('welcome')
@section('user')

<div class="container pt-5">
    <small class="text-body-secondary" id="search-letter" data-letter="{{ strtoupper($alpha) }}">Instructors with lastname starting with "{{ strtoupper($alpha) }}"</small>

    <!-- Instructors Table -->
    <div id="instructors-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Profile</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                </tr>
            </thead>
            <tbody id="instructorTable">
                <tr>
                    <td colspan="4">Loading...</td>
                </tr>
            </tbody>
        </table>
        <a class="text-decoration-none text-secondary d-flex justify align-items-center" href="{{route('table')}}">
            <svg  xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-back-up"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 14l-4 -4l4 -4" /><path d="M5 10h11a4 4 0 1 1 0 8h-1" /></svg>
            Back
        </a>
    </div>
</div>

<script>
    const api_key = '{{ env("API_KEY") }}'; // Ensure the API key is correctly retrieved

    fetch('https://api-portal.mlgcl.edu.ph/api/external/employee-subjects', {
        headers: {
            'x-api-key': api_key // Ensure the header is correct
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

        // Access the 'data' array from the response object
        const data = response.data;

        if (!Array.isArray(data)) {
            console.error('Expected an array but got:', data);
            return;
        }

        populateTable(data);
    })
    .catch(error => {
        console.error('Fetch error:', error);
    });

    function populateTable(data)
    {
        const tbody = document.querySelector('#instructorTable');
        console.log('Populating table with data:', data);

        // Clear loading message
        tbody.innerHTML = '';

        // Filter instructors based on the letter of their last name
        const letter = document.querySelector('#search-letter').getAttribute('data-letter').toUpperCase();
        const filteredData = data.filter(item => item.employee.last_name && item.employee.last_name.toUpperCase().startsWith(letter));

        if (filteredData.length === 0) {
            tbody.innerHTML = `<tr><td colspan="4">No instructors found for this letter.</td></tr>`;
            return;
        }

        filteredData.forEach(item => {
            const row = document.createElement('tr');

            // Profile column
            const profileCell = document.createElement('td');
            const profileImage = item.employee.image ? `<img src="${item.employee.image}" alt="Profile Image" width="50">` : 'No image';
            profileCell.innerHTML = profileImage;
            row.appendChild(profileCell);

            // First Name column
            const firstNameCell = document.createElement('td');
            firstNameCell.textContent = item.employee.first_name || 'N/A';
            row.appendChild(firstNameCell);

            // Middle Name column
            const middleNameCell = document.createElement('td');
            middleNameCell.textContent = item.employee.middle_name || 'N/A';
            row.appendChild(middleNameCell);

            // Last Name column
            const lastNameCell = document.createElement('td');
            lastNameCell.textContent = item.employee.last_name || 'N/A';
            row.appendChild(lastNameCell);

            // Append the row to the table body
            tbody.appendChild(row);
        });
    }
</script>

@endsection
