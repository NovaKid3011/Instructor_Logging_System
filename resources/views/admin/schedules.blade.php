@extends('layout.partials._head')

@section('content')


<div class="container mt-5">
    <!-- Users Table -->
    <div class="">
        <table id="schedulesTable">
            <thead class="text-white" style="background-color: #4468cc;">
                <tr>
                    <th>ID</th>
                    <th>Days</th>
                    <th>Room</th>
                    <th>Section</th>
                    <th>Time Started</th>
                    <th>Time Ended</th>
                    <th>Subject Code</th>
                    <th>Subject Description</th>
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
        $('#schedulesTable').DataTable({
            ajax: {
                url: 'https://api-portal.mlgcl.edu.ph/api/external/employee-subjects',
                type: 'GET',
                headers: {
                    'x-api-key': '{{env("API_KEY")}}'
                },
                dataSrc: function(json) {
                    console.log('Data received:', json);
                    // Flatten the structure to get subjects as separate rows
                    let subjects = [];
                    json.data.forEach(item => {
                        item.subjects.forEach(subject => {
                            subjects.push({
                                id: subject.id,
                                days: subject.days,
                                room: subject.room,
                                section: subject.section,
                                time_start: subject.time_start,
                                time_end: subject.time_end,
                                code: subject.code,
                                description: subject.description
                            });
                        });
                    });
                    return subjects;
                }
            },
            columns: [
                { data: 'id' },
                { data: 'days' },
                { data: 'room' },
                { data: 'section' },
                { data: 'time_start' },
                { data: 'time_end' },
                { data: 'code' },
                { data: 'description' }
            ]
        });
    });
</script>



@endsection
