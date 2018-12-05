@extends('layouts.master')

@push('title')
<title>Lusy Wahyudi - {{ $shopItem->title }}</title>
@endpush

@push('additional_css')
<link href="{{ asset('css/animation.css') }}" rel="stylesheet">

<style type="text/css">
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

  .fade-in-loader {
    animation: fadeIn 0.1s ease-in forwards;
  }

  .fade-out-loader {
    animation: fadeOut 1.5s ease-out forwards;
  }

  .loading-div {
    display: block;
    width: 100%;
    height: 500px;
    background: white;
  }
</style>

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
          <div class="container-fluid no-padding page-banner" 
          style="background-image: url({{ $shopBanner }});">

            <!-- Container -->
            <div class="container">
              <h3>Shop</h3>
            </div>
            <!-- Container /- -->
          </div>
          <!-- Page Banner /- -->

          <!-- Item Section -->
          <div class="container-fluid no-padding welcome-section2">
            <!-- Container -->
            <div class="container">
              <!-- Row -->
              <div class="row">           
                <div class="item">
                  
                  <div class="col-md-6 col-sm-6">
                    <div class="img-block">
                      <i><img src="{{ $shopItem->poster }}" alt="{{ $shopItem->title }}" /></i>
                    </div>

                    @if(count($shopItem->images) > 0)
                    <div id="gallery-section" class="portfolio-section" style="padding-top: 8px">
                      <div id="gallery-container" class="portfolio-list zoom-in">

                        @foreach($sortedItem as $photo)
                        @if($photo->type == 1)
                        <div class="portfolio-box col-md-2 col-sm-2 no-padding vintage">
                        @endif
                        @if($photo->type == 2)
                        <div class="portfolio-box col-md-3 col-sm-3 no-padding vintage">
                        @endif
                        @if($photo->type == 3)
                        <div class="portfolio-box col-md-6 col-sm-6 no-padding vintage">
                        @endif
                          <a href="{{ $photo->image_path }}">
                            <img src="{{ $photo->image_path }}" alt="{{ $photo->title }}" />

                            <div class="portfolio-content">
                              <i class="icon icon-Search"></i>
                              <h3>{{ $photo->title }}</h3>
                            </div>
                          </a>
                        </div>
                        @endforeach

                      </div>
                    </div>
                    @endif

                    @if ($shopItem->images->lastPage() > 1)
                    <nav id="gallery-pagination" class="ow-pagination text-center mt-5 fade-in">
                      <ul id="pagination-list" class="pagination">
                        <li class="{{ ($shopItem->images->currentPage() == 1) ? ' disabled' : '' }}">
                          <a onClick="goToPage(1, {{ $shopItem->id }})" style="padding-top: 10px">
                            <i class="fa fa-angle-double-left"></i>
                          </a>
                        </li>

                        @for ($i = 1; $i <= $shopItem->images->lastPage(); $i++)
                        <?php
                        $half_total_links = floor(4 / 2);
                        $from = $shopItem->images->currentPage() - $half_total_links;
                        $to = $shopItem->images->currentPage() + $half_total_links;

                        if ($shopItem->images->currentPage() < $half_total_links) {
                          $to += $half_total_links - $shopItem->images->currentPage();
                        }

                        if ($shopItem->images->lastPage() - $shopItem->images->currentPage() < $half_total_links) {
                          $from -= $half_total_links - ($shopItem->images->lastPage() - $shopItem->images->currentPage() - 1);
                        }
                        ?>

                        @if ($from < $i && $i < $to)
                        <li class="{{ ($shopItem->images->currentPage() == $i) 
                          ? ' active' : '' }}">
                          <a onClick="goToPage({{ $i }}, {{ $shopItem->id }})">{{ $i }}</a>
                        </li>
                        @endif

                        @endfor

                        <li class="{{ $shopItem->images->currentPage() == $shopItem->images->lastPage() ? ' disabled' : '' }}">
                          <a onClick="goToPage({{ $shopItem->images->lastPage() }}, {{ $shopItem->id }})"><i class="fa fa-angle-double-right" style="padding-top: 10px"></i></a>
                        </li>
                      </ul>
                    </nav>
                    @endif

                    <div id="section-padding" class="padding-20"></div>
                  </div>

                  <div class="col-md-6 col-sm-6 content-block-custom">
                    <div class="section-header">
                      <div class="section-title-border">
                        <span>{{ $shopItem->sub_title }}</span>
                        <h2>{{ $shopItem->title }}</h2> 
                      </div>
                    </div>

                    <span class="item-price-detail">IDR {{ $shopItem->price }}</span>
                    
                    <p class="mt-5">{!! $shopItem->description !!}</p>

                    <p class="m-0">Stock: {{ $shopItem->stock }}</p>

                    <div>
                      <button class="general-btn transitioned-btn" type="button" 
                      data-toggle="modal" data-target="#overseas">
                        Overseas Inquiry
                      </button>

                      <a href="{{ $shopItem->store_link }}">
                        <button class="general-btn transitioned-btn ml-2">
                          Buy Now
                        </button>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Row /- -->
            </div>
            <!-- Container /- -->
          </div>
          <!-- Item Section /- -->

        </main>

        <!-- Footer Section -->
        @include('partials.footer')
        <!-- Footer Section /- -->

        <!-- Modal -->
        <div class="modal fade" id="overseas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header text-center p-0" style="border: none">
                <button type="button" class="close transitioned-btn" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              
              <div class="modal-body">
                <div class="modal-body-header text-center pr-6 pl-6 mb-5">
                  <p class="m-0" style="font-size: 20px">
                    Please fill in the form below to make an inquiry for <strong>{{ $shopItem->title }}</strong> and we will be back to you as soon as possible.
                  </p>
                </div>


                <form action="/shop/update/overseas/{{$shopItem->id}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group form-control-sm text-center">
                    <div class="radio">
                      <label>
                        <input type="radio" name="gender" value="1" checked>Male
                      </label>
                    </div>
                    <div class="radio ml-4">
                      <label>
                        <input type="radio" value="0" name="gender">
                        Female
                      </label>
                    </div>
                  </div>
                  
                  <div class="form-group form-control-sm">
                    <input type="text" class="form-control" 
                    name="buyer_name" id="buyer_name" placeholder="Full Name*" minlength="2" required>
                  </div>

                  <div class="form-group form-control-sm">
                    <input type="text" class="form-control" 
                    name="address" id="address" placeholder="Address*" minlength="10" required>
                  </div>
                  
                  <div class="form-group form-control-sm">
                    <input type="email" class="form-control" 
                    name="email" id="email" placeholder="Email*" required>
                  </div>
                  
                  <div class="form-group form-control-sm">
                    <input type="text" class="form-control" 
                    name="city" id="city" placeholder="City*" minlength="2" required>
                  </div>
                  
                  <div class="form-group form-control-sm">
                    <input type="text" class="form-control" 
                    name="state_province" id="state_province" 
                    placeholder="State/Province*" minlength="2" required>
                  </div>
                  
                  <div class="form-group form-control-sm">
                    <input type="number" class="form-control" 
                    name="postal_code" id="postal_code" placeholder="Postal Code*" required>
                  </div>
                  
                  <div class="form-group form-control-sm">
                    <textarea class="form-control" rows="6"
                    name="notes" id="notes" placeholder="Your Notes"></textarea>
                  </div>
                  
                  <div class="form-group form-control-sm">
                    <input type="number" class="form-control" 
                    name="quantity" id="quantity" placeholder="Quantity*" required>
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
        
    </div>
</body>

@endsection

@push('additional_js')
<script type="text/javascript">
  const item = {!! json_encode($shopItem) !!}
  
  function goToPage(pageNumber, itemId){
    cleanImages();
    cleanPagination();

    $.ajax({
      type: 'GET',
      url: 'https://' + window.location.hostname + '/shop/item/images/' + itemId + '?page=' + pageNumber,
      dataType: 'JSON',
      success: function (data) {
        prepareImages(data);
        preparePagination(data);
      }
    });
  }

  function cleanImages(){
    var galleryContainer = document.getElementById('gallery-container');

    galleryContainer.setAttribute('class', 'portfolio-list fade-out');

    setTimeout(function(){
      galleryContainer.parentNode.removeChild(galleryContainer);
    }, 100);
  }

  function cleanPagination(){
    var paginationList = document.getElementById('pagination-list');
    paginationList.setAttribute('class', 'pagination fade-out');

    setTimeout(function(){
      paginationList.parentNode.removeChild(paginationList);
    }, 100);
  }

  function prepareImages(array){
    var gallerySection = document.getElementById('gallery-section');
    var galleryContainer = document.createElement('div');
    galleryContainer.setAttribute('id', 'gallery-container');
    galleryContainer.setAttribute('class', 'portfolio-list zoom-in');

    let galleryContent = '';

    array[1].forEach(function(photo){
      if(photo.type == 1){
        galleryContent = galleryContent + 
        '<div class="portfolio-box col-md-2 col-sm-2 no-padding vintage">';
      }
      else if(photo.type == 2){
        galleryContent = galleryContent + 
        '<div class="portfolio-box col-md-3 col-sm-3 no-padding vintage">';
      }
      else if(photo.type == 3){
        galleryContent = galleryContent + 
        '<div class="portfolio-box col-md-6 col-sm-6 no-padding vintage">';
      }

      galleryContent = galleryContent + 
      '   <a href="' + photo.image_path + '">' +
      '       <img src="' + photo.image_path + '" alt="' + photo.title + '"/>' +
      '       <div class="portfolio-content">' +
      '           <i class="icon icon-Search"></i>' +
      '           <h3>' + photo.title + '</h3>' +
      '       </div>' +
      '   </a>' +
      '</div>'
    }, galleryContent);

    galleryContainer.innerHTML = galleryContent;

    setTimeout(function(){
      gallerySection.appendChild(galleryContainer);

      check();
    }, 100);
  }

  function preparePagination(data){
    var galleryPagination = document.getElementById('gallery-pagination');
    var paginationList = document.createElement('ul');
    paginationList.setAttribute('id', 'pagination-list');
    paginationList.setAttribute('class', 'pagination');

    let paginationContent = '';

    if(data[0].current_page == 1) {
      paginationContent = paginationContent + 
      '<li class="disabled">';
    } else {
      paginationContent = paginationContent + 
      '<li>';
    }

    paginationContent = paginationContent + 
    '       <a onClick="goToPage(1, ' + item.id + ')" style="padding-top: 10px">' +
    '           <i class="fa fa-angle-double-left"></i>' +
    '       </a>' + 
    '   </li>';

    for(let i = 1; i <= data[0].last_page; i++){
      const halfTotalLinks = Math.floor(4/2);
      let from = data[0].current_page - halfTotalLinks;
      let to = data[0].current_page + halfTotalLinks;

      if (data[0].current_page < halfTotalLinks) {
        to += halfTotalLinks - data[0].current_page;
      };

      if (data[0].last_page - data[0].current_page < halfTotalLinks) {
        from -= halfTotalLinks - (data[0].last_page - data[0].current_page - 1);
      };

      if (from < i && i < to) {
        if (data[0].current_page == i) {
          paginationContent = paginationContent + 
          '<li class="active">';
        }
        else {
          paginationContent = paginationContent + 
          '<li>';
        }

        paginationContent = paginationContent + 
        '   <a onClick="goToPage(' + i + ', ' + item.id + ')">' + i + '</a>' + 
        '</li>';
      }
    }

    if(data[0].current_page == data[0].last_page) {
      paginationContent = paginationContent + 
      '<li class="disabled">';
    } else {
      paginationContent = paginationContent + 
      '<li>';
    }

    paginationContent = paginationContent + 
    '   <a onClick="goToPage(' +data[0].last_page+ ', ' +item.id+ ')" style="padding-top: 10px">' + 
    '       <i class="fa fa-angle-double-right"></i>' + 
    '   </a>' + 
    '</li>';

    paginationList.innerHTML = paginationContent;

    setTimeout(function(){
      galleryPagination.appendChild(paginationList);
    }, 120);
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