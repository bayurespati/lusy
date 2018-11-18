@extends('layouts.master')

@push('title')
<title>Lusy Wahyudi - Event</title>
@endpush

@push('additional_css')
<link href="{{ asset('css/animation.css') }}" rel="stylesheet">

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
            <div class="page-banner" 
            style="background-image: url({{ $eventBanner }});">
                <!-- Container -->
                <div class="container">
                    <h3>Events & Activities</h3>
                </div>
                <!-- Container /- -->
            </div>
            <!-- Page Banner /- -->
            
            <div class="section-padding"></div>

            @if($isEventsExist)
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
                    <div id="event-content" class="row">
                        <!-- Content Area -->
                        <div id="event-group" class="col-md-12 zoom-in">
                            @if(count($upcomingEvents) > 0)
                            @foreach($upcomingEvents as $event)
                            <div class="col-md-12 col-sm-12 col-xs-12 no-padding event-block">
                                <div class="col-md-5 col-sm-12 col-xs-12 event-image">
                                    <a href="/event/single/{{ $event->id }}">
                                        <img src="{{ $event->poster }}" alt="Events" />
                                        <div class="tag">{{ $event->kategori }}</div>
                                    </a>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 event-content">
                                    <div class="post-date">
                                        <span>{{ $event->dayDate }}</span>
                                        <span>{{ $event->month }}</span>
                                    </div>
                                    <h3><a href="/event/single/{{ $event->id }}" title="{{ $event->title }}">{{ $event->title }}</a></h3>
                                    <h4><a href="/event/single/{{ $event->id }}" title="London"><i class="fa fa-map-marker"></i>{{ $event->location }}</a> <a href="{{ $event->id }}"><i class="fa fa-clock-o"></i>{{ $event->day }}: {{ $event->startHour }} - {{ $event->endHour }}</a></h4>
                                    <p>
                                        {!! nl2br(e($event->content)) !!}
                                    </p>
                                    <a href="/event/single/{{ $event->id }}" title="Read More">Read More</a>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <h3 class="text-center" style="color: lightgrey">
                                *there are no events on this classification yet*
                            </h3>
                            @endif
                        </div>
                        <!-- Content Area /- -->
                    </div>

                    <nav id="event-pagination" class="ow-pagination text-center fade-in">
                        @if (count($upcomingEvents) > 0)
                        <ul id="pagination-list" class="pagination">
                            <li class="{{ ($upcomingEvents->currentPage() == 1) ? ' disabled' : '' }}">
                                <a onClick="goToPage(1)"><i class="fa fa-angle-double-left"></i></a>
                            </li>
                    
                            @for ($i = 1; $i <= $upcomingEvents->lastPage(); $i++)
                                <?php
                                $half_total_links = floor(4 / 2);
                                $from = $upcomingEvents->currentPage() - $half_total_links;
                                $to = $upcomingEvents->currentPage() + $half_total_links;

                                if ($upcomingEvents->currentPage() < $half_total_links) {
                                    $to += $half_total_links - $upcomingEvents->currentPage();
                                }
                                if ($upcomingEvents->lastPage() - $upcomingEvents->currentPage() < $half_total_links) {
                                    $from -= $half_total_links - ($upcomingEvents->lastPage() - $upcomingEvents->currentPage() - 1);
                                }
                                ?>
                            
                                @if ($from < $i && $i < $to)
                                <li class="{{ ($upcomingEvents->currentPage() == $i) ? ' active' : '' }}">
                                    <a onClick="goToPage({{ $i }})">{{ $i }}</a>
                                </li>
                                @endif
                            @endfor
                            <li class="{{ $upcomingEvents->currentPage() == $upcomingEvents->lastPage() ? ' disabled' : '' }}">
                                <a onClick="goToPage({{ $upcomingEvents->lastPage() }})"><i class="fa fa-angle-double-right"></i></a>
                            </li>
                        </ul>
                        @else
                        <ul id="pagination-list"></ul>
                        @endif
                    </nav>
                </div>
                <!-- Container /- -->
            </div>
            @else
            <h3 class="text-center" style="color: lightgrey">
                *we're currently organizing events to be held here (please be patient)*
            </h3>
            @endif

            <div id="section-padding" class="section-padding"></div>

        </main>

        <!-- Footer Section -->
        @include('partials.footer')
        <!-- Footer Section /- -->
        
    </div>
</body>

@endsection

@push('additional_js')
<script type="text/javascript">
    const categoriesAndSubcategories = {!! json_encode($categories) !!};
    let showedEvents = {!! json_encode($upcomingEvents) !!};
    let categoryCount = {!! $categories !!}.length;
    let subcategoryCount = 0;
    let submenuExist = false;
    let subCategoryChosen = false;
    let loadedEventType = 'all';
    let eventStatus = 'upcoming';
    let subcategoryIdTemp = 0;

    function changeStatus(newStatus){
        removeActiveClass(eventStatus + '-events');

        var option = document.getElementById(newStatus + '-events');
        option.setAttribute('class', 'active');

        eventStatus = newStatus;

        getAll();
    }

    function getAll(){
        loadedEventType = 'all';

        removeCategoriesActiveClass();

        removeActiveClass('all-option');
        
        if(submenuExist) {
            removeSubcategory();
        }

        cleanEvents();
        cleanPagination();

        showLoader();

        $.ajax({
            type: 'GET',
            url: 'https://' + window.location.hostname + '/event/' + eventStatus + '/' + loadedEventType + '?page=1',
            dataType: 'JSON',
            success: function (data) {
                setTimeout(function(){
                    prepareEvents(data);
                    preparePagination(data);

                    hideLoader();
                    subcategoryIdTemp = 0;
                }, 1000);
            }
        });

        var allOption = document.getElementById('all-option');
        allOption.setAttribute('class', 'active');
    }

    function goToPage(pageNumber){
        cleanEvents();
        cleanPagination();

        showLoader();

        if(loadedEventType === 'all'){
            $.ajax({
                type: 'GET',
                url: 'https://' + window.location.hostname + '/event/' + eventStatus + '/' + loadedEventType + '?page=' + pageNumber,
                dataType: 'JSON',
                success: function (data) {
                    setTimeout(function(){
                        prepareEvents(data);
                        preparePagination(data);

                        hideLoader();
                    }, 1000);
                }
            });
        }
        else {
            $.ajax({
                type: 'GET',
                url: 'https://' + window.location.hostname + '/event/' + eventStatus + '/' + loadedEventType + '/' + subcategoryIdTemp + '?page=' + pageNumber,
                dataType: 'JSON',
                success: function (data) {
                    setTimeout(function(){
                        prepareEvents(data);
                        preparePagination(data);

                        hideLoader();
                    }, 1000);
                }
            });
        }
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
            lists = lists + 
            '<li class="text-uppercase">' + 
            '   <a id="subcategory-' + i + '" onclick="getEvents(' + prop.id + ', ' + i + ' )" style="cursor: pointer;">' + prop.title + '</a>' + 
            '</li>';

            subcategoryCount++;
        });

        unorderedList.innerHTML = lists;
        listWrapper.appendChild(unorderedList);
        submenuExist = true;

    }

    function getEvents(subcategoryId, subcategoryListOrder) {
        loadedEventType = 'subcategory';

        if(subCategoryChosen){
            removeSubcategoriesActiveClass();
        }

        var option = document.getElementById('subcategory-' + subcategoryListOrder);
        option.setAttribute('class', 'active');
        subCategoryChosen = true;

        cleanEvents();
        cleanPagination();

        showLoader();

        $.ajax({
            type: 'GET',
            url: 'https://' + window.location.hostname + '/event/' + eventStatus + '/' + loadedEventType +  '/' + parseInt(subcategoryId) + '?page=1',
            dataType: 'JSON',
            success: function (data) {
                setTimeout(function(){
                    prepareEvents(data);
                    preparePagination(data);

                    hideLoader();
                    subcategoryIdTemp = subcategoryId;
                });
            }
        });
    }

    function removeSubcategoriesActiveClass(){
        for (var i = 0; i < subcategoryCount; i++) {
            removeActiveClass('subcategory-' + i);
        };
        subCategoryChosen = false;
    };

    function showLoader(){
        var loader = document.getElementById('site-loader');
        loader.setAttribute('class', 'load-complete fade-in-loader');
        loader.style.display = 'block';
    };

    function hideLoader(){
        var loader = document.getElementById('site-loader');
        loader.setAttribute('class', 'load-complete fade-out-loader');

        setTimeout(function(){
            loader.style.display = 'none';
        }, 1500);
    }

    function cleanEvents(){
        var eventGroup = document.getElementById('event-group');
        eventGroup.setAttribute('class', 'col-md-12 fade-out');

        setTimeout(function(){
            eventGroup.parentNode.removeChild(eventGroup);
        }, 100);
    }

    function cleanPagination(){
        var paginationList = document.getElementById('pagination-list');
        paginationList.setAttribute('class', 'pagination fade-out');

        setTimeout(function(){
            paginationList.parentNode.removeChild(paginationList);
        }, 100);
    }

    function prepareEvents(array){
        var parentOfEventGroup = document.getElementById('event-content');
        var eventGroup = document.createElement('div');
        eventGroup.setAttribute('id', 'event-group');
        eventGroup.setAttribute('class', 'col-md-12 zoom-in');

        let eventContent = '';

        if(array.data.length > 0){
            array.data.forEach(function(event){
                eventContent = eventContent + 
                '<div class="col-md-12 col-sm-12 col-xs-12 no-padding event-block">' +
                '   <div class="col-md-5 col-sm-12 col-xs-12 event-image">' +
                '       <a href="/event/single/' + event.id + '">' +
                '           <img src="' + event.poster + '" alt="' + event.title + '" />' +
                '           <div class="tag">' + event.kategori + '</div>' +
                '       </a>' + 
                '   </div>' + 
                '   <div class="col-md-6 col-sm-12 col-xs-12 event-content">' +
                '       <div class="post-date">' +
                '           <span>' + event.dayDate + '</span>' + 
                '           <span>' + event.month + '</span>' + 
                '       </div>' +
                '       <h3>' +
                '           <a href="/event/single/' +event.id+ '" title="' +event.title+ '">' + 
                '           ' + event.title +
                '           </a>' +
                '       </h3>' +
                '       <h4>' +
                '           <a href="/event/single/' + event.id + '" title="London">' +
                '               <i class="fa fa-map-marker"></i>' + event.location + 
                '           </a>' +
                '           <a href="' + event.id + '">' +
                '               <i class="fa fa-clock-o"></i>' + 
                '               ' + event.day + ': ' + event.startHour + ' - ' + event.endHour +
                '           </a>' +
                '       </h4>' +
                '       <p>' + nl2br(event.content) + '</p>' +
                '       <a href="/event/single/' + event.id + '" title="Read More">Read More</a>' +
                '   </div>' + 
                '</div>'
            }, eventContent);
        }
        else {
            eventContent = eventContent + 
            '<h3 class="text-center" style="color: lightgrey">*there are no events on this classification yet*</h3>';
        }

        eventGroup.innerHTML = eventContent;

        setTimeout(function(){
            parentOfEventGroup.appendChild(eventGroup);
        }, 100);
    }

    function nl2br (str, is_xhtml) {
        if (typeof str === 'undefined' || str === null) {
            return '';
        }
        var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
    }

    function preparePagination(data){
        var eventPagination = document.getElementById('event-pagination');
        var paginationList = document.createElement('ul');
        paginationList.setAttribute('id', 'pagination-list');
        paginationList.setAttribute('class', 'pagination');

        let paginationContent = '';

        if(data.data.length > 0){

            if(data.current_page == 1) {
                paginationContent = paginationContent + 
                '<li class="disabled">';
            } else {
                paginationContent = paginationContent + 
                '<li>';
            }

            paginationContent = paginationContent + 
            '       <a onClick="goToPage(1)">' +
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
                    '       <a onClick="goToPage(' + i + ')">' + i + '</a>' + 
                    '   </li>';
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
            '       <a onClick="goToPage(' + data.last_page + ')">' + 
            '           <i class="fa fa-angle-double-right"></i>' + 
            '       </a>' + 
            '   </li>'
        }

        paginationList.innerHTML = paginationContent;
            
        setTimeout(function(){
            eventPagination.appendChild(paginationList);
        }, 120);
    }
</script>
@endpush