@extends('welcome')
@section('content')

    <div class="container mt-5">
        <a href="{{ route('table') }}" class="btn btn-dark">Back</a>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">{{ $user->first_name }} {{ $user->last_name }} - Schedule</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">

                    <thead class="table-dark">
                        <th>Date</th>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Subject Code</th>
                        <th>Room</th>
                        <th>Action</th>
                    </thead>

                    @if ($schedule)
                        @foreach ($schedule as $schedule)
                            <tbody>
                                <td>{{ $schedule->Date }}</td>
                                <td>{{ $schedule->Day }}</td>
                                <td>{{ $schedule->Time }}</td>
                                <td>{{ $schedule->Subject_Code }}</td>
                                <td>{{ $schedule->Room }}</td>
                                @if ($schedule->Photo)
                                    <td>Already Timed In</td>
                                @elseif ($schedule->Photo == null)
                                    <td><button id="timeIn" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#uploadImage" data-schedule_id={{ $schedule->id }}>Time
                                            in</button></td>
                                @endif
                            </tbody>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="uploadImage" tabindex="-1" role="dialog" aria-hidden="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Webcam Capture</h5>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="uploadPhoto">
                        @csrf

                        <div id="my_camera" style="width: 100%; height: 400px; margin-top: 25px; margin-bottom: 25px;">
                        </div>
                        <input type="button" class="btn btn-success" value="Capture Photo" onclick="capturePhoto()">
                        <input type="button" class="btn btn-primary" value="Reset" onclick="unfreeze()">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <input type="hidden" name="image" class="image-tag">
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        const uploadImage = document.getElementById('uploadImage');
        uploadImage.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;

            Webcam.set({
                width: 466,
                height: 405,
                image_format: 'jpeg',
                jpeg_quality: 90
            });

            Webcam.attach('#my_camera');

            const scheduleId = button.getAttribute('data-schedule_id');
            const instructorId = "{{ $user->id }}"; // Laravel value injected here

            // Construct the route with dynamic scheduleId
            const formAction =
                "{{ route('sched.upload', ['instructorId' => '__instructorId__', 'scheduleId' => '__scheduleId__']) }}";
            const updatedAction = formAction.replace('__instructorId__', instructorId).replace('__scheduleId__',
                scheduleId);

            // Set the form's action dynamically
            document.getElementById('uploadPhoto').action = updatedAction;
        });

        function capturePhoto() {
            Webcam.snap(function(data_uri) {
                $('.image-tag').val(data_uri);
            });
            Webcam.freeze();
        }

        function unfreeze() {
            $('.image-tag').val('');
            Webcam.unfreeze();
        }
    </script>

@endsection
