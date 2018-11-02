@extends('layouts.master')

@push('title')
<title>Lusy Wahyudi - Event</title>
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
                    <h3>Events & Activities</h3>
                </div>
                <!-- Container /- -->
            </div>
            <!-- Page Banner /- -->
            
            <div class="section-padding"></div>

            <div id="menu-container" class="container" style="padding-bottom: 7.5rem">
                <div class="col-md-12 col-sm-12 col-xs-12 no-padding portfolio-categories">
                    <ul>
                        <li class="text-uppercase">
                            <a id="past-events"  
                            style="cursor: pointer;"
                            onclick="changeStatus('past')">
                                PAST EVENTS
                            </a>
                        </li>
                        <li class="text-uppercase">
                            <a class="active" 
                            id="upcoming-events"  
                            style="cursor: pointer;"
                            onclick="changeStatus('upcoming')">
                                UPCOMING EVENTS
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 no-padding portfolio-categories">
                    <ul>
                        <li class="text-uppercase">
                            <a class="active" 
                            id="all-option" 
                            onclick="getAll()" 
                            style="cursor: pointer;">
                                ALL
                            </a>
                        </li>
                        @for ($i = 0; $i < count($categories); $i++)
                        <li class="text-uppercase">
                            <a id="category-{{ $i }}" 
                            onclick="getSubcategories({{ $categories[$i]->id }}, {{ $i }})"
                            class="text-uppercase"
                            style="cursor: pointer;">
                                {{ $categories[$i]->title }}
                            </a>
                        </li>
                        @endfor
                    </ul>
                </div>
            </div>
            
            <div class="container-fluid no-padding events-listing">
                <!-- Container -->
                <div class="container">
                    <div class="row">
                        <!-- Content Area -->
                        <div class="col-md-12">
                            <!-- Event Block -->
                            <div class="col-md-12 col-sm-12 col-xs-12 no-padding event-block">
                                <div class="col-md-5 col-sm-12 col-xs-12">
                                    <a href="event-single.php"><img src="{{ asset('img/events1.jpg') }}" alt="Events" /></a>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 event-content">
                                    <div class="post-date">
                                        <span>26</span>
                                        <span>may</span>
                                    </div>
                                    <h3><a href="event-single.php" title="British Museum">British Museum</a></h3>
                                    <h4><a href="#" title="London"><i class="fa fa-map-marker"></i>London</a> <a href="#"><i class="fa fa-clock-o"></i>MON: 10AM - 6PM</a></h4>
                                    <p>Then one day he was shooting at some food and up through the ground came a bubbling crude oil that is so lets make the most of this beautiful day the ground one day he was shooting at some food and up through the crude oil of this beautiful day.</p>
                                    <a href="event-single.php" title="Book Now">Book Now</a>
                                </div>
                            </div>
                            <!-- Event Block /- -->
                            
                            <!-- Event Block -->
                            <div class="col-md-12 col-sm-12 col-xs-12 no-padding event-block">
                                <div class="col-md-5 col-sm-12 col-xs-12">
                                    <a href="event-single.php"><img src="{{ asset('img/events2.jpg') }}" alt="Events" /></a>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 event-content">
                                    <div class="post-date">
                                        <span>30</span>
                                        <span>may</span>
                                    </div>
                                    <h3><a href="event-single.php" title="Guissum Museum">Guissum Museum</a></h3>
                                    <h4><a href="#" title="London"><i class="fa fa-map-marker"></i>Spain</a> <a href="#"><i class="fa fa-clock-o"></i>SAT: 8AM - 6PM</a></h4>
                                    <p>Then one day he was shooting at some food and up through the ground came a bubbling crude oil that is so lets make the most of this beautiful day the ground one day he was shooting at some food and up through the crude oil of this beautiful day.</p>
                                    <a href="event-single.php" title="Book Now">Book Now</a>
                                </div>
                            </div>
                            <!-- Event Block /- -->
                            
                            <!-- Event Block -->
                            <div class="col-md-12 col-sm-12 col-xs-12 no-padding event-block">
                                <div class="col-md-5 col-sm-12 col-xs-12">
                                    <a href="event-single.php"><img src="{{ asset('img/events3.jpg') }}" alt="Events" /></a>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 event-content">
                                    <div class="post-date">
                                        <span>02</span>
                                        <span>Jun</span>
                                    </div>
                                    <h3><a href="event-single.php" title="Universal Museum">Universal Museum</a></h3>
                                    <h4><a href="event-single.php" title="London"><i class="fa fa-map-marker"></i>Italy</a> <a href="#"><i class="fa fa-clock-o"></i>SUN: 10AM - 6PM</a></h4>
                                    <p>Then one day he was shooting at some food and up through the ground came a bubbling crude oil that is so lets make the most of this beautiful day the ground one day he was shooting at some food and up through the crude oil of this beautiful day.</p>
                                    <a href="event-single.php" title="Book Now">Book Now</a>
                                </div>
                            </div>
                            <!-- Event Block /- -->
                            
                            <!-- Event Block -->
                            <div class="col-md-12 col-sm-12 col-xs-12 no-padding event-block">
                                <div class="col-md-5 col-sm-12 col-xs-12">
                                    <a href="event-single.php"><img src="{{ asset('img/events4.jpg') }}" alt="Events" /></a>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 event-content">
                                    <div class="post-date">
                                        <span>13</span>
                                        <span>Jul</span>
                                    </div>
                                    <h3><a href="event-single.php" title="Heaven Museum">Heaven Museum</a></h3>
                                    <h4><a href="#" title="Paris"><i class="fa fa-map-marker"></i>Paris</a> <a href="#"><i class="fa fa-clock-o"></i>MON: 10AM - 6PM</a></h4>
                                    <p>Then one day he was shooting at some food and up through the ground came a bubbling crude oil that is so lets make the most of this beautiful day the ground one day he was shooting at some food and up through the crude oil of this beautiful day.</p>
                                    <a href="event-single.php" title="Book Now">Book Now</a>
                                </div>
                            </div>
                            <!-- Event Block /- -->
                            
                            <nav class="ow-pagination text-center">
                                <ul class="pagination">
                                    <li><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
                                </ul>
                            </nav>
                        </div>
                        <!-- Content Area /- -->
                    </div>
                </div>
                <!-- Container /- -->
            </div>
            <div class="section-padding"></div>

        </main>

        <!-- Footer Section -->
        @include('partials.footer')
        <!-- Footer Section /- -->
        
    </div>
</body>

@endsection

@push('additional_js')
<script type="text/javascript">
    let status = 'upcoming';
    const categoriesAndSubcategories = {!! json_encode($categories) !!}
    let categoryCount = {!! $categories !!}.length;
    let subcategoryCount = 0;
    let submenuExist = false;
    let subCategoryChosen = false;

    function changeStatus(newStatus) {
        var oldStatus = document.getElementById(status + '-events');
        oldStatus.removeAttribute('class', 'active');

        status = newStatus;

        getAll();

        var newStatus = document.getElementById(newStatus + '-events');
        newStatus.setAttribute('class', 'active');
    }

    function getAll(){
        removeCategoriesActiveClass();

        removeActiveClass('all-option');
        
        if(submenuExist) {
            removeSubcategory();
        }

        $.ajax({
            type: 'GET',
            url: 'https://' + window.location.hostname + '/event/' + status + '/all',
            dataType: 'JSON',
            success: function (data) {

                prepareEvents(data);

            }
        });

        var allOption = document.getElementById('all-option');
        allOption.setAttribute('class', 'active');
    }

    function getSubcategories(categoryId, categoryListOrder){
        removeCategoriesActiveClass();

        var option = document.getElementById('category-' + categoryListOrder);
        option.setAttribute('class', 'active');

        if(submenuExist) {
            removeSubcategory();
        }

        const categoryIndex = findWithinArrayWithAttributeOf(categoriesAndSubcategories, 'id', categoryId);

        prepareSubcategory(categoriesAndSubcategories[categoryIndex].subcategories);
    }

    function findWithinArrayWithAttributeOf(array, attribute, value) {
        for(var i = 0; i < array.length; i += 1) {
            if(array[i][attribute] === value) {
                return i;
            }
        }
    return -1;
    }

    function removeActiveClass(className){
        var option = document.getElementById(className);
        option.removeAttribute('class', 'active');
    };

    function removeCategoriesActiveClass(){
        removeActiveClass('all-option');

        for (var i = 0; i < categoryCount; i++) {
            removeActiveClass('category-' + i);
        };
    };

    function removeSubcategory() {
        // Removes an element from the document
        var subcategoriesMenu = document.getElementById('subcategories-menu');
        subcategoriesMenu.parentNode.removeChild(subcategoriesMenu);
        submenuExist = false;
        subcategoryCount = 0;
    }

    function prepareSubcategory(data){
        // Adds an element to the document
        var menuContainer = document.getElementById('menu-container');

        var listWrapper = document.createElement('div');
        listWrapper.setAttribute('id', 'subcategories-menu');
        listWrapper.setAttribute('class', 'col-md-12 col-sm-12 col-xs-12 no-padding portfolio-categories fade-in');
        menuContainer.appendChild(listWrapper);

        var unorderedList = document.createElement('ul');

        let lists = "";

        $.each(data, function (i, prop) {
            lists = lists + '<li class="text-uppercase"><a id="subcategory-' + i + '" onclick="getEvents(' + prop.id + ', ' + i + ' )" style="cursor: pointer;">' + prop.title + '</a></li>';

            subcategoryCount++;
        });

        unorderedList.innerHTML = lists;
        listWrapper.appendChild(unorderedList);
        submenuExist = true;

    }

    function getEvents(subcategoryId, subcategoryListOrder) {
        if(subCategoryChosen){
            removeSubcategoriesActiveClass();
        }

        var option = document.getElementById('subcategory-' + subcategoryListOrder);
        option.setAttribute('class', 'active');
        subCategoryChosen = true;

        $.ajax({
            type: 'GET',
            url: 'https://' + window.location.hostname + '/event/' + status + '/subcategory/' + parseInt(subcategoryId),
            dataType: 'JSON',
            success: function (data) {

                prepareEvents(data);
            }
        });
    }

    function removeSubcategoriesActiveClass(){
        for (var i = 0; i < subcategoryCount; i++) {
            removeActiveClass('subcategory-' + i);
        };
        subCategoryChosen = false;
    };

    function prepareEvents(data){

    }
</script>
@endpush