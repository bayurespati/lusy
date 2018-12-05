@extends('layouts.master')

@push('title')
<title>Lusy Wahyudi - Gallery</title>
@endpush

@push('additional_css')
<link href="{{ asset('css/animation.css') }}" rel="stylesheet">

<style type="text/css">
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
            style="background-image: url({{ $galleryBanner }});">
                <!-- Container -->
                <div class="container">
                    <h3>Gallery</h3>
                </div>
                <!-- Container /- -->
            </div>
            <!-- Page Banner /- -->
        
            <!-- Portfolio Section -->
            <div class="container-fluid no-padding portfolio-section">
                @if(count($gallery) > 0)
                <div id="menu-container" class="container">
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

                <div id="search-message-wrapper">
                    <h4 id="search-message" class="text-center fade-in"></h4>
                </div>

                <div id="gallery-container-wrapper">
                    <div id="gallery-container" class="portfolio-list zoom-in">
                        @foreach($sortedGallery as $photo)
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
                                    <span>{{ $photo->creator }}</span>
                                    <span>{{ $photo->location }}</span>
                                    <span>{{ $photo->date }}</span>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div id="divider-80" class="padding-80"></div>

                <nav id="gallery-pagination" class="ow-pagination text-center fade-in">
                    <ul id="pagination-list" class="pagination">
                        <li class="{{ ($gallery->currentPage() == 1) ? ' disabled' : '' }}">
                            <a onClick="goToPage(1)"><i class="fa fa-angle-double-left"></i></a>
                        </li>
                    
                        @for ($i = 1; $i <= $gallery->lastPage(); $i++)
                            <?php
                            $half_total_links = floor(4 / 2);
                            $from = $gallery->currentPage() - $half_total_links;
                            $to = $gallery->currentPage() + $half_total_links;

                            if ($gallery->currentPage() < $half_total_links) {
                                $to += $half_total_links - $gallery->currentPage();
                            }
                            if ($gallery->lastPage() - $gallery->currentPage() < $half_total_links) {
                                $from -= $half_total_links - ($gallery->lastPage() - $gallery->currentPage() - 1);
                            }
                            ?>
                            
                            @if ($from < $i && $i < $to)
                            <li class="{{ ($gallery->currentPage() == $i) ? ' active' : '' }}">
                                <a onClick="goToPage({{ $i }})">{{ $i }}</a>
                            </li>
                            @endif
                        @endfor
                        <li class="{{ $gallery->currentPage() == $gallery->lastPage() ? ' disabled' : '' }}">
                            <a onClick="goToPage({{ $gallery->lastPage() }})"><i class="fa fa-angle-double-right"></i></a>
                        </li>
                    </ul>
                </nav>
                @else
                <h3 class="text-center" style="color: lightgrey">
                    *this gallery isn't filled with images (yet!)*
                </h3>
                @endif
            </div>
            <!-- Portfolio Section /- -->
            
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
    let showedImages = {!! json_encode($gallery) !!};
    let categoryCount = {!! $categories !!}.length;
    let subcategoryCount = 0;
    let submenuExist = false;
    let subCategoryChosen = false;
    let loadedImageType = 'all';
    let subcategoryIdTemp = 0;
    let searchKey = '';
    let subcategoryId = -1;
    let subcategoryListOrder = -1;

    function searchFunction(){
        searchKey = document.getElementById("search-key").value.trim();

        if(loadedImageType === 'all'){
            getAll();
        }
        else {
            getImages();
        }
    }

    function toAll(){
        searchKey = '';

        getAll();
    }

    function getAll(){
        loadedImageType = 'all';
        subcategoryId = -1;
        subcategoryListOrder = -1;

        removeCategoriesActiveClass();

        removeActiveClass('all-option');
        
        if(submenuExist) {
            removeSubcategory();
        }

        cleanImages();
        cleanPagination();
        cleanSearchMessage();

        let targetUrl = '';

        if(searchKey.length > 0) {
            targetUrl = 'https://' + window.location.hostname + '/gallery/' + loadedImageType + '?keyword=' + searchKey + '&page=1';
        }
        else {
            targetUrl = 'https://' + window.location.hostname + '/gallery/' + loadedImageType + '?page=1';
        }

        showLoader();

        $.ajax({
            type: 'GET',
            url: targetUrl,
            dataType: 'JSON',
            success: function (data) {
                setTimeout(function(){
                    prepareImages(data);
                    preparePagination(data);
                    prepareSearchMessage(data);

                    hideLoader();
                    subcategoryIdTemp = 0;
                }, 1000);
            }
        });

        var allOption = document.getElementById('all-option');
        allOption.setAttribute('class', 'active');
    }

    function goToPage(pageNumber){
        cleanImages();
        cleanPagination();
        cleanSearchMessage();

        let targetUrl = '';

        if(loadedImageType === 'all') {
            if(searchKey.length > 0) {
                targetUrl = 'https://' + window.location.hostname + '/gallery/' + loadedImageType + '?keyword=' + searchKey + '&page=' + pageNumber;
            }
            else {
                targetUrl = 'https://' + window.location.hostname + '/gallery/' + loadedImageType + '?page=' + pageNumber;
            } 
        }
        else {
            if(searchKey.length > 0) {
                targetUrl = 'https://' + window.location.hostname + '/gallery/' + loadedImageType + '/' + subcategoryIdTemp + '?keyword=' + searchKey + '&page=' + pageNumber;
            }
            else {
                targetUrl = 'https://' + window.location.hostname + '/gallery/' + loadedImageType + '/' + subcategoryIdTemp + '?page=' + pageNumber;
            }
        }

        showLoader();

        $.ajax({
            type: 'GET',
            url: targetUrl,
            dataType: 'JSON',
            success: function (data) {
                setTimeout(function(){
                    prepareImages(data);
                    preparePagination(data);
                    prepareSearchMessage(data);

                    hideLoader();
                }, 1000);
            }
        });
    }

    function setSubcategoryIdAndListOrder(newSubcategoryId, newSubcategoryListOrder){
        subcategoryId = newSubcategoryId;
        subcategoryListOrder = newSubcategoryListOrder;
        searchKey = '';

        getImages();
    }

    function getSubcategories(categoryId, categoryListOrder){
        searchKey = '';
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
        subcategoriesMenu.setAttribute('class', 'col-md-12 col-sm-12 col-xs-12 no-padding portfolio-categories fade-out');
        
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
            '   <a id="subcategory-' + i + '" onclick="setSubcategoryIdAndListOrder(' + prop.id + ', ' + i + ' )" style="cursor: pointer;">' + prop.title + '</a>' + 
            '</li>';

            subcategoryCount++;
        });

        unorderedList.innerHTML = lists;
        listWrapper.appendChild(unorderedList);
        submenuExist = true;
    }

    function getImages() {
        subcategoryId = subcategoryId;
        loadedImageType = 'subcategory';

        if(subCategoryChosen){
            removeSubcategoriesActiveClass();
        }

        var option = document.getElementById('subcategory-' + subcategoryListOrder);
        option.setAttribute('class', 'active');
        subCategoryChosen = true;

        cleanImages();
        cleanPagination();
        cleanSearchMessage();

        let targetUrl = '';

        if(searchKey.length > 0){
            targetUrl = 'https://' + window.location.hostname + '/gallery/' + loadedImageType +  '/' + parseInt(subcategoryId) + '?keyword=' + searchKey + '&page=1';
        }
        else {
            targetUrl = 'https://' + window.location.hostname + '/gallery/' + loadedImageType +  '/' + parseInt(subcategoryId) + '?page=1';
        };

        showLoader();

        $.ajax({
            type: 'GET',
            url: targetUrl,
            dataType: 'JSON',
            success: function (data) {
                setTimeout(function(){
                    prepareImages(data);
                    preparePagination(data);
                    prepareSearchMessage(data);

                    subcategoryIdTemp = subcategoryId;

                    hideLoader();
                }, 1000);
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
            searchMessage.innerHTML = array[0].total > 0 
            ? 'displaying <strong>' + array[0].total + '</strong> results using the keyword of <strong>"' + searchKey + '"</strong>.'
            : '';
        }
        else {
            searchMessage.innerHTML = '';
        }

        setTimeout(function(){
            searchMessageWrapper.appendChild(searchMessage);
        }, 100);
    }

    function prepareImages(array){
        var galleryContainerWrapper = document.getElementById('gallery-container-wrapper');
        var galleryContainer = document.createElement('div');
        galleryContainer.setAttribute('id', 'gallery-container');
        galleryContainer.setAttribute('class', 'portfolio-list zoom-in');

        let galleryContent = '';

        if(array[1].length > 0){
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
                '           <span>' + photo.creator + '</span>' +
                '           <span>' + photo.location + '</span>' +
                '           <span>' + photo.date + '</span>' +
                '       </div>' +
                '   </a>' +
                '</div>'
            }, galleryContent);
        }
        else {
            galleryContent = searchKey.length > 0 
            ? galleryContent + 
                '<h3 class="text-center" style="color: lightgrey">' + 
                "we couldn't find anything for " + '<strong style="color: darkgrey">"' + searchKey + '"</strong>.' + 
                '</h3>'
            : galleryContent +
                '<h3 class="text-center" style="color: lightgrey">' +
                "   *there are no images on this classification yet*" +
                '</h3>';
        }

        galleryContainer.innerHTML = galleryContent;

        setTimeout(function(){
            galleryContainerWrapper.appendChild(galleryContainer);

            check();
        }, 100);
    }

    function preparePagination(data){
        var galleryPagination = document.getElementById('gallery-pagination');
        var paginationContainer = document.createElement('ul');
        paginationContainer.setAttribute('id', 'pagination-list');
        paginationContainer.setAttribute('class', 'pagination fade-in');

        let paginationContent = '';

        if(data[0].data.length > 0){
            paginationContent = '';

            if(data[0].current_page == 1) {
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
                    '       <a onClick="goToPage(' + i + ')">' + i + '</a>' + 
                    '   </li>';
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
            '       <a onClick="goToPage(' + data[0].last_page + ')">' + 
            '           <i class="fa fa-angle-double-right"></i>' + 
            '       </a>' + 
            '   </li>';
        }

        paginationContainer.innerHTML = paginationContent;
        setTimeout(function(){
            galleryPagination.appendChild(paginationContainer);
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