@extends('layout.partials._head')

@section('content')


<div class="container mt-5">
    <!-- Users Table -->
    <div class="">
        <table id="schedulesTable"  class=" shadow bg-body-tertiary rounded">
            <thead class="text-white" style="background-color: #4468cc;">
                <tr>
                    <th>ID</th>
                    <th>Days</th>
                    <th>Room</th>
                    <th>Section</th>
                    <th>Instructor</th>
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
    $(document).ready(async function () {
        async function fetchSchedules() {
            const schedules = [];
            try{
                const employeeResponse = await $.ajax({
                    url: 'https://api-portal.mlgcl.edu.ph/api/external/employees?limit=100',
                    type: 'GET',
                    headers: {
                        'x-api-key' : '{{env("API_KEY")}}'
                    }
                });

                const promise = employeeResponse.data.map(async(employee) => {
                    try {
                        const scheduleResponse = await $.ajax({
                            url : `https://api-portal.mlgcl.edu.ph/api/external/employee-subjects/${employee.id}`,
                            type: 'GET',
                            headers: {
                                'x-api-key' : '{{env("API_KEY")}}'
                            }
                        });

                        if (Array.isArray(scheduleResponse)) {
                            scheduleResponse.forEach(schedule => {
                                schedules.push({
                                    id: schedule.id,
                                    days: schedule.days,
                                    room: schedule.room,
                                    section: schedule.section,
                                    instructor: `${employee.first_name} ${employee.last_name}`,
                                    time_start: schedule.time_start,
                                    time_end: schedule.time_end,
                                    code: schedule.code,
                                    description: schedule.description
                                });
                            });
                        }
                    }catch (error) {
                        console.error(`Error fetching schedule for employee ID ${employee.id}:`, error);
                    }
                });
                await Promise.all(promise);

            }catch (error) {
                console.error('Error fetching schedules:', error);
            }
            return schedules;
        }
        const schedules = await fetchSchedules();

        $('#schedulesTable').DataTable({
            data: schedules,
            columns: [
                { data: 'id' },
                { data: 'days' },
                { data: 'room' },
                { data: 'section' },
                { data: 'instructor' },
                { data: 'time_start' },
                { data: 'time_end' },
                { data: 'code' },
                { data: 'description' }
            ]
        });
    });
</script>


@endsection
