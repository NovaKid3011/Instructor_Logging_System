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
                            <td><button class="btn btn-sm btn-primary" onclick="openCamera()">Time in</button></td>
                        </tbody>
                    @endforeach
                @endif
            </table>
        </div>
    </div>
</div>

<style>
    /* Overlay container (hidden by default) */
    .overlay {
        display: none;  /* Initially hidden */
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);  /* Dim background */
        backdrop-filter: blur(8px);  /* Background blur */
        z-index: 1050;
        justify-content: center;
        align-items: center;
    }

    /* Webcam container */
    .webcam-container {
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        width: 50%;
        max-width: 600px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        text-align: center;
    }

    /* Fade-in effect */
    .fade-in {
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="overlay" id="webcamOverlay">
    <div class="webcam-container fade-in text-center">
        <h3>Webcam Capture</h3>
        <form action="">
            @csrf
            <div id="my_camera" style="width: 100%; height: 400px; margin-top: 25px; margin-bottom: 25px;"></div>
            <input type="button" class="btn btn-danger" value="Close" onclick="hideWebcam()">
            <input type="button" class="btn btn-success" value="Capture Photo" onclick="capturePhoto()">
            <input type="button" class="btn btn-primary" value="Reset" onclick="unfreeze()">
            <input type="hidden" name="image" class="image-tag">
        </form>
        <div class="mt-4">
            <div id="results"></div>
        </div>
    </div>
</div>

<script>

        function openCamera() {
            const overlay = document.getElementById('webcamOverlay');
            overlay.style.display = 'flex';

            // Initialize Webcam
            Webcam.set({
                width: 540,
                height: 405,
                image_format: 'jpeg',
                jpeg_quality: 90
            });

            Webcam.attach('#my_camera');
        }

        function hideWebcam() {
            const overlay = document.getElementById('webcamOverlay');
            overlay.style.display = 'none';

            $('.image-tag').val('');
            Webcam.reset();
        }

        function capturePhoto() {
            Webcam.snap( function(data_uri){
                $('.image-tag').val(data_uri);
            } );
            Webcam.freeze();
        }

        function unfreeze() {
            $('.image-tag').val('');
            Webcam.unfreeze();
        }

</script>

@endsection
