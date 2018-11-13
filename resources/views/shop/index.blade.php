@extends('layouts.master')

@push('title')
<title>Lusy Wahyudi - Shop</title>
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
            style="background-image: url({{ $shopBanner }});">
                <!-- Container -->
                <div class="container">
                    <h3>Shop</h3>
                </div>
                <!-- Container /- -->
            </div>
            <!-- Page Banner /- -->

            @if($isItemsExist)
            <div id="menu-container" class="container" style="padding-top: 150px">
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

            <!-- Shop Items /- -->
            <div class="container-fluid no-padding shop-items-section">
                <div id="items-container" class="container">
                    <div id="item-group" class="row zoom-in">
                        @if(count($items) > 0)
                        @foreach($items as $item)
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 shop-item-wrapper">
                            <a href="/shop/item/{{ $item->id }}">
                                <div class="shop-item">
                                    <div class="item-pic-frame">
                                        <img class="item-pic" src="{{ $item->poster }}" alt="{{ $item->title }}" title="{{ $item->title }}">
                                    </div>

                                    <div class="item-details">
                                        <p class="item-description" href="#">{{ $item->title }}</p>
                                        <p class="item-price">IDR {{ $item->price }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                        @else
                        <h3 class="text-center" style="color: lightgrey">
                            There are no items on this classification yet.
                        </h3>
                        @endif
                    </div>
                </div>

                <div id="divider-40" class="padding-40"></div>

                <nav id="items-pagination" class="ow-pagination text-center fade-in">
                    @if (count($items) > 0)
                    <ul id="pagination-list" class="pagination">
                        <li class="{{ ($items->currentPage() == 1) ? ' disabled' : '' }}">
                            <a onClick="goToPage(1)"><i class="fa fa-angle-double-left"></i></a>
                        </li>

                        @for ($i = 1; $i <= $items->lastPage(); $i++)
                        <?php
                        $half_total_links = floor(4 / 2);
                        $from = $items->currentPage() - $half_total_links;
                        $to = $items->currentPage() + $half_total_links;

                        if ($items->currentPage() < $half_total_links) {
                            $to += $half_total_links - $items->currentPage();
                        }
                        if ($items->lastPage() - $items->currentPage() < $half_total_links) {
                            $from -= $half_total_links - ($items->lastPage() - $items->currentPage() - 1);
                        }
                        ?>

                        @if ($from < $i && $i < $to)
                        <li class="{{ ($items->currentPage() == $i) ? ' active' : '' }}">
                            <a onClick="goToPage({{ $i }})">{{ $i }}</a>
                        </li>
                        @endif
                        @endfor
                        <li class="{{ $items->currentPage() == $items->lastPage() ? ' disabled' : '' }}">
                            <a onClick="goToPage({{ $items->lastPage() }})"><i class="fa fa-angle-double-right"></i></a>
                        </li>
                    </ul>
                    @endif
                </nav>

                <div id="divider-20" class="padding-20"></div>
            </div>
            <!-- End of Shop Items - /-->
            @else
            <div class="section-padding"></div>
            <h3 class="text-center" style="color: lightgrey">
                *getting our items ready (wait for it!)*
            </h3>
            <div class="section-padding"></div>
            @endif

        </main>

        <!-- Footer Section -->
        @include('partials.footer')
        <!-- Footer Section /- -->
        
    </div>
</body>

@endsection

@push('additional_js')
<script type="text/javascript">
    const categoriesAndSubcategories = {!! json_encode($categories) !!}
    let categoryCount = {!! $categories !!}.length;
    let subcategoryCount = 0;
    let submenuExist = false;
    let subCategoryChosen = false;
    let loadedImageType = 'all';
    let idTemp = 0;

    function goToPage(pageNumber){
        cleanItems();
        cleanPagination();

        showLoader();

        if(loadedImageType === 'all'){
            $.ajax({
                type: 'GET',
                url: 'https://' + window.location.hostname + '/shop/' + loadedImageType + '?page=' + pageNumber,
                dataType: 'JSON',
                success: function (data) {
                    setTimeout(function(){
                        prepareItems(data);
                        preparePagination(data);

                        hideLoader();
                    }, 1000);
                }
            });
         }
         else {
            $.ajax({
                type: 'GET',
                url: 'https://' + window.location.hostname + '/shop/' + loadedImageType + '/' + idTemp + '?page=' + pageNumber,
                dataType: 'JSON',
                success: function (data) {
                    setTimeout(function(){
                        prepareItems(data);
                        preparePagination(data);

                        hideLoader();
                    }, 1000);
                }
            });
         }
    }

    function getAll(){
        loadedImageType = 'all';

        removeCategoriesActiveClass();

        removeActiveClass('all-option');
        
        if(submenuExist) {
            removeSubcategory();
        }

        cleanItems();
        cleanPagination();

        showLoader();

        $.ajax({
            type: 'GET',
            url: 'https://' + window.location.hostname + '/shop/all?page=1',
            dataType: 'JSON',
            success: function (data) {
                setTimeout(function(){
                    prepareItems(data);
                    preparePagination(data);

                    hideLoader();
                }, 1000);
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

        if(categoriesAndSubcategories[categoryIndex].subcategories.length > 0){
            prepareSubcategory(categoriesAndSubcategories[categoryIndex].subcategories);
        }
        else {
            getCategoryItems(categoryId);
        }
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
            lists = lists + '<li class="text-uppercase"><a id="subcategory-' + i + '" onclick="getSubcategoryItems(' + prop.id + ', ' + i + ' )" style="cursor: pointer;">' + prop.title + '</a></li>';

            subcategoryCount++;
        });

        unorderedList.innerHTML = lists;
        listWrapper.appendChild(unorderedList);
        submenuExist = true;

    }

    function getCategoryItems(categoryId){
        loadedImageType = 'category';

        cleanItems();
        cleanPagination();

        showLoader();

        $.ajax({
            type: 'GET',
            url: 'https://' + window.location.hostname + '/shop/category/' + parseInt(categoryId) + '?page=1',
            dataType: 'JSON',
            success: function (data) {
                setTimeout(function(){
                    prepareItems(data);
                    preparePagination(data);

                    hideLoader();
                    idTemp = categoryId;
                }, 1000);
            }
        });
    }

    function getSubcategoryItems(subcategoryId, subcategoryListOrder) {
        loadedImageType = 'subcategory';

        if(subCategoryChosen){
            removeSubcategoriesActiveClass();
        }

        var option = document.getElementById('subcategory-' + subcategoryListOrder);
        option.setAttribute('class', 'active');
        subCategoryChosen = true;

        cleanItems();
        cleanPagination();

        showLoader();

        $.ajax({
            type: 'GET',
            url: 'https://' + window.location.hostname + '/shop/subcategory/' + parseInt(subcategoryId) + '?page=1',
            dataType: 'JSON',
            success: function (data) {
                setTimeout(function(){
                    prepareItems(data);
                    preparePagination(data);

                    hideLoader();
                    idTemp = subcategoryId;
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

    function cleanItems(){
        var itemGroup = document.getElementById('item-group');
        itemGroup.setAttribute('class', 'row fade-out');

        setTimeout(function(){
            itemGroup.parentNode.removeChild(itemGroup);
        }, 100);
    }

    function cleanPagination(){
        var paginationList = document.getElementById('pagination-list');
        paginationList.setAttribute('class', 'pagination fade-out');

        setTimeout(function(){
            paginationList.parentNode.removeChild(paginationList);
        }, 100);
    }

    function prepareItems(array){
        var itemsContainer = document.getElementById('items-container');
        var itemGroup = document.createElement('div');
        itemGroup.setAttribute('id', 'item-group');
        itemGroup.setAttribute('class', 'row zoom-in');

        let itemGroupContent = '';

        if(array.data.length > 0){
            array.data.forEach(function(item){
                itemGroupContent = itemGroupContent + 
                '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 shop-item-wrapper">' +
                '   <a href="/shop/item/' + item.id + '">' +
                '       <div class="shop-item">' + 
                '          <div class="item-pic-frame">' + 
                '               <img class="item-pic" src="' +item.poster+ '" alt="' +item.title+ '" title="' +item.title+ '">' +
                '          </div>' + 
                '          <div class="item-details">' +
                '              <p class="item-description" href="/shop/item/' + item.id + '">' + 
                '                  ' + item.title + 
                '              </p>' +
                '              <p class="item-price">IDR ' + item.price + '</p>' +
                '          </div>' +
                '       </div>' +
                '   </a>' +
                '</div>'
            }, itemGroupContent);
        }
        else{
            itemGroupContent = itemGroupContent + 
            '<h3 class="text-center" style="color: lightgrey">There are no items on this classification yet.</h3>';
        }

        itemGroup.innerHTML = itemGroupContent;
        setTimeout(function(){
            itemsContainer.appendChild(itemGroup);
        }, 100);
    }

    function preparePagination(data){
        var itemsPagination = document.getElementById('items-pagination');
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
            itemsPagination.appendChild(paginationList);
        }, 120);
    }
</script>
@endpush