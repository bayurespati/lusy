@extends('layouts.master')

@push('title')
<title>Lusy Wahyudi - {{ $event->title }}</title>
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

    .content-area {
        width: 100%;
    }

    .modal-body {
    max-width: 500px;
    margin: 0 auto;
  }

  .radio {
    display: inline-block !important;
  }

  .radio label {
    color: #999;
  }

  .modal-content {
    font-family: 'Poppins', sans-serif !important;
    border-radius: 0 !important;
  }

  .modal-body form {
    font-size: 18px;
  }

  .modal-body .form-control {
    height: 42px;
    font-size: 18px;
    border-radius: 0;
  }

  .modal-body textarea {
    height: auto !important;
  }

  ::-webkit-input-placeholder {
      text-align: center;
  }

  :-moz-placeholder { /* Firefox 18- */
      text-align: center;  
  }

  ::-moz-placeholder {  /* Firefox 19+ */
      text-align: center;  
  }

  :-ms-input-placeholder {  
      text-align: center; 
  }

  input {
    text-align: center;
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
            
            <div id="event-container" class="container-fluid no-padding events-single mt-5">
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
                                    <h1 class="mt-0">{{ $event->title }}</h1>
                                    <h4><a title="{{ $event->location }}"><i class="fa fa-map-marker"></i>{{ $event->location }}, {{ $event->address }}</a> <a><i class="fa fa-clock-o"></i>{{ $event->day }}: {{ $event->startHour }} - {{ $event->endHour }}</a></h4>
                                    <p class="m-0" style="text-align: justify;">
                                        {!! nl2br(e($event->content)) !!}
                                    </p>
                                </div>

                                <div class="col-12" style="padding-left: 100px">
                                    <button class="general-btn transitioned-btn" type="button" 
                                    data-toggle="modal"
                                    data-target="#event" style="width: 100%">
                                    Register Event
                                </button>
                                </div>
                            </div><!-- Event Block /- -->
                        </div><!-- Content Area /- -->
                    </div>
                </div><!-- Container /- -->

                <div id="gallery-section" class="portfolio-section" style="padding-top: 40px">
                  <div id="gallery-container" class="portfolio-list">
                    @foreach($event->images as $photo)
                    <div class="portfolio-box col-md-3 col-sm-3 no-padding vintage">
                      <a href="{{ $photo->image_path }}">
                        <img src="{{ $photo->image_path }}" alt="{{ $photo->title }}" />

                        <div class="portfolio-content">
                          <i class="icon icon-Search"></i>
                          <h3>{{ $photo->title }}</h3>
                          <span>{{ $photo->description }}</span>
                        </div>
                      </a>
                    </div>
                    @endforeach
                  </div>
                </div>

                <nav id="gallery-pagination" class="ow-pagination text-center mt-5">
                    @if ($event->images->lastPage() > 1)
                    <ul class="pagination">
                        <li class="{{ ($event->images->currentPage() == 1) ? ' disabled' : '' }}">
                            <a href="#menu-container" onClick="goToPage(1, {{ $event->id }})"><i class="fa fa-angle-double-left"></i></a>
                        </li>
                    
                        @for ($i = 1; $i <= $event->images->lastPage(); $i++)
                            <?php
                            $half_total_links = floor(4 / 2);
                            $from = $event->images->currentPage() - $half_total_links;
                            $to = $event->images->currentPage() + $half_total_links;

                            if ($event->images->currentPage() < $half_total_links) {
                                $to += $half_total_links - $event->images->currentPage();
                            }
                            if ($event->images->lastPage() - $event->images->currentPage() < $half_total_links) {
                                $from -= $half_total_links - ($event->images->lastPage() - $event->images->currentPage() - 1);
                            }
                            ?>
                            
                            @if ($from < $i && $i < $to)
                            <li class="{{ ($event->images->currentPage() == $i) ? ' active' : '' }}">
                                <a href="#menu-container" onClick="goToPage({{ $i }}, {{ $event->id }})">{{ $i }}</a>
                            </li>
                            @endif
                        @endfor
                        <li class="{{ $event->images->currentPage() == $event->images->lastPage() ? ' disabled' : '' }}">
                            <a href="#menu-container" onClick="goToPage({{ $event->images->lastPage() }}, {{ $event->id }})"><i class="fa fa-angle-double-right"></i></a>
                        </li>
                    </ul>
                    @endif
                </nav>

                <div id="section-padding" class="section-padding"></div>
            </div>

        </main>

        <!-- Modal -->
        <div class="modal fade" id="event" tabindex="-1" 
             role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header text-center p-0" style="border: 0">
                    <button type="button" class="close transitioned-btn" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <div class="modal-body-header text-center pr-6 pl-6 mb-5">
                        <p class="m-0" style="font-size: 20px">
                            Please fill in the form below in order to register to {{ $event->title }}
                        </p>
                    </div>

                    <form action="/event/registration/{{$event->id}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group form-control-sm">
                            <input type="text" class="form-control" 
                            name="name" id="name" placeholder="Full Name*" required>
                        </div>

                        <div class="form-group form-control-sm">
                            <input type="email" class="form-control" 
                            name="email" id="email" placeholder="Email*" required>
                        </div>

                        <div class="form-group form-control-sm">
                            <input type="text" class="form-control" 
                            name="phone" id="phone" placeholder="Phone Number*" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="general-btn transitioned-btn mb-3" style="width: 100%">
                                Submit
                            </button>
                        </div>
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
<script type="text/javascript">
  const event = {!! json_encode($event) !!}
  
  function goToPage(pageNumber, eventId){
    $.ajax({
      type: 'GET',
      url: 'https://' + window.location.hostname + '/event/single/images/' + eventId + '?page=' + pageNumber,
      dataType: 'JSON',
      success: function (data) {
        cleanImages();
        prepareImages(data);

        cleanPagination();
        preparePagination(data);
      }
    });
  }

  function cleanImages(){
    var galleryContainer = document.getElementById('gallery-container');

    galleryContainer.parentNode.removeChild(galleryContainer);
  }

  function cleanPagination(){
    var galleryPagination = document.getElementById('gallery-pagination');

    galleryPagination.parentNode.removeChild(galleryPagination);
  }

  function prepareImages(array){
        var gallerySection = document.getElementById('gallery-section');

        let galleryContent = '<div id="gallery-container" class="portfolio-list">';

        array.data.forEach(function(photo){
            galleryContent = galleryContent + 
            '<div class="portfolio-box col-md-3 col-sm-3 no-padding vintage">' +
            '   <a href="' + photo.image_path + '">' +
            '       <img src="' + photo.image_path + '" alt="' + photo.title + '"/>' +
            '       <div class="portfolio-content">' +
            '           <i class="icon icon-Search"></i>' +
            '           <h3>' + photo.title + '</h3>' +
            '           <span>' + photo.creator + '</span>' +
            '       </div>' +
            '   </a>' +
            '</div>'
        }, galleryContent);

        galleryContent = galleryContent + '</div>';

        setTimeout(function(){
          gallerySection.innerHTML = galleryContent;

          check();
        }, 500);
    }

    function preparePagination(data){
        var parentOfSectionPadding = document.getElementById('section-padding').parentNode;
        var sectionPadding = document.getElementById('section-padding');
        var paginationContainer = document.createElement('nav');
        paginationContainer.setAttribute('id', 'gallery-pagination');
        paginationContainer.setAttribute('class', 'ow-pagination text-center mt-5');

        let paginationContent = '';

        paginationContent = paginationContent + 
        '<ul class="pagination">';

        if(data.current_page == 1) {
            paginationContent = paginationContent + 
            '<li class="disabled">';
        } else {
            paginationContent = paginationContent + 
            '<li>';
        }

        paginationContent = paginationContent + 
        '       <a href="#menu-container" onClick="goToPage(1, ' + event.id + ')">' +
        '           <i class="fa fa-angle-double-left"></i>' +
        '       </a>' + 
        '   </li>';

        for(let i = 1; i <= data.last_page; i++){
            const halfTotalLinks = Math.floor(4/2);
            let from = data.current_page - halfTotalLinks;
            let to = data.current_page + halfTotalLinks;

            if (data.current_page < halfTotalLinks) {
                to += halfTotalLinks - data.current_page;
            };

            if (data.last_page - data.current_page < halfTotalLinks) {
                from -= halfTotalLinks - (data.last_page - data.current_page - 1);
            };

            if (from < i && i < to) {
                if (data.current_page == i) {
                    paginationContent = paginationContent + 
                    '<li class="active">';
                }
                else {
                    paginationContent = paginationContent + 
                    '<li>';
                }


                paginationContent = paginationContent + 
                '   <a href="#menu-container" onClick="goToPage(' + i + ', ' + event.id + ')">' + i + '</a>' + 
                '</li>';
            }
        }

        if(data.current_page == data.last_page) {
            paginationContent = paginationContent + 
            '<li class="disabled">';
        } else {
            paginationContent = paginationContent + 
            '<li>';
        }

        paginationContent = paginationContent + 
        '       <a href="#menu-container" onClick="goToPage(' + data.last_page + ', ' + event.id + ')">' + 
        '           <i class="fa fa-angle-double-right"></i>' + 
        '       </a>' + 
        '   </li>' + 
        '</ul>';

        paginationContainer.innerHTML = paginationContent;
        setTimeout(function(){
            parentOfSectionPadding.insertBefore(paginationContainer, sectionPadding);
        }, 500);
    }

    function check(){
        if($(".portfolio-section").length){
            var url;
            $(".portfolio-section .portfolio-box").magnificPopup({
                delegate: "a",
                type: "image",
                tLoading: "Loading image #%curr%...",
                mainClass: "mfp-img-mobile",
                gallery: {
                    enabled: true,
                    navigateByImgClick: false,
                    preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                },
                image: {
                    tError: "<a href="%url%">The image #%curr%</a> could not be loaded.",               
                }
            });
        }
        
        /* - Portfolio Section */
        var $container = $(".portfolio-section .portfolio-list");
        $container.isotope({
            layoutMode: 'fitRows',
            itemSelector: ".portfolio-box",
            gutter: 0,
            transitionDuration: "0.5s"
        });
        
        $("#filters a").on("click",function(){
            $('#filters a').removeClass("active");
            $(this).addClass("active");
            var selector = $(this).attr("data-filter");
            $container.isotope({ filter: selector });       
            return false;
        });
    }
</script>
@endpush