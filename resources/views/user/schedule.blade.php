@extends('welcome')
@section('content')

    <div class="container mt-5">
        <a href="{{route('table')}}" class="btn btn-dark">Back</a>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"> - Schedule</h5>
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
                <div class="modal-body">
                    <form action="">
                        @csrf
                        <video id="camera" height="400" width="400" autoplay></video>
                        <input type="hidden" name="image" class="image-tag">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Capture</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#schedule').DataTable({
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
                                    description: subject.description,
                                    action: 'Time In'
                                });
                            });
                        });
                        return subjects;
                    }
                },
                columns: [
                    { data: 'days' },
                    { data: 'room' },
                    { data: 'section' },
                    { data: 'time_start' },
                    { data: 'time_end' },
                    { data: 'code' },
                    { data: 'description' },
                    { data: 'action',
                        render: function(data, type, row){
                            return `<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cameraModal">${data}</button>`
                        }
                    }
                ]
            });
        });

        if(window.isSecureContext){
            console.log('check');
        }else{
            console.log('unchecked');
        }

        const videoElement = document.getElementById('camera');

        async function startWebcam() {
            try {
                getUserMedia({
                    video: true,
                    height: 400,
                    width: 460
                });
                const stream = await navigator.mediaDevices.getUserMedia({ video: true });
                videoElement.srcObject = stream;
            } catch (err) {
                console.error("Error accessing webcam:", err);
            }
        }

        window.onload = startWebcam;
    </script>

@endsection
