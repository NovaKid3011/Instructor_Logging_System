@extends('layout.partials._head')

@section('content')
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK'
        });
    </script>
    @endif

    @if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}',
            confirmButtonText: 'OK'
        });
    </script>
    @endif



    <div class="container mt-5">
        <!-- Users Table -->
        <div class="">
            {{-- <div class="text-primary">
                <h5 class="mb-0">User Management</h5>
            </div> --}}
            <div class="card-body">
                <button id="createB" class="btn btn-primary m-2" style="background-color: #4E73DF" data-bs-toggle="modal" data-bs-target="#addEmail">
                    Add Email
                </button>
                <table class="table table-striped table-bordered table-responsive{-sm|-md|-lg|-xl} shadow bg-body-tertiary rounded" id="emailTable">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($mails) > 0)

                        @foreach ($mails as $mail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mail->fullname }}</td>
                                <td>{{ $mail->email }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editEmail"
                                        data-id="{{ $mail->id }}" data-fullname="{{ $mail->fullname }}" data-email="{{ $mail->email }}">
                                        Edit
                                    </button>
                                    <button type="button" id="delete" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteEmail" data-emailid="{{ $mail->id }}" data-email="{{$mail->email}}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>


{{-- Add Email --}}
    <div class="modal fade" id="addEmail" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Email</h5>
              <lord-icon class="close" data-bs-dismiss="modal" aria-label="Close"
                    src="https://cdn.lordicon.com/zxvuvcnc.json"
                    trigger="hover"
                    state="hover-cross-3"
                    style="width:30px;height:30px">
                </lord-icon>
            </div>
            <div class="modal-body">
                <form action="{{route("add-email")}}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="text" placeholder="Fullname" id="fullname" class="form-control" name="fname"
                            value="" required autofocus>
                    </div>
                    <div class="form-group mb-3">
                        <input type="email" placeholder="Email" id="email" class="form-control" name="email"
                            required autofocus>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div class="d-grid mx-auto">
                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>




{{-- Edit Email --}}

    <div class="modal fade" id="editEmail" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Email</h5>
                    <lord-icon class="close" data-bs-dismiss="modal" aria-label="Close"
                        src="https://cdn.lordicon.com/zxvuvcnc.json"
                        trigger="hover"
                        state="hover-cross-3"
                        style="width:30px;height:30px">
                    </lord-icon>
                </div>
                <div class="modal-body">
                    <form method="POST" id="editForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editId" name="editId">
                        <div class="form-group mb-3">
                            <input type="text" id="edit_fname" class="form-control" name="edit_fname">
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" id="edit_email" class="form-control" name="edit_email" required>
                        </div>
                        <div class="d-grid mx-auto">
                            <button type="submit" class="btn btn-primary btn-block" id="updateBtn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editEmailModal = document.getElementById('editEmail');
            editEmailModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget; // Button that triggered the modal
                const emailId = button.getAttribute('data-id'); // Extract info from data-* attributes
                const emailFullname = button.getAttribute('data-fullname');
                const emailEmail = button.getAttribute('data-email');

                // Update the modal's content.
                const modalTitle = editEmailModal.querySelector('.modal-title');
                const editForm = editEmailModal.querySelector('#editForm');
                const editIdInput = editEmailModal.querySelector('#editId');
                const editFnameInput = editEmailModal.querySelector('#edit_fname');
                const editEmailInput = editEmailModal.querySelector('#edit_email');

                modalTitle.textContent = `Edit Email - ${emailFullname}`;
                editForm.action = `{{ url('admin/dashboard/manage-email/') }}/${emailId}`;
                editIdInput.value = emailId;
                editFnameInput.value = emailFullname;
                editEmailInput.value = emailEmail;
            });
        });
    </script>



{{-- Delete Modal --}}
    <div class="modal fade" id="deleteEmail" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete the email <strong id="emailId"></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form method="POST" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <div class="d-grid mx-auto">
                            <button type="submit" class="btn btn-primary btn-block" id="deleteBtn">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteEmailModal = document.getElementById('deleteEmail');
            deleteEmailModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget; // Button that triggered the modal
                const emailId = button.getAttribute('data-emailid'); // Extract info from data-* attributes
                const email = button.getAttribute('data-email');

                // Update the modal's content.
                const modalBody = deleteEmailModal.querySelector('.modal-body strong');
                const deleteForm = deleteEmailModal.querySelector('#deleteForm');

                modalBody.textContent = email;
                deleteForm.action = `{{ url('admin/dashboard/delete-email/') }}/${emailId}`;
            });
        });
    </script>

@endsection
