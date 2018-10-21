<nav class="navbar navbar-full navbar-inverse navbar-fixed-top mai-top-header">
    <div class="container">

        <a href="/home" class="navbar-brand"></a>

        <!--=========================================================================================
            L E F T     M E N U
            =========================================================================================-->
        <ul class="nav navbar-nav mai-top-nav">
            <li class="nav-item active">
                <a href="#" class="nav-link">Setjen Wantannas</a>
            </li>
            {{--<li class="nav-item">--}}
                {{--<a href="#" class="nav-link">Super Admin</a>--}}
            {{--</li>--}}
        </ul>


        <!--=========================================================================================
            U S E R     M E N U
            =========================================================================================-->
        @include('partials.user__menu')

    </div>
</nav>