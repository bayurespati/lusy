<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('title')

    @stack('vendor_css')

    <!-- Styles -->
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">

    <!-- Standard Favicon -->
    <link rel="icon" type="image/x-icon" 
    href="{{ asset('img/favicon.ico') }}" />
    
    <!-- For iPhone 4 Retina display: -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" 
    href="{{ asset('img/apple-touch-icon-114x114-precomposed.png') }}">
    
    <!-- For iPad: -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" 
    href="{{ asset('img/apple-touch-icon-72x72-precomposed.png') }}">
    
    <!-- For iPhone: -->
    <link rel="apple-touch-icon-precomposed" 
    href="{{ asset('img/apple-touch-icon-57x57-precomposed.png') }}"> 
    
    <!-- Library - Google Font Familys -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i|PT+Serif:400,400i,700,700i|Poppins:300,400,500,600,700|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet"> 
    
    <!--[if lt IE 9]>
        <script src="{{ asset('js/html5.js') }}"></script>
    <![endif]-->

    @stack('additional_css')

</head>
<body>

@yield('content')

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/base.js') }}"></script>
<!-- <script type="text/javascript"> -->
    <!-- $(document).ready(function(){ -->
        <!-- //initialize the javascript -->
        <!-- App.init(); -->
    <!-- }); -->
</script>
@stack('additional_js')
</body>
</html>