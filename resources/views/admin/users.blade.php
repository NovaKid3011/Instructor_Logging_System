@extends('layout.dashboard')
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
        <h1 class="mb-4">Users</h1>

        <!-- Users Table -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">User Management</h5>
            </div>
            <div class="card-body">
                <button id="createB" class="btn btn-success m-2">
                    Create new user
                </button>
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created_at</th>
                            <th>Updated_at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->role == 0)
                                        User
                                    @else
                                        Admin
                                    @endif
                                </td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td>
                                    <button id="edit" class="btn btn-sm btn-warning edit"
                                        data-editid="{{ $user->id }}" data-editfname="{{ $user->first_name }}"
                                        data-editlname="{{ $user->last_name }}" data-editemail="{{ $user->email }}"
                                        data-editpassword="{{ $user->password }}">Edit</button>
                                    <button id="delete" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal" data-userid="{{ $user->id }}"
                                        data-username="{{ $user->first_name }} {{ $user->last_name }}">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        .modal {
            backdrop-filter: blur(8px);
        }
    </style>

    <div id="userModal" class="modal justify-content-center align-items-center">
        <div class="card w-25">
            <div class="card-header bg-primary text-white">
                Create User Form
                <button id="closeCreate" class="btn btn-dark text-white">Close</button>
            </div>
            <div class="card-body">
                <form action="{{ route('user.create') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="text" placeholder="First Name" id="fname" class="form-control" name="fname"
                            value="" required autofocus>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" placeholder="Last Name" id="lname" class="form-control" name="lname"
                            required autofocus>
                    </div>
                    <div class="form-group mb-3">
                        <input type="email" placeholder="Email" id="email" class="form-control" name="email"
                            required autofocus>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" placeholder="Password" id="password" class="form-control" name="password"
                            required autofocus>
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="d-grid mx-auto">
                        <button type="submit" class="btn btn-success btn-block">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let createModal = document.getElementById('userModal');
        let createbtn = document.getElementById('createB');
        let createclose = document.getElementById('closeCreate');

        createbtn.onclick = function() {
            createModal.style.display = 'flex';
        }

        createclose.onclick = function() {
            createModal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == createModal) {
                createModal.style.display = "none";
            }
            if (event.target == editModal) {
                editModal.style.display = "none";
            }
        }
    </script>

    <div id="editModal" class="modal justify-content-center align-items-center" tabindex="-1">
        <div class="card w-25">
            <div class="card-header bg-primary text-white">
                Edit User Form
                <button id="closeEdit" class="btn btn-dark text-white">Close</button>
            </div>
            <div class="card-body">
                <form action="{{ route('user.update', $user->id) }}" method="POST" id="editForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editId" name="editId">
                    <div class="form-group mb-3">
                        <input type="text" placeholder="First Name" id="edit_fname" class="form-control"
                            name="edit_fname" required autofocus>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" placeholder="Last Name" id="edit_lname" class="form-control" name="edit_lname"
                            required autofocus>
                    </div>
                    <div class="form-group mb-3">
                        <input type="email" placeholder="Email" id="edit_email" class="form-control" name="edit_email"
                            required autofocus>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" placeholder="Current Password" id="current_password" class="form-control"
                            name="current_password" required autofocus>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" placeholder="New Password" id="edit_password" class="form-control"
                            name="edit_password" required autofocus>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" placeholder="Confirm New Password" id="confirm_password"
                            class="form-control" name="confirm_password" required autofocus>
                    </div>
                    <div class="d-grid mx-auto">
                        <button type="submit" class="btn btn-success btn-block" id="updateBtn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const editButtons = document.querySelectorAll(".edit");

            editButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const editId = this.getAttribute("data-editId");
                    const editFname = this.getAttribute("data-editfname");
                    const editLname = this.getAttribute("data-editlname");
                    const editEmail = this.getAttribute("data-editemail");
                    const editPass = this.getAttribute("data-editpassword");

                    document.getElementById("editId").value = editId;
                    document.getElementById("edit_fname").value = editFname;
                    document.getElementById("edit_lname").value = editLname;
                    document.getElementById("edit_email").value = editEmail;

                    const editModal = document.getElementById("editModal");
                    editModal.style.display = "flex";

                    let closebtn = document.getElementById("closeEdit");
                    closebtn.onclick = function() {
                        editModal.style.display = "none";
                    }

                    let form = document.getElementById("editForm");
                    form.setAttribute("data-modified", "false");
                    document.getElementById("updateBtn").disabled = true;

                    form.addEventListener("input", function() {
                        const originalData = {
                            fname: editFname,
                            lname: editLname,
                            email: editEmail,
                            pass: editPass
                        };

                        let modified = false;
                        if (document.getElementById("edit_fname").value !== originalData
                            .fname ||
                            document.getElementById("edit_lname").value !== originalData
                            .lname ||
                            document.getElementById("edit_email").value !== originalData
                            .email ||
                            document.getElementById("edit_password").value !== originalData
                            .pass ||
                            document.getElementById("edit_password").value !== "" ||
                            document.getElementById("confirm_password").value !== ""
                        ) {
                            modified = true;
                        }

                        form.setAttribute("data-modified", modified ? "true" : "false");
                        document.getElementById("updateBtn").disabled = !modified;
                    });
                });
            });
        });
    </script>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete the user <strong id="userName"></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteUserForm" method="POST" action="{{ route('user.delete', $user->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const userId = button.getAttribute('data-userid');
            const userName = button.getAttribute('data-username');

            const userNameElement = document.getElementById('userName');
            userNameElement.textContent = userName;
        });
    </script>
@endsection
