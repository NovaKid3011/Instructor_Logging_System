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
                <table class="table table-striped table-bordered table-responsive{-sm|-md|-lg|-xl}" id="myTable">
                    <thead class="table-primary">
                        <tr>

                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addEmail" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
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
                <form action="" method="POST">
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



@endsection
