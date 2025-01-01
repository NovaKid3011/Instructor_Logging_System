@extends('welcome')
@section('content')

    <div class="container-xl m-auto w-100">
        <a href="{{route('table')}}" class="btn btn-primary mt-5">Back</a>
        <div class="sched-con w-100 d-flex-column justify-content-center align-items-center">
            <div class="text-dark">
                <h5 class="mb-0 mt-4"></h5>
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
        <div class="modal-dialog modal-dialog-centered modal-lg">
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
                        <input type="hidden" name="room">
                        <input type="hidden" name="instructor_id">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" onclick="take_capture()">Capture</button>
                      <button type="submit" class="btn btn-success">Submit</button>
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
                document.querySelector('.btn-success').disabled = false;
            });
        };

        document.querySelector('.btn-success').disabled = true;

        $('#cameraModal').on('hidden.bs.modal', function(){
            $('.image-tag').val('');
            Webcam.unfreeze();
            document.querySelector('btn-success').disabled = true;
        });

        var API_key = document.querySelector('meta[name="api-key"]').content

        $(document).ready(function() {
            const employeeId = @json($employeeId);
            const API_url = 'https://api-portal.mlgcl.edu.ph/api/external/employee-subjects/' + employeeId;
            const API_empUrl = `https://api-portal.mlgcl.edu.ph/api/external/employees?limit=100`;

            $.ajax({
                url: API_empUrl,
                type: 'GET',
                headers: {
                    'x-api-key': API_key,
                },
                success: function(response) {
                    if (response.data && Array.isArray(response.data)) {
                        const employee = response.data.find(emp => emp.id === parseInt(employeeId));
                        if (employee) {

                            $('input[name="first_name"]').val(employee.first_name);
                            $('input[name="last_name"]').val(employee.last_name);
                            $('h5').append(employee.first_name + ' ' + employee.last_name + ' - Schedule');

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
                        'x-api-key': API_key
                    },
                    success: function(response) {
                        if (Array.isArray(response) && response.length > 0) {
                            const tableBody = $('#schedule tbody');
                            response.forEach(item => {
                                const row = $('<tr>');
                                row.append(`<td>${item.days}</td>`);
                                row.append(`<td>${item.room}</td>`);
                                row.append(`<td>${item.section}</td>`);
                                row.append(`<td>${item.time_start}</td>`);
                                row.append(`<td>${item.time_end}</td>`);
                                row.append(`<td>${item.code}</td>`);
                                row.append(`<td>${item.description}</td>`);
                                row.append(`<td><button type="button" class="btn btn-primary" id="timeIn"
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
                                tableBody.append(row);
                            });
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
                $('input[name="schedule"]').val(scheduleId);
                $('input[name="room"]').val(room);
                $('input[name="days"]').val(days);
                $('input[name="section"]').val(section);
                $('input[name="schedule"]').val(schedule);
                $('input[name="subject_code"]').val(subjectCode);
                $('input[name="description"]').val(subjectDescription);

                if (employeeId && scheduleId) {
                    routeUrl = `/user/table/schedule/${employeeId}/upload/${scheduleId}`;

                    $('#cameraForm').attr('action', routeUrl);
                } else {
                    console.error("Missing employeeId or scheduleId");
                }
            });
        });

    </script>

@endsection
