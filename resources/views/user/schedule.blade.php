@extends('welcome')
@section('content')

    <div class="container-xl m-auto w-100">
        <a href="{{route('table')}}" class="btn btn-primary mt-5">Back</a>
        <div class="sched-con w-100 d-flex-column justify-content-center align-items-center">
            <div class="text-dark">
                <h5 class="mb-0 mt-4 name">{{ $employee['first_name'] ?? 'Unknown' }} {{ $employee['last_name'] ?? '' }}</h5>
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
                    <tbody>

                    </tbody>

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
        window.employeeId = @json($employeeId);
        window.schedules = @json($schedules ?? []);
        window.attendance = @json($attendance ?? []);
        window.justification = @json($justification ?? []);
    </script>

    <script src="{{ asset('js/schedule.js') }}"></script>

@endsection
