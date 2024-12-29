<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

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
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    {{-- <style>
        #sidebar {
            position: sticky;
            top: 0;
            min-height: 100vh;
            width: 240px;
        }

        .content {
            padding: 20px;
        }
        @media (max-width: 786px) {
            .hamburger{
                display: flex;
            }
            .sidebar {
                width: 180px;
                left: -250px;
            }
            .sidebar .show{
                left: 0;
            }
        }
    </style> --}}
    {{-- <div class="hamburger">
        <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-menu-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 6l16 0" /><path d="M4 12l16 0" /><path d="M4 18l16 0" /></svg>
    </div> --}}

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
            // const id = $($this).data('id');
            // console.log(id);
            // window.location.href = `/admin/dashboard/view/${id}`;
        } );
    </script>

{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const hamburger = document.getElementById('hamburger');
        const sidebar = document.getElementById('sidebar');

        hamburger.addEventListener('click', function() {
            sidebar.classList.toggle('show');
            hamburger.classList.toggle('active');
        });

        const dropdownBtn = document.querySelector('.dropdown-btn');
        const dropdownContainer = dropdownBtn.nextElementSibling;

        dropdownBtn.addEventListener('click', function() {
            dropdownContainer.classList.toggle('show');
            dropdownBtn.classList.toggle('active');
            if (dropdownContainer.classList.contains('show')) {
                dropdownContainer.style.height = dropdownContainer.scrollHeight + 'px';
            } else {
                dropdownContainer.style.height = '0';
            }
        });

        // Prevent the dropdown from closing when a submenu item is clicked
        dropdownContainer.addEventListener('click', function(event) {
            event.stopPropagation();
        });

        // Keep the dropdown open if a submenu item is active
        if (dropdownContainer.querySelector('.drop-active')) {
            dropdownContainer.classList.add('show');
            dropdownContainer.style.height = dropdownContainer.scrollHeight + 'px';
            dropdownBtn.classList.add('active');
        }
    });
</script> --}}


</body>
</html>
