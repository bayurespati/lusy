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

    #search-message {
        color: lightgrey;
    }

    #search-message strong {
        color: darkgrey;
    }

    .event-block .event-content {
        padding: 22px 25px 61px;
    }

    .event-block .event-content h3 {
        font-size: 24px;
        line-height: 30px;
        padding-right: 60px;
    }

    .event-block .event-content .organiser-by {
        color: #e2b13c;
    }

    .event-block .event-content h4 a i {
        position: absolute;
        left: 26px;
    }

    .event-block .event-content h4 a {
        padding-left: 22px;
    }

    .event-block .event-content h4 {
        padding-right: 54px;
        text-transform: unset;
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
            <!-- <div class="page-banner"> -->
                <!-- Container -->
                <!-- <div class="container"> -->
                    <!-- <h3>Events & Activities</h3> -->
                <!-- </div> -->
                <!-- Container /- -->
            <!-- </div> -->
            <!-- Page Banner /- -->
            
            <div class="section-padding"></div>

            @if($isEventsExist)
            <div id="menu-container" class="container">
                <div class="col-md-12 col-sm-12 col-xs-12 no-padding portfolio-categories">
                    <ul>
                        <li class="text-uppercase">
                            <a class="active" 
                            id="past-events"  
                            style="cursor: pointer;"
                            onclick="changeStatus('past')">
                                PAST EVENTS
                            </a>
                        </li>
                        <li class="text-uppercase">
                            <a
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
                            onclick="toAll()" 
                            style="cursor: pointer;">
                                ALL
                            </a>
                        </li>
                        @for ($i = 0; $i < count($categories); $i++)
                        <li class="text-uppercase">
                            <a id="category-{{ $i }}" 
                            onclick="setCategories({{ $categories[$i]->id }}, {{ $i }})"
                            class="text-uppercase"
                            style="cursor: pointer;">
                                {{ $categories[$i]->title }}
                            </a>
                        </li>
                        @endfor
                    </ul>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 no-padding portfolio-categories">
                    <ul style="border: none">
                        <li class="text-uppercase" id="select-container">
                            <select class="form-control fade-in" id="choose-year" >
                                <option value="">--- All Years ---</option>
                                @for($i = 0; $i <= ($currentYear - $lowestYear); $i++)
                                <option value="{{ $currentYear - $i }}">{{ $currentYear - $i }}</option>
                                @endfor
                            </select>
                        </li>
                    </ul>
                </div>
            </div>

            <div id="search-message-wrapper">
                <h4 id="search-message" class="text-center fade-in"></h4>
            </div>
            
            <div class="container-fluid no-padding events-listing mt-6">
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
                                    </a>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 event-content">
                                    <div class="post-date">
                                        <span>{{ $event->dayDate }}</span>
                                        <span>{{ $event->month }}</span>
                                        <span>{{ $event->year }}</span>
                                    </div>
                                    <h3 class="mb-0">
                                        <a href="/event/single/{{ $event->id }}" title="{{ $event->title }}">{{ $event->title }} </a>
                                    </h3>
                                    <h4 class="organiser">
                                        <a class="p-0" href="/event/single/{{ $event->id }}">
                                            @if(count($event->organiser) > 0)
                                            <span class="organiser-by">by</span> {{ $event->organiser }}
                                            @endif
                                        </a>
                                    </h4>
                                    <h4><a href="/event/single/{{ $event->id }}" title="London"><i class="fa fa-map-marker"></i>{{ $event->location }}, {{ $event->address }}</a> <br> <a href="{{ $event->id }}" class="mt-2"><i class="fa fa-clock-o"></i>{{ $event->day }}</a></h4>
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
    const categories = {!! json_encode($categories) !!};
    const lowestYear = {!! json_encode($lowestYear) !!};
    const highestYear = {!! json_encode($highestYear) !!};
    const currentYear = {!! json_encode($currentYear) !!};

    let showedEvents = {!! json_encode($upcomingEvents) !!};
    let categoryCount = {!! $categories !!}.length;
    let loadedEventType = 'all';
    let categoryId = -1;
    let categoryListOrder = -1;
    let categoryIdTemp = -1;
    let eventStatus = 'past';
    let searchKey = '';

    function initiateSelectYear(){
        var selectYear = document.getElementById('choose-year');

        selectYear.addEventListener('input', function(e) {
            searchKey = this.value;

            searchFunction();
        });
    }

    function cleanSelectBox(){
        var selectBox = document.getElementById('choose-year');
        selectBox.setAttribute('class', 'form-control fade-out');

        selectBox.parentNode.removeChild(selectBox);

        createSelectBox();
    }

    function createSelectBox(){
        searchKey = '';
        var selectContainer = document.getElementById("select-container");

        var chooseYear = document.createElement('select');
        chooseYear.setAttribute('id', 'choose-year');
        chooseYear.setAttribute('class', 'form-control fade-in');

        selectBoxTemplate = '<option value="">--- All Years ---</option>';

        if(eventStatus == 'past'){
            for(let i = 0; i <= (currentYear - lowestYear); i++){
                selectBoxTemplate = selectBoxTemplate + 
                '<option value="' + (currentYear - i) + '">' + (currentYear - i) + '</option>';
            }
        }
        else {
            for(let i = highestYear; i >=  currentYear; i--){
                selectBoxTemplate = selectBoxTemplate + 
                '<option value="' + (i) + '">' + (i) + '</option>';
            }
        }

        chooseYear.innerHTML = selectBoxTemplate;

        selectContainer.appendChild(chooseYear);

        initiateSelectYear();
    }


    function searchFunction(){
        if(loadedEventType === 'all'){
            getAll();
        }
        else {
            getEvents();
        }
    }

    function changeStatus(newStatus){
        removeActiveClass(eventStatus + '-events');
        searchKey = '';

        var option = document.getElementById(newStatus + '-events');
        option.setAttribute('class', 'active');

        eventStatus = newStatus;

        toAll();
        cleanSelectBox();
    }

    function toAll(){
        // searchKey = '';

        getAll();
    }

    function getAll(){
        loadedEventType = 'all';

        removeCategoriesActiveClass();

        removeActiveClass('all-option');

        cleanEvents();
        cleanPagination();
        cleanSearchMessage();

        let targetUrl = '';

        if(searchKey.length > 0) {
            targetUrl = 'https://' + window.location.hostname + '/event/' + eventStatus + '/' + loadedEventType + '?keyword=' + searchKey + '&page=1';
        }
        else {
            targetUrl = 'https://' + window.location.hostname + '/event/' + eventStatus + '/' + loadedEventType + '?page=1';
        }

        showLoader();

        $.ajax({
            type: 'GET',
            url: targetUrl,
            dataType: 'JSON',
            success: function (data) {
                setTimeout(function(){
                    prepareEvents(data);
                    preparePagination(data);
                    prepareSearchMessage(data);

                    hideLoader();
                }, 1000);
            }
        });

        var allOption = document.getElementById('all-option');
        allOption.setAttribute('class', 'active');
    }

    function goToPage(pageNumber){
        cleanEvents();
        cleanPagination();
        cleanSearchMessage();

        let targetUrl = '';

        if(loadedEventType === 'all') {
            if(searchKey.length > 0) {
                targetUrl = 'https://' + window.location.hostname + '/event/' + eventStatus + '/' + loadedEventType + '?keyword=' + searchKey + '&page=' + pageNumber;
            }
            else {
                targetUrl = 'https://' + window.location.hostname + '/event/' + eventStatus + '/' + loadedEventType + '?page=' + pageNumber;
            } 
        }
        else {
            if(searchKey.length > 0) {
                targetUrl = 'https://' + window.location.hostname + '/event/' + eventStatus + '/' + loadedEventType + '/' + categoryIdTemp + '?keyword=' + searchKey + '&page=' + pageNumber;
            }
            else {
                targetUrl = 'https://' + window.location.hostname + '/event/' + eventStatus + '/' + loadedEventType + '/' + categoryIdTemp + '?page=' + pageNumber;
            }
        }

        showLoader();

        $.ajax({
            type: 'GET',
            url: targetUrl,
            dataType: 'JSON',
            success: function (data) {
                setTimeout(function(){
                    prepareEvents(data);
                    preparePagination(data);
                    prepareSearchMessage(data);

                    hideLoader();
                }, 1000);
            }
        });
    }

    function setCategories(newCategoryId, newCategoryListOrder){
        categoryId = newCategoryId;
        categoryListOrder = newCategoryListOrder;

        // searchKey = '';
        removeCategoriesActiveClass();

        var option = document.getElementById('category-' + categoryListOrder);
        option.setAttribute('class', 'active');

        getEvents();
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

    function getEvents() {
        loadedEventType = 'category';

        var option = document.getElementById('category-' + categoryListOrder);
        option.setAttribute('class', 'active');

        cleanEvents();
        cleanPagination();
        cleanSearchMessage();

        let targetUrl = '';

        if(searchKey.length > 0){
            targetUrl = 'https://' + window.location.hostname + '/event/' + eventStatus + '/' + loadedEventType +  '/' + parseInt(categoryId) + '?keyword=' + searchKey + '&page=1';
        }
        else {
            targetUrl = 'https://' + window.location.hostname + '/event/' + eventStatus + '/' + loadedEventType +  '/' + parseInt(categoryId) + '?page=1';
        };

        showLoader();

        $.ajax({
            type: 'GET',
            url: targetUrl,
            dataType: 'JSON',
            success: function (data) {
                setTimeout(function(){
                    prepareEvents(data);
                    preparePagination(data);
                    prepareSearchMessage(data);

                    categoryIdTemp = categoryId;

                    hideLoader();
                }, 1000);
            }
        });
    }

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

    function cleanSearchMessage(){
        var searchMessage = document.getElementById('search-message');
        searchMessage.setAttribute('class', 'text-center fade-out');

        setTimeout(function(){
            searchMessage.parentNode.removeChild(searchMessage);
        }, 100);
    }

    function prepareSearchMessage(array){
        var searchMessageWrapper = document.getElementById('search-message-wrapper');
        var searchMessage = document.createElement('h4');
        searchMessage.setAttribute('id', 'search-message');
        searchMessage.setAttribute('class', 'text-center fade-in');

        if(searchKey.length > 0){
            searchMessage.innerHTML = array.total > 0 
            ? 'displaying <strong>' + array.total + '</strong> results using the keyword of <strong>"' + searchKey + '"</strong>.'
            : '';
        }
        else {
            searchMessage.innerHTML = '';
        }

        setTimeout(function(){
            searchMessageWrapper.appendChild(searchMessage);
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
                '       </a>' + 
                '   </div>' + 
                '   <div class="col-md-6 col-sm-12 col-xs-12 event-content">' +
                '       <div class="post-date">' +
                '           <span>' + event.dayDate + '</span>' + 
                '           <span>' + event.month + '</span>' + 
                '           <span>' + event.year + '</span>' + 
                '       </div>' +
                '       <h3>' +
                '           <a href="/event/single/' +event.id+ '" title="' +event.title+ '">' + 
                '           ' + event.title +
                '           </a>' +
                '       </h3>' +
                '       <h4 class="organiser">' +
                '           <a class="p-0" href="/event/single/' + event.id + '">';

                if(event.organiser !== null){
                eventContent = eventContent + 
                '               <span class="organiser-by">by</span>' + event.organiser;}

                eventContent = eventContent + 
                '           </a>' +
                '       </h4>' +
                '       <h4>' +
                '           <a href="/event/single/' + event.id + '" title="London">' +
                '               <i class="fa fa-map-marker"></i>' + event.location + ', ' + event.address +
                '           </a>' +
                '           <br>' +
                '           <a class="mt-2" href="' + event.id + '">' +
                '               <i class="fa fa-clock-o"></i>' + 
                '               ' + event.day +
                '           </a>' +
                '       </h4>' +
                '       <p>' + nl2br(event.content) + '</p>' +
                '       <a href="/event/single/' + event.id + '" title="Read More">Read More</a>' +
                '   </div>' + 
                '</div>';
            }, eventContent);
        }
        else {
            eventContent = searchKey.length > 0
            ? eventContent + 
                '<h3 class="text-center" style="color: lightgrey">' + "we couldn't find anything for " + '<strong style="color: darkgrey">"' + searchKey + '"</strong>.</h3>'
            : eventContent + eventContent + 
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

    initiateSelectYear();
</script>
@endpush