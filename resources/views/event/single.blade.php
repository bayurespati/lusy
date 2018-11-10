@extends('layouts.master')

@push('title')
<title>Lusy Wahyudi - Event</title>
@endpush

@push('additional_css')
<style type="text/css">
    .event-image {
        position: relative;
    }

    .tag{
        top: 20px;
        text-transform: uppercase;
        position: absolute;
        padding: 10px 20px 10px 20px;
        background: crimson;
        color: white;
        font-weight: bold;
    }
</style>
@endpush

@section('content')

<body data-offset="200" data-spy="scroll" data-target=".ow-navigation">
    <div class="main-container">
        <!-- Loader -->
        <div id="site-loader" class="load-complete">
            <div class="loader">
                <div class="loader-inner ball-clip-rotate">
                    <div></div>
                </div>
            </div>
        </div><!-- Loader /- -->    

        <!-- Header Section -->
        @include('partials.header')
        <!-- Header Section /- -->

        <main>

            <!-- Page Banner -->
            <div class="page-banner">
                <!-- Container -->
                <div class="container">
                    <h3 class="text-uppercase">{{ $event->kategori }}</h3>
                </div>
                <!-- Container /- -->
            </div>
            <!-- Page Banner /- -->

            <div class="section-padding"></div>
            
            <div class="container-fluid no-padding events-single">
                <!-- Container -->
                <div class="container">
                    <div class="row">
                        <!-- Content Area -->
                        <div class="col-md-12 content-area">
                            <!-- Event Block -->
                            <div class="col-md-12 col-sm-12 col-xs-12 no-padding event-block">
                                <div class="col-md-12 col-sm-12 col-xs-12 no-padding event-cover">
                                    <img src="{{ $event->poster }}" alt="{{ $event->title }}" />
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 event-content">
                                    <div class="post-date"><span>{{ $event->dayDate }}</span><span>{{ $event->month }}</span></div>
                                    <h3>{{ $event->title }}</h3>
                                    <h4><a title="{{ $event->location }}"><i class="fa fa-map-marker"></i>{{ $event->location }}</a> <a><i class="fa fa-clock-o"></i>{{ $event->day }}: {{ $event->startHour }} - {{ $event->endHour }}</a></h4>
                                    <p>
                                        {!! nl2br(e($event->content)) !!}
                                    </p>
                                </div>

                                <div>
                                    <button class="general-btn transitioned-btn" type="button" 
                                            data-toggle="modal"
                                            data-target="#event">Register Event</button>
                                </div>
                            </div><!-- Event Block /- -->
                        </div><!-- Content Area /- -->
                        
                    </div>
                </div><!-- Container /- -->
            </div>
            <div class="section-padding"></div>

        </main>

        <!-- Modal -->
        <div class="modal fade" id="event" tabindex="-1" 
             role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Event Reqistration</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="/event/registration/{{$event->id}}" method="post" enctype="multipart/form-data">
                        @csrf
                      <div class="form-group form-control-sm">
                            <label for="buyer_name">Name</label>
                            <input type="text" class="form-control" 
                                    name="name" id="name" placeholder="Name" required>
                      </div>
                      <div class="form-group form-control-sm">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" 
                                   name="email" id="email" placeholder="Email" required>
                      </div>
                      <div class="form-group form-control-sm">
                            <label for="city">Phone number</label>
                            <input type="text" class="form-control" 
                                   name="phone" id="phone" placeholder="Phone" required>
                      </div>
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <button type="submit" class="btn btn-warning" data-dismiss="modal">close</button>
                    </form>
                  </div>
                </div>
            </div>
        </div>

        <!-- Footer Section -->
        @include('partials.footer')
        <!-- Footer Section /- -->
        
    </div>
</body>

@endsection

@push('additional_js')
@endpush