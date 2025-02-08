<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset("images/New MLG logo.png")}}" type="image/png">
    <title>@yield('title', 'Crud')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <!-- Add this in the <head> or before your script that uses $ -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>MLGCL Instructor Logging</title>


</head>

<style>
    .bg-cover img{
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    main{
        display: flex;
        flex-direction: column;
        gap: 50px;
    }
    .loginForm{
        border-left: 1px solid #818181;
        padding-left: 30px;
    }
    .logo{
        display: flex;
        flex-direction: column-reverse;
        align-items: center;
        padding-right: 30px;
        margin-bottom: 50px
    }
    .formInput{
        width: 300px;
    }

    @media(max-width: 600px) {
        .bg-cover img{
            width: 100vw;
            height: 100px;
            object-fit: cover;
        }
        main{
            gap: 25px;
        }
        .login_form{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .logo{
            margin: 10px;
            padding: 0px;
        }
        .logo img{
            width: 180px;
        }
        .loginForm{
            border: none;
            padding: 0;
        }
    }

</style>

<body>

    @yield('content')



    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>


    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    {{-- <script type="text/javascript" src="slick/slick.min.js"></script> --}}
</body>

</html>
