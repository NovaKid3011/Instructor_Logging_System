@extends('welcome')
@section('content')

    <div class="container-xl m-auto w-100">
        <a href="{{route('table')}}" class="btn btn-dark">Back</a>
        <div class="card h-100 w-100">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Schedule</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" id="schedule">

                    <thead class="table-dark">
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
                document.querySelector('.btn-success').disabled = true;
            });
        };

        $('#cameraModal').on('hidden.bs.modal', function(){
            $('.image-tag').val('');
            Webcam.unfreeze();
            document.querySelector('btn-success').disabled = true;
        });

        var API_key = document.querySelector('meta[name="api-key"]').content

        var photos = @json($photos);
        var timedInSchedules = @json($timedInSchedules);

        $(document).ready(function() {
            const employeeId = @json($employeeId);
            const API_url = 'https://api-portal.mlgcl.edu.ph/api/external/employee-subjects/' + employeeId;
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
            });

            $('#cameraModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var employeeId = button.data('employee-id');
                var scheduleId = button.data('schedule-id');

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
