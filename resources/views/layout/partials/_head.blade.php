<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset("images/New MLG logo.png")}}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <title>MLGCL Logging System</title>

    @vite('resources/css/styles.css')
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}



</head>
<body>
    @if(session('success'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                toast: true,
                title: 'Success!',
                showConfirmButton: false,
                timer: 2000,
                customClass: {
                    popup: 'custom-toast'
                }
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                text: '{{ session('error') }}',
                toast: true,
                showConfirmButton: false,
                timer: 2000,
                customClass: {
                    popup: 'custom-toast'
                }
            });
        </script>
    @endif

    <div class="con">
        <!-- Sidebar -->
        @include('layout.partials._sidebar')
        <!-- Main Content -->
        <div class="con2">
            <div>
                @include('layout.partials._navbar')
                @yield('content')
            </div>

            @include('auth.logout-modal')
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>
    <script>
        $(document).ready( function () {
            $('#emailTable').DataTable();
        } );
    </script>
    <script>
        $(document).ready( function () {
            $('#instructorTable').DataTable();
        } );
    </script>
    <script>
        $(document).ready( function () {
            if ($('#monthlyTable').length && !$.fn.DataTable.isDataTable('#monthlyTable')) {
                $('#monthlyTable').DataTable({
                    searching: false // Disable the search functionality
                });
            }
        } );
    </script>



</body>
</html>
