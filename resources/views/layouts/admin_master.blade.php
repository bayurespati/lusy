<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    @stack('title')

    <!-- Standard Favicon -->
    <link rel="icon" type="image/x-icon" 
    href="{{ asset('img/favicon_admin.ico') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Our Custom CSS -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    <style type="text/css">
        p {
            color: #666;
        }
    </style>

    @stack('additional_css')
</head>

<body>
    
    @yield('content')

    <script src="{{ asset('js/app.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>

    @stack('additional_js')
</body>
</html>