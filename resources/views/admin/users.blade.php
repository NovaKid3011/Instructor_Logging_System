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
        <!-- Users Table -->
        <div class="">
            {{-- <div class="text-primary">
                <h5 class="mb-0">User Management</h5>
            </div> --}}
            <div class="card-body">
                <button id="createB" class="btn btn-primary m-2" style="background-color: #4E73DF" data-bs-toggle="modal" data-bs-target="#addUser">
                    Add user
                </button>
                <table class="table table-striped table-bordered table-responsive{-sm|-md|-lg|-xl}" id="myTable">
                    <thead class="table-primary">
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
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->role == 0)
                                        Regular User
                                    @else
                                        Admin
                                    @endif
                                </td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td>
                                    <button id="edit" class="btn btn-sm btn-primary edit" data-bs-toggle="modal" data-bs-target="#editModal" data-editid="{{ $user->id }}" data-editfname="{{ $user->first_name }}"
                                        data-editlname="{{ $user->last_name }}" data-role="{{ $user->role }}">
                                        Edit</button>
                                    <button id="delete" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-userid="{{ $user->id }}"
                                        data-username="{{ $user->first_name }} {{ $user->last_name }}" data-role="{{ $user->role }}" >Delete</button>
                                </td>
                            </tr>
                        {{-- @empty
                            <tr>
                                <td colspan="4" class="text-center">No users found.</td>
                            </tr> --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

{{-- Add User --}}

    <div class="modal fade" id="addUser" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add User</h5>
              <lord-icon class="close" data-bs-dismiss="modal" aria-label="Close"
                    src="https://cdn.lordicon.com/zxvuvcnc.json"
                    trigger="hover"
                    state="hover-cross-3"
                    style="width:30px;height:30px">
                </lord-icon>
            </div>
            <div class="modal-body">
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

                    <div class="btn-group-toggle my-3" data-toggle="buttons">
                        <label class="btn btn-success active">
                          <input type="radio" name="role" id="option1" autocomplete="off" checked value="0" required>Regular User
                        </label>
                        <label class="btn btn-primary mx-3">
                          <input type="radio" name="role" id="option2" autocomplete="off" value="1" required>Admin
                        </label>
                    </div>

                    <div class="d-grid mx-auto">
                        <button type="submit" class="btn btn-primary btn-block">Create</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>



{{-- Edit Modal --}}

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit User</h5>
              <lord-icon class="close" data-bs-dismiss="modal" aria-label="Close"
                src="https://cdn.lordicon.com/zxvuvcnc.json"
                trigger="hover"
                state="hover-cross-3"
                style="width:30px;height:30px">
            </lord-icon>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.update', ['id' => '::id']) }}" method="POST" id="editForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editId" name="editId">
                    <div class="form-group mb-3">
                        <input type="text" placeholder="{{$user->first_name}}" id="edit_fname" class="form-control"
                            name="edit_fname" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" placeholder="{{$user->last_name}}" id="edit_lname" class="form-control" name="edit_lname"
                            required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text bg-secondary text-light" for="inputGroupSelect01">Options</label>
                        </div>
                        <select class="custom-select col-4" name="role" id="inputGroupSelect01">
                          <option value="1">Admin</option>
                          <option value="0">Regular user</option>
                        </select>
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
        const editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Button that triggered the modal

            // Extract data from data-* attributes
            const userId = button.getAttribute('data-editid');
            const firstName = button.getAttribute('data-editfname');
            const lastName = button.getAttribute('data-editlname');
            const role = button.getAttribute('data-role');

            console.log(role);

            // Update the modal's content
            document.getElementById('editId').value = userId;
            document.getElementById('edit_fname').value = firstName;
            document.getElementById('edit_lname').value = lastName;
            const roles = document.getElementById('inputGroupSelect01').value = role;

            console.log(roles);

            // Dynamically update form action
            const formAction = "{{ route('user.update', ':id') }}".replace(':id', userId);
            document.getElementById('editForm').action = formAction;
        });
    </script>


{{-- Delete Modal --}}

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
                        @php
                            var_dump($user->id);
                        @endphp
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
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




