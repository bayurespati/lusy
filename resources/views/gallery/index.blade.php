@extends('layouts.master')

@push('title')
<title>Lusy Wahyudi - Gallery</title>
@endpush

@push('additional_css')
<link href="{{ asset('css/animation.css') }}" rel="stylesheet">
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
                    <h3>gallery</h3>
                </div>
                <!-- Container /- -->
            </div>
            <!-- Page Banner /- -->
        
            <!-- Portfolio Section -->
            <div class="container-fluid no-padding portfolio-section">
                <!-- Container -->
                @if(count($gallery) > 0)
                <div id="menu-container" class="container">
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
                <!-- Container /- -->
                <div id="gallery-container" class="portfolio-list">
                    @foreach($gallery as $photo)
                        <div class="portfolio-box col-md-3 col-sm-3 no-padding vintage">
                            <a href="{{ $photo->image_path }}">
                                <img src="{{ $photo->image_path }}" alt="{{ $photo->title }}" />

                                <div class="portfolio-content">
                                    <i class="icon icon-Search"></i>
                                    <h3>{{ $photo->title }}</h3>
                                    <span>{{ $photo->creator }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div id="divider-80" class="padding-80"></div>

                <nav id="gallery-pagination" class="ow-pagination text-center">
                    @if ($gallery->lastPage() > 1)
                    <ul class="pagination">
                        <li class="{{ ($gallery->currentPage() == 1) ? ' disabled' : '' }}">
                            <a href="#menu-container" onClick="goToPage(1)"><i class="fa fa-angle-double-left"></i></a>
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
                                <a href="#menu-container" onClick="goToPage({{ $i }})">{{ $i }}</a>
                            </li>
                            @endif
                        @endfor
                        <li class="{{ $gallery->currentPage() == $gallery->lastPage() ? ' disabled' : '' }}">
                            <a href="#menu-container" onClick="goToPage({{ $gallery->lastPage() }})"><i class="fa fa-angle-double-right"></i></a>
                        </li>
                    </ul>
                    @endif
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

    function getAll(){
        loadedImageType = 'all';

        removeCategoriesActiveClass();

        removeActiveClass('all-option');
        
        if(submenuExist) {
            removeSubcategory();
        }

        $.ajax({
            type: 'GET',
            url: 'https://' + window.location.hostname + '/gallery/' + loadedImageType + '?page=1',
            dataType: 'JSON',
            success: function (data) {
                cleanImages();
                prepareImages(data);

                cleanPagination();
                preparePagination(data);
                subcategoryIdTemp = 0;
            }
        });

        var allOption = document.getElementById('all-option');
        allOption.setAttribute('class', 'active');
    }

    function goToPage(pageNumber){
         if(loadedImageType === 'all'){
            $.ajax({
                type: 'GET',
                url: 'https://' + window.location.hostname + '/gallery/' + loadedImageType + '?page=' + pageNumber,
                dataType: 'JSON',
                success: function (data) {
                    cleanImages();
                    prepareImages(data);

                    cleanPagination();
                    preparePagination(data);
                }
            });
         }
         else {
            $.ajax({
                type: 'GET',
                url: 'https://' + window.location.hostname + '/gallery/' + loadedImageType + '/' + subcategoryIdTemp + '?page=' + pageNumber,
                dataType: 'JSON',
                success: function (data) {
                    cleanImages();
                    prepareImages(data);

                    cleanPagination();
                    preparePagination(data);
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
            '   <a id="subcategory-' + i + '" onclick="getImages(' + prop.id + ', ' + i + ' )" style="cursor: pointer;">' + prop.title + '</a>' + 
            '</li>';

            subcategoryCount++;
        });

        unorderedList.innerHTML = lists;
        listWrapper.appendChild(unorderedList);
        submenuExist = true;

    }

    function getImages(subcategoryId, subcategoryListOrder) {
        loadedImageType = 'subcategory';

        if(subCategoryChosen){
            removeSubcategoriesActiveClass();
        }

        var option = document.getElementById('subcategory-' + subcategoryListOrder);
        option.setAttribute('class', 'active');
        subCategoryChosen = true;

        $.ajax({
            type: 'GET',
            url: 'https://' + window.location.hostname + '/gallery/' + loadedImageType +  '/' + parseInt(subcategoryId) + '?page=1',
            dataType: 'JSON',
            success: function (data) {
                cleanImages();
                prepareImages(data);

                cleanPagination();
                preparePagination(data);
                subcategoryIdTemp = subcategoryId;
            }
        });
    }

    function removeSubcategoriesActiveClass(){
        for (var i = 0; i < subcategoryCount; i++) {
            removeActiveClass('subcategory-' + i);
        };
        subCategoryChosen = false;
    };

    function cleanImages(){
        var galleryContainer = document.getElementById('gallery-container');

        galleryContainer.parentNode.removeChild(galleryContainer);
    }

    function cleanPagination(){
        var galleryPagination = document.getElementById('gallery-pagination');

        galleryPagination.parentNode.removeChild(galleryPagination);
    }

    function prepareImages(array){
        var parentOfDivider80 = document.getElementById('divider-80').parentNode;
        var divider80 = document.getElementById('divider-80');
        var galleryContainer = document.createElement('div');
        galleryContainer.setAttribute('id', 'gallery-container');
        galleryContainer.setAttribute('class', 'portfolio-list');

        let galleryContent = '';

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

        galleryContainer.innerHTML = galleryContent;
        setTimeout(function(){
            parentOfDivider80.insertBefore(galleryContainer, divider80);

            check();
        }, 100);
    }

    function preparePagination(data){
        var parentOfSectionPadding = document.getElementById('section-padding').parentNode;
        var sectionPadding = document.getElementById('section-padding');
        var paginationContainer = document.createElement('nav');
        paginationContainer.setAttribute('id', 'gallery-pagination');
        paginationContainer.setAttribute('class', 'ow-pagination text-center');

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
        '       <a href="#menu-container" onClick="goToPage(1)">' +
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
                '   <a href="#menu-container" onClick="goToPage(' + i + ')">' + i + '</a>' + 
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
        '       <a href="#menu-container" onClick="goToPage(' + data.last_page + ')">' + 
        '           <i class="fa fa-angle-double-right"></i>' + 
        '       </a>' + 
        '   </li>' + 
        '</ul>';

        paginationContainer.innerHTML = paginationContent;
        setTimeout(function(){
            parentOfSectionPadding.insertBefore(paginationContainer, sectionPadding);
        }, 100);
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