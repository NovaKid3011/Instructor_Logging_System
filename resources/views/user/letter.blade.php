@extends('welcome')

@section('content')

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h5 id="search-letter" data-letter="{{ strtoupper($alpha) }}">
            Instructor Last Names Starting with "{{ strtoupper($alpha) }}"
        </h5>
        <a href="/user/table" class="btn btn-primary">Return</a>
    </div>

    <!-- Instructors Cards -->
    <div id="instructors-container" class="mt-4">
        <div id="instructorCards" class="row">
            <div class="col-12 text-center">Loading...</div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const data = @json($data);

        function populateTable(data) {
            const container = document.querySelector('#instructorCards');
            container.innerHTML = ''; // Clear loading message

            const letter = document.querySelector('#search-letter').getAttribute('data-letter').toUpperCase();
            const filteredData = data.filter(item => {
                if (!item.last_name) return false;

                const sanitizedLastName = item.last_name
                    .normalize("NFD")
                    .replace(/[\u0300-\u036f]/g, "")
                    .toUpperCase();
                return sanitizedLastName.startsWith(letter) && item.is_part_time;
            });

            if (filteredData.length === 0) {
                container.innerHTML = `<div class="col-12 text-center">No part-time instructors found for this letter.</div>`;
                return;
            }

            filteredData.forEach(item => {
                const col = document.createElement('div');
                col.className = 'col-12 col-md-4 col-lg-3 mb-4 d-flex justify-content-center';

                const card = document.createElement('div');
                card.className = 'card text-center p-3 shadow';
                card.style.maxWidth = '250px';
                card.style.border = '1px solid #ddd';
                card.style.borderRadius = '8px';

                // Add click event listener for redirection
                card.addEventListener('click', () => {
                    const instructorId = item.id; // Assuming `id` exists in the data
                    window.location.href = `/user/schedule/${instructorId}`;
                });

                // Profile Image
                const profileImage = document.createElement('img');
                profileImage.src = item.image || 'https://via.placeholder.com/150';
                profileImage.alt = 'Profile Image';
                profileImage.className = 'rounded';
                profileImage.style.width = '100%';
                profileImage.style.height = '200px';
                profileImage.style.objectFit = 'cover';
                profileImage.style.borderTopLeftRadius = '8px';
                profileImage.style.borderTopRightRadius = '8px';

                // Name and middle name js to make 1 letter nalang
                const name = document.createElement('h5');
                name.className = 'mt-3 text-uppercase fw-bold';
                name.textContent = `${item.first_name || ''} ${item.middle_name ? item.middle_name.charAt(0) + '.' : ''} ${item.last_name || ''}`;

                // Append elements
                card.appendChild(profileImage);
                card.appendChild(name);
                col.appendChild(card);
                container.appendChild(col);
            });
        }

        populateTable(data);
    });
</script>

@endsection
