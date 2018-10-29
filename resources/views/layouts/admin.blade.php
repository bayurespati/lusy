<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    @stack('title')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    
    <!-- Our Custom CSS -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    @stack('additional_css')
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Lusy Wahyudi</h3>
            </div>

            <ul class="list-unstyled components">
                <li  class="active">
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="#aboutSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">About</a>
                    <ul class="collapse list-unstyled" id="aboutSubmenu">
                        <li>
                            <a href="#">Profile</a>
                        </li>
                        <li>
                            <a href="#">Gallery</a>
                        </li>
                        <li>
                            <a href="#">Classes</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#galerySubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Gallery</a>
                    <ul class="collapse list-unstyled" id="galerySubmenu">
                        <li>
                            <a href="#">Category</a>
                        </li>
                        <li>
                            <a href="#">Sub-category</a>
                        </li>
                        <li>
                            <a href="#">Photo</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#eventSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Event & Activity</a>
                    <ul class="collapse list-unstyled" id="eventSubmenu">
                        <li>
                            <a href="#">Category</a>
                        </li>
                        <li>
                            <a href="#">Sub-category</a>
                        </li>
                        <li>
                            <a href="#">List</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#shopSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Shop</a>
                    <ul class="collapse list-unstyled" id="shopSubmenu">
                        <li>
                            <a href="#">Category</a>
                        </li>
                        <li>
                            <a href="#">Sub-category</a>
                        </li>
                        <li>
                            <a href="#">List</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#bookSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Bokkeping</a>
                    <ul class="collapse list-unstyled" id="bookSubmenu">
                        <li>
                            <a href="#">Member</a>
                        </li>
                        <li>
                            <a href="#">Shop Overseas Inquiry</a>
                        </li>
                        <li>
                            <a href="#">Applicant List</a>
                        </li>
                        <li>
                            <a href="#">Potential Shop Overseas Inquery List</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button" 
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{ Auth::user()->name }} 
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            @yield('content')

        </div>
    </div>


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