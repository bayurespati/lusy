@extends('layouts.master')

@push('title')
<title>Lusy Wahyudi - Shop</title>
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

            @if(count($items) > 0)
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
                    <div id="item-group" class="row">
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
                    </div>

                    <div id="divider-40" class="padding-40"></div>

                    <nav id="items-pagination" class="ow-pagination text-center">
                        @if ($items->lastPage() > 1)
                        <ul class="pagination">
                            <li class="{{ ($items->currentPage() == 1) ? ' disabled' : '' }}">
                                <a href="#menu-container" onClick="goToPage(1)"><i class="fa fa-angle-double-left"></i></a>
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
                                    <a href="#menu-container" onClick="goToPage({{ $i }})">{{ $i }}</a>
                                </li>
                            @endif
                            @endfor
                            <li class="{{ $items->currentPage() == $items->lastPage() ? ' disabled' : '' }}">
                                <a href="#menu-container" onClick="goToPage({{ $items->lastPage() }})"><i class="fa fa-angle-double-right"></i></a>
                            </li>
                        </ul>
                        @endif
                    </nav>

                    <div id="divider-20" class="padding-20"></div>
                </div>
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
         if(loadedImageType === 'all'){
            $.ajax({
                type: 'GET',
                url: 'https://' + window.location.hostname + '/shop/' + loadedImageType + '?page=' + pageNumber,
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
                url: 'https://' + window.location.hostname + '/shop/' + loadedImageType + '/' + idTemp + '?page=' + pageNumber,
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

    function getAll(){
        loadedImageType = 'all';

        removeCategoriesActiveClass();

        removeActiveClass('all-option');
        
        if(submenuExist) {
            removeSubcategory();
        }

        $.ajax({
            type: 'GET',
            url: 'https://' + window.location.hostname + '/shop/all?page=1',
            dataType: 'JSON',
            success: function (data) {
                cleanItems();
                prepareItems(data);

                cleanPagination();
                preparePagination(data);
                idTemp = 0;
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

        $.ajax({
            type: 'GET',
            url: 'https://' + window.location.hostname + '/shop/category/' + parseInt(categoryId) + '?page=1',
            dataType: 'JSON',
            success: function (data) {
                cleanItems();
                prepareItems(data);

                cleanPagination();
                preparePagination(data);
                idTemp = categoryId;
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

        $.ajax({
            type: 'GET',
            url: 'https://' + window.location.hostname + '/shop/subcategory/' + parseInt(subcategoryId) + '?page=1',
            dataType: 'JSON',
            success: function (data) {
                cleanItems();
                prepareItems(data);

                cleanPagination();
                preparePagination(data);
                idTemp = subcategoryId;
            }
        });
    }

    function removeSubcategoriesActiveClass(){
        for (var i = 0; i < subcategoryCount; i++) {
            removeActiveClass('subcategory-' + i);
        };
        subCategoryChosen = false;
    };

    function cleanItems(){
        var itemGroup = document.getElementById('item-group');

        itemGroup.parentNode.removeChild(itemGroup);
    }

    function cleanPagination(){
        var itemsPagination = document.getElementById('items-pagination');

        itemsPagination.parentNode.removeChild(itemsPagination);
    }

    function prepareItems(array){
        var parentOfDivider40 = document.getElementById('items-container');
        var divider40 = document.getElementById('divider-40');
        var itemGroup = document.createElement('div');
        itemGroup.setAttribute('id', 'item-group');
        itemGroup.setAttribute('class', 'row');

        let itemGroupContent = '';

        array.data.forEach(function(item){
            itemGroupContent = itemGroupContent + 
            '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 shop-item-wrapper">' +
            '   <a href="/shop/item/' + item.id + '">' +
            '       <div class="shop-item">' + 
            '          <div class="item-pic-frame">' + 
            '               <img class="item-pic" src="' + item.poster + '" alt="' + item.title + '" title="' + item.title + '">' +
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

        itemGroup.innerHTML = itemGroupContent;
        setTimeout(function(){
            parentOfDivider40.insertBefore(itemGroup, divider40);
        }, 100);
    }

    function preparePagination(data){
        var parentOfDivider20 = document.getElementById('items-container');
        var divider20 = document.getElementById('divider-20');
        var paginationContainer = document.createElement('nav');
        paginationContainer.setAttribute('id', 'items-pagination');
        paginationContainer.setAttribute('class', 'ow-pagination text-center');

        let paginationContent = '';

        if(data.last_page !== 1){
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
        }

        paginationContainer.innerHTML = paginationContent;
        setTimeout(function(){
            parentOfDivider20.insertBefore(paginationContainer, divider20);
        }, 100);
    }
</script>
@endpush