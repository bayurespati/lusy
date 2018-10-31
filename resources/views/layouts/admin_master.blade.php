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
    <!-- <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script> -->
    <!-- <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script> -->

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
                <li>
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="#aboutSubmenu" 
                    class="{{ request()->is('admin/about/*') ? 'active-forced dropdown-toggle' : 'dropdown-toggle' }}"
                    data-toggle="collapse" 
                    aria-expanded="false">About</a>
                    <ul class="{{ request()->is('admin/about/*') ? 'collapse list-unstyled show' : 'collapse list-unstyled' }}"
                    id="aboutSubmenu">
                        <li>
                            <a class="{{ request()->is('admin/about/profile') || request()->is('admin/about/profile/*') ? 'active-forced' : '' }}"
                                href="{{ route('admin.about.profile') }}">Profile</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('admin/about/gallery') || request()->is('admin/about/gallery/*') ? 'active-forced' : '' }}"
                                href="{{ route('admin.about.gallery') }}">Gallery</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('admin/about/class') || request()->is('admin/about/class/*') ? 'active-forced' : '' }}"
                                href="{{ route('admin.about.classes') }}">Classes</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a 
                    href="#galerySubmenu" 
                    data-toggle="collapse" 
                    aria-expanded="false" 
                    class="{{ request()->is('admin/gallery/*') ? 'active-forced dropdown-toggle' : 'dropdown-toggle' }}">Gallery</a>
                    <ul class="{{ request()->is('admin/gallery/*') ? 'collapse list-unstyled show' : 'collapse list-unstyled' }}"
                     id="galerySubmenu">
                        <li>
                            <a class="{{ request()->is('admin/gallery/category') || request()->is('admin/gallery/category/*') ? 'active-forced' : '' }}"
                            href="{{ route('admin.gallery.category') }}">Category</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('admin/gallery/subcategory') || request()->is('admin/gallery/subcategory/*') ? 'active-forced' : '' }}"
                            href="{{ route('admin.gallery.subcategory') }}">Subcategory</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('admin/gallery/list') || request()->is('admin/gallery/list/*') ? 'active-forced' : '' }}"" href="{{ route('admin.gallery.list') }}">Photo List</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a
                    class="{{ request()->is('admin/event/*') ? 'active-forced dropdown-toggle' : 'dropdown-toggle' }}" 
                    href="#eventSubmenu" 
                    data-toggle="collapse" 
                    aria-expanded="false">Event & Activities</a>
                    <ul class="{{ request()->is('admin/event/*') ? 'collapse list-unstyled show' : 'collapse list-unstyled' }}"
                     id="eventSubmenu">
                        <li>
                            <a class="{{ request()->is('admin/event/category') || request()->is('admin/event/category/*') ? 'active-forced' : '' }}" 
                            href="{{ route('admin.event.category') }}">Category</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('admin/event/subcategory') || request()->is('admin/event/subcategory/*') ? 'active-forced' : '' }}"
                            href="{{ route('admin.event.subcategory') }}">Subcategory</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('admin/event/list') || request()->is('admin/event/list/*') ? 'active-forced' : '' }}" href="{{ route('admin.event.list') }}">Event & Activity List</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a
                    class="{{ request()->is('admin/shop/*') ? 'active-forced dropdown-toggle' : 'dropdown-toggle' }}" 
                    href="#shopSubmenu" 
                    data-toggle="collapse" 
                    aria-expanded="false">Shop</a>
                    <ul class="{{ request()->is('admin/shop/*') ? 'collapse list-unstyled show' : 'collapse list-unstyled' }}"
                     id="shopSubmenu">
                        <li>
                            <a class="{{ request()->is('admin/shop/category') || request()->is('admin/shop/category/*') ? 'active-forced' : '' }}" 
                            href="{{ route('admin.shop.category') }}">Category</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('admin/shop/subcategory') || request()->is('admin/shop/subcategory/*') ? 'active-forced' : '' }}"
                            href="{{ route('admin.shop.subcategory') }}">Subcategory</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('admin/shop/list') || request()->is('admin/shop/list/*') ? 'active-forced' : '' }}" href="{{ route('admin.shop.list') }}">Item List</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#bookSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Bookeeping</a>
                    <ul class="collapse list-unstyled" id="bookSubmenu">
                        <li>
                            <a href="#">Member</a>
                        </li>
                        <li>
                            <a href="#">Overseas Inquiry List</a>
                        </li>
                        <li>
                            <a href="#">Applicant List</a>
                        </li>
                        <li>
                            <a href="#">Potential Overseas Inquiry List</a>
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