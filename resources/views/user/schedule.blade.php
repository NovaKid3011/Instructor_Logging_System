@extends('welcome')
@section('content')

    <div class="container-xl m-auto w-100">
        <a href="{{route('table')}}" class="btn btn-primary mt-5">Back</a>
        <div class="sched-con w-100 d-flex-column justify-content-center align-items-center">
            <div class="text-dark">
                <h5 class="mb-0 mt-4 name"></h5>
            </div>
            <div class="card-body mt-4">
                <div class="table-responsive">
                    <table class="table table-bordered mt-3" id="schedule">

                    <thead class="table-primary">
                        <th>Days</th>
                        <th>Room</th>
                        <th>Section</th>
                        <th>Time Started</th>
                        <th>Time Ended</th>
                        <th>Subject Code</th>
                        <th>Subject Description</th>
                        <th>Action</th>
                    </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cameraModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Camera</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="cameraForm" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div id="camera"></div>
                        <input type="hidden" name="image" class="image-tag">
                        <input type="hidden" name="first_name">
                        <input type="hidden" name="last_name">
                        <input type="hidden" name="subject_code">
                        <input type="hidden" name="description">
                        <input type="hidden" name="schedule">
                        <input type="hidden" name="schedule_id">
                        <input type="hidden" name="room">
                        <input type="hidden" name="instructor_id">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" onclick="take_capture()">Capture</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="justificationModal" tabindex="-1" aria-labelledby="justificationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="justificationModalLabel">Justification for Absence</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="justificationForm" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="date">Date for absent</label>
                            <input class="form-control" type="string" id="date" name="date" placeholder="YYYY/MM/DD" required>
                            <label for="justification" class="form-label">Justification</label>
                            <textarea class="form-control" id="justification" name="justification" required></textarea>
                            <input type="hidden" name="schedule_id">
                            <input type="hidden" name="instructor_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit Justification</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        Webcam.set({
            height: 400,
            width: 466,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach('#camera');

        document.getElementById('cameraForm').addEventListener('submit', function(e) {
            const imageValue = document.querySelector('.image-tag').value;

            if (!imageValue) {
                e.preventDefault();
                alert('Please capture an image before submitting.');
            }
        });

        function take_capture(){
            Webcam.snap(function(data_uri){
                $(".image-tag").val(data_uri);
                Webcam.freeze();
                document.getElementById('cameraForm').submit();
            });
        };

        $('#cameraModal').on('hidden.bs.modal', function(){
            $('.image-tag').val('');
            Webcam.unfreeze();
            document.querySelector('btn-success').disabled = true;
        });

        $(document).ready(function() {
            const employeeId = @json($employeeId);
            const attendance = @json($attendance);
            const justification = @json($justification);
            const API_url = 'https://api-portal.mlgcl.edu.ph/api/external/employee-subjects/' + employeeId;
            const API_empUrl = `https://api-portal.mlgcl.edu.ph/api/external/employees?limit=100`;

            $.ajax({
                url: API_empUrl,
                type: 'GET',
                headers: {
                    'x-api-key': "{{env('API_KEY')}}",
                },
                success: function(response) {
                    if (response.data && Array.isArray(response.data)) {
                        const employee = response.data.find(emp => emp.id === parseInt(employeeId));
                        if (employee) {

                            $('input[name="first_name"]').val(employee.first_name);
                            $('input[name="last_name"]').val(employee.last_name);
                            $('.name').append(employee.first_name + ' ' + employee.last_name + ' - Schedule');

                        } else {
                            console.error('Employee not found with id:', employeeId);
                        }
                    } else {
                        console.error('Invalid data format in employee API response.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('API call failed:', xhr.status, error);
                }
            });

            $('#schedule').DataTable({
                ajax: {
                    url: API_url,
                    type: 'GET',
                    headers: {
                        'x-api-key': "{{env('API_KEY')}}",
                    },
                    success: function(response) {
                        if (Array.isArray(response) && response.length > 0) {
                            const tableBody = $('#schedule tbody');
                            tableBody.empty();

                            const currentDay = new Intl.DateTimeFormat('en-US', { weekday: 'short' }).format(new Date()).toUpperCase();

                            const yesterday = new Date();
                            yesterday.setDate(yesterday.getDate() - 1);
                            const yesterdayDay = new Intl.DateTimeFormat('en-US', { weekday: 'short' }).format(yesterday).toUpperCase();

                            const dayMapping = {
                                MTH: ['MON', 'THU'],
                                TF: ['TUE', 'FRI']
                            };

                            const isMatchingDay = (scheduleDays, targetDay) => {
                                return scheduleDays.includes(targetDay) ||
                                    Object.keys(dayMapping).some(key =>
                                        scheduleDays.includes(key) && dayMapping[key].includes(targetDay)
                                    );
                            };

                            const todaysSchedules = response.filter(item => isMatchingDay(item.days, currentDay));
                            const yesterdaysSchedules = response.filter(item => isMatchingDay(item.days, yesterdayDay));

                            if(yesterdaysSchedules.length > 0){
                                const schedulesToDisplay = [...todaysSchedules, ...yesterdaysSchedules];

                                schedulesToDisplay.forEach(item => {
                                    const row = $('<tr>');
                                    row.append(`<td>${item.days}</td>`);
                                    row.append(`<td>${item.room}</td>`);
                                    row.append(`<td>${item.section}</td>`);
                                    row.append(`<td>${item.time_start}</td>`);
                                    row.append(`<td>${item.time_end}</td>`);
                                    row.append(`<td>${item.code}</td>`);
                                    row.append(`<td>${item.description}</td>`);

                                    const currentDate = new Date();
                                    const currentDateString = currentDate.toISOString().split('T')[0];

                                    const yesterday = new Date();
                                    yesterday.setDate(currentDate.getDate() - 1);
                                    const yesterdayDateString = yesterday.toISOString().split('T')[0];

                                    const isTimedIn = attendance && attendance.some(att => att.schedule_id === item.id);
                                    const isTimedInYesterday = attendance && attendance.some(att => att.schedule_id === item.id && att.date === yesterdayDateString);

                                    const isJustification = justification && justification.some(att => att.schedule_id === item.id);

                                    const actionColumn = $('<td>');

                                    const missedDays = [];
                                    for (let i = 1; i <= 7; i++) {
                                        const pastDate = new Date();
                                        pastDate.setDate(pastDate.getDate() - i);

                                        if (pastDate.getDay() === 0) {
                                            continue;
                                        }

                                        const pastDateString = pastDate.toISOString().split('T')[0];

                                        const hasAttendance = attendance.some(att =>
                                            att.schedule_id === item.id && att.date === pastDateString
                                        );

                                        if (!hasAttendance) {
                                            missedDays.push(pastDateString);
                                        }
                                    }

                                    if (isTimedIn) {
                                        const attendanceDate = attendance.some(att => att.date === currentDateString);

                                        if (attendanceDate){
                                            actionColumn.append(`<td><span class="text-success">Already Timed In</span></td>`);
                                        } else {
                                            actionColumn.append(`<td><button type="button" class="btn btn-primary" id="timeIn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#cameraModal"
                                                data-employee-id="${employeeId}"
                                                data-schedule-id="${item.id}"
                                                data-room="${item.room}"
                                                data-days="${item.days}"
                                                data-section="${item.section}"
                                                data-schedule="${item.days}, ${item.time_start} - ${item.time_end}"
                                                data-subject-code="${item.code}"
                                                data-subject-description="${item.description}"
                                            >Time In</button></td>`);
                                        }

                                    } else {
                                        actionColumn.append(`<td><button type="button" class="btn btn-primary" id="timeIn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#cameraModal"
                                            data-employee-id="${employeeId}"
                                            data-schedule-id="${item.id}"
                                            data-room="${item.room}"
                                            data-days="${item.days}"
                                            data-section="${item.section}"
                                            data-schedule="${item.days}, ${item.time_start} - ${item.time_end}"
                                            data-subject-code="${item.code}"
                                            data-subject-description="${item.description}"
                                        >Time In</button></td>`);
                                    }

                                    console.log(missedDays)

                                    if (missedDays.length > 0) {
                                        missedDays.forEach(missedDate => {
                                            const isJustified = justification && justification.some(just =>
                                                just.schedule_id === item.id && just.absent_date === missedDate && just.current_date === currentDateString
                                            );

                                            if (!isJustified) {
                                                actionColumn.append(`
                                                    <button type="button" class="btn btn-warning ms-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#justificationModal"
                                                        data-employee-id="${employeeId}"
                                                        data-schedule-id="${item.id}"
                                                        data-date="${missedDate}">
                                                        Justify Absence for ${missedDate}
                                                    </button>
                                                `);
                                            }
                                        });
                                    }

                                    // if(isJustification){
                                    //     const isSubmitToday = justification.some(att => att.current_date === currentDateString);

                                    //     if(!isSubmitToday){
                                    //         if (!isTimedInYesterday) {
                                    //             actionColumn.append(`<button type="button" class="btn btn-warning ms-2"
                                    //                 data-bs-toggle="modal"
                                    //                 data-bs-target="#justificationModal"
                                    //                 data-employee-id="${employeeId}"
                                    //                 data-schedule-id="${item.id}"
                                    //             >Justification for Absence</button>`);
                                    //         }
                                    //     }
                                    // }else{
                                    //     if (!isTimedInYesterday) {
                                    //             actionColumn.append(`<button type="button" class="btn btn-warning ms-2"
                                    //                 data-bs-toggle="modal"
                                    //                 data-bs-target="#justificationModal"
                                    //                 data-employee-id="${employeeId}"
                                    //                 data-schedule-id="${item.id}"
                                    //             >Justification for Absence</button>`);
                                    //         }
                                    // }


                                    row.append(actionColumn);
                                    tableBody.append(row);
                                });
                            } else {
                                const tableBody = $('#schedule tbody');
                                tableBody.empty();
                                const noDataRow = $('<tr>');
                                noDataRow.append(`<td colspan="8" class="text-center">No schedule available for ${currentDay}.</td>`);
                                tableBody.append(noDataRow);
                            }
                        } else {
                            console.error("No data available or invalid response format.");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("API call failed:", xhr.status, error);
                    },
                },
                searching: false,
                processing: false,
                paging: false,
                language: {
                    processing: "",
                },
            });

            $('#justificationModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var instructorId = button.data('employee-id');
                var scheduleId = button.data('schedule-id');

                $('input[name="instructor_id"]').val(instructorId);
                $('input[name="schedule_id"]').val(scheduleId);

                if (instructorId && scheduleId) {
                    routeUrl = `/user/schedule/${employeeId}/justification/${scheduleId}`;

                    $('#justificationForm').attr('action', routeUrl);
                } else {
                    console.error("Missing employeeId or scheduleId");
                }
            });

            $('#cameraModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var employeeId = button.data('employee-id');
                var scheduleId = button.data('schedule-id');
                var room = button.data('room');
                var days = button.data('days');
                var section = button.data('section');
                var schedule = button.data('schedule');
                var subjectCode = button.data('subject-code');
                var subjectDescription = button.data('subject-description');

                $('input[name="instructor_id"]').val(employeeId);
                $('input[name="schedule_id"]').val(scheduleId);
                $('input[name="room"]').val(room);
                $('input[name="days"]').val(days);
                $('input[name="section"]').val(section);
                $('input[name="schedule"]').val(schedule);
                $('input[name="subject_code"]').val(subjectCode);
                $('input[name="description"]').val(subjectDescription);

                if (employeeId && scheduleId) {
                    routeUrl = `/user/schedule/${employeeId}/upload/${scheduleId}`;

                    $('#cameraForm').attr('action', routeUrl);
                } else {
                    console.error("Missing employeeId or scheduleId");
                }
            });
        });

    </script>

@endsection
