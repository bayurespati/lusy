@extends('layouts.master')

@push('title')
<title>Lusy Wahyudi - About</title>
@endpush

@push('additional_css')
<style>
    .onview-section::before {
        background-color: unset;
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
            <div class="container-fluid no-padding page-banner" 
            style="background-image: url({{ $aboutBanner  }})">
                <!-- Container -->
                <div class="container">
                    <h3>about</h3>
                </div>
                <!-- Container /- -->
            </div>
            <!-- Page Banner /- -->

            <!-- About Us Section -->
            <div id="welcome-section" class="container-fluid no-padding welcome-section2">
                <!-- Container -->
                <div class="container">
                    <!-- Row -->
                    <div class="row">           
                        <div class="col-md-6 col-sm-6 img-block">
                            <i><img src="{{ $about[0]->image_path }}" alt="{{ $about[0]->title }}" /></i>
                        </div>
                        <div class="col-md-6 col-sm-6 content-block">
                            <!-- Section Header -->
                            <div class="section-header2">
                                <i><img src="{{ asset('img/section-header2-1.png') }}" alt="Section Header" /></i>
                                <h2>{{ $about[0]->title }}</h2>
                            </div>
                            <!-- Section Header /- -->
                            <p>
                                {!! nl2br(e($about[0]->content)) !!}
                            </p>
                        </div>
                    </div>
                    <!-- Row /- -->
                </div>
                <!-- Container /- -->
            </div>
            <!-- About Us Section /- -->
            
            <!-- Portfolio Section -->
            <div class="container-fluid no-padding">
                <div class="row achievement-view">
                    @foreach($achievements as $achievement)
                    <div class="col-md-3 col-sm-6 col-xs-12 achievement-wrapper text-center">
                        <div class="achievement-border">
                            <div class="achievement-content">
                                <div class="icon">
                                    <span>
                                        <i class="{{ $achievement['logo'] }}"></i>
                                    </span>
                                </div>

                                <div class="value">
                                    <span>{{ $achievement['value'] }}</span>
                                </div>

                                <div class="title">
                                    <span>{{ $achievement['title'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- Portfolio Section /- -->
            

            <!-- Gallery Showcase Section -->
            @if(count($showedImage) > 0)

            <div class="container-fluid no-padding portfolio-section">
                <!-- Container -->
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            <!-- Section Header -->
                            <div class="section-header">
                                <div class="section-title-border">
                                    <span>Its Our Great Flows</span>
                                    <h2>our gallery</h2>
                                </div>
                            </div><!-- Section Header /- -->
                        </div>
                    </div>
                    
                </div><!-- Container /- -->
                <div class="portfolio-list">
                    @foreach($showedImage as $image)
                        <div class="portfolio-box col-md-3 col-sm-3 no-padding vintage">
                            <a href="{{ $image->image_path }}">

                                <img src="{{ $image->image_path }}" alt="{{ $image->title }}" />

                                <div class="portfolio-content">
                                    <i class="icon icon-Search"></i>
                                    <h3>{{ $image->title }}</h3>
                                    <span>{{ $image->creator }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
            <!-- Gallery Showcase Section /- -->

            <!-- Classes Showcase Section -->
            @if(count($classes) > 0)
            <div class="container-fluid no-padding welcome-section">
                <!-- Container -->
                <div class="container">
                   
                    <!-- Row -->
                    <div class="row">
                        <div id="welcome-carousel" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                @for ($i = 0; $i < count($classes); $i++)
                                <div class="item {{ $i === 0 ? 'active' : '' }}">

                                     <!-- Section Header -->
                                    <div class="section-header">
                                        <div class="section-title-border">
                                            <span>Introducing</span>
                                            <h2>{{ $classes[$i]->title }}</h2> 
                                        </div>
                                    </div>
                                    <!-- Section Header /- -->
                                    <div class="col-md-6 col-sm-6 content-block-custom">
                                        <p>
                                            {!! $classes[$i]->content !!}
                                        </p>
                                        
                                        <button class="general-btn transitioned-btn"
                                                data-toggle="modal"
                                                data-target="#member-register"
                                                onclick="setIdClass(
                                                '{{ $classes[$i]->id }}', 
                                                '{{ $classes[$i]->title }}')">
                                            Register
                                        </button>

                                        <div class="wc-controls" style="right: 0; left: unset;">
                                            <a class="left carousel-control" href="#welcome-carousel" role="button" data-slide="prev">
                                                <span></span>
                                            </a>

                                            <a class="right carousel-control" href="#welcome-carousel" role="button" data-slide="next">
                                                <span></span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6 img-block">
                                        <i><img src="{{ $classes[$i]->image_path }}" alt="{{ $classes[$i]->title }}" /></i>
                                    </div>
                                </div>
                                @endfor
                                
                            </div>
                            <!-- Controls -->
                        </div>
                    </div>
                    <!-- Row /- -->
                </div>
                <!-- Container /- -->
            </div>
            @endif
            <!-- Classes Showcase Section /- -->

        </main>
        
        <!-- Modal -->
        <div class="modal fade" id="member-register" tabindex="-1" 
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
                      <p id="modal-opening" class="m-0" style="font-size: 20px">
                         
                      </p>
                    </div>

                    <form action="member" method="post" enctype="multipart/form-data">
                        @csrf

                      <div class="form-group form-control-sm text-center">
                          <div class="radio">
                            <label>
                                <input type="radio" name="gender" value="1" checked>Male
                            </label>
                          </div>
                          <div class="radio ml-4">
                            <label>
                                <input type="radio" value="0" name="gender">Female
                            </label>
                        </div>
                      </div>
                      <div class="form-group form-control-sm">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name*" required>
                      </div>
                      <div class="form-group form-control-sm">
                            <input type="text" class="form-control" name="place_of_birth" id="place_of_birth" placeholder="Place of Birth*" required>
                      </div>
                      <div class="form-group form-control-sm">
                            <input type='text' name="date_of_birth" class="form-control" id="date-of-birth" placeholder="Date of birth : MM/DD/YYYY"/>
                      </div>
                      <div class="form-group form-control-sm">
                            <input type="email" class="form-control" 
                            name="email" id="email" placeholder="Email*" required>
                      </div>
                      <div class="form-group form-control-sm">
                            <!-- <label for="city">Telephone number</label> -->
                            <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Telephone Number*" required>
                      </div>
                      <div class="form-group form-control-sm">
                            <!-- <label for="city">Mobile number</label> -->
                            <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number">
                      </div>
                      <div class="form-group form-control-sm">
                            <!-- <label for="city">Fax number</label> -->
                            <input type="text" class="form-control" name="fax" id="fax" placeholder="Fax Number">
                      </div>

                      <div hidden=""> <input  type="text" name="class_id" id="about_contents_id"> </div>

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
<script>
    function setIdClass($param, $title){
        document.getElementById('about_contents_id').value = $param;
        document.getElementById('modal-opening').innerHTML = 'Please fill in the form below in order to register to <strong>' + $title + '</strong> class and we will be back to you as soon as possible.';
    }
    
    var date = document.getElementById('date-of-birth');

        function checkValue(str, max) {
          if (str.charAt(0) !== '0' || str == '00') {
            var num = parseInt(str);
            if (isNaN(num) || num <= 0 || num > max) num = 1;
            str = num > parseInt(max.toString().charAt(0)) && num.toString().length == 1 ? '0' + num : num.toString();
          };
          return str;
        };

    date.addEventListener('input', function(e) {
        this.type = 'text';
        var input = this.value;

        if (/\D\/$/.test(input)) input = input.substr(0, input.length - 3);
          var values = input.split('/').map(function(v) {
            return v.replace(/\D/g, '')
          });
          if (values[0]) values[0] = checkValue(values[0], 12);
          if (values[1]) values[1] = checkValue(values[1], 31);
          var output = values.map(function(v, i) {
            return v.length == 2 && i < 2 ? v + ' / ' : v;
          });
          this.value = output.join('').substr(0, 14);
    });

</script>
@endpush