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
            <div class="container-fluid no-padding page-banner">
                <!-- Container -->
                <div class="container">
                    <h3>Shop</h3>
                </div>
                <!-- Container /- -->
            </div>
            <!-- Page Banner /- -->

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
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 shop-item-wrapper">
                            <a href="shop/item">
                                <div class="shop-item">
                                    <div class="item-pic-frame">
                                        <img class="item-pic" src="{{ asset('img/shop-item.gif') }}" alt="Bows by Lusy Wahyudi" title="Bows by Lusy Wahyudi">
                                    </div>

                                    <div class="item-details">
                                        <p class="item-description" href="#">Bows</p>
                                        <p class="item-price">Rp 399.000</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 shop-item-wrapper">
                            <a href="shop/item">
                                <div class="shop-item">
                                    <div class="item-pic-frame">
                                        <img class="item-pic" src="{{ asset('img/shop-item.gif') }}" alt="Bows by Lusy Wahyudi" title="Bows by Lusy Wahyudi">
                                    </div>

                                    <div class="item-details">
                                        <p class="item-description" href="#">Bows</p>
                                        <p class="item-price">Rp 399.000</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 shop-item-wrapper">
                            <a href="shop/item">
                                <div class="shop-item">
                                    <div class="item-pic-frame">
                                        <img class="item-pic" src="{{ asset('img/shop-item.gif') }}" alt="Bows by Lusy Wahyudi" title="Bows by Lusy Wahyudi">
                                    </div>

                                    <div class="item-details">
                                        <p class="item-description" href="#">Bows</p>
                                        <p class="item-price">Rp 399.000</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 shop-item-wrapper">
                            <a href="shop/item">
                                <div class="shop-item">
                                    <div class="item-pic-frame">
                                        <img class="item-pic" src="{{ asset('img/shop-item.gif') }}" alt="Bows by Lusy Wahyudi" title="Bows by Lusy Wahyudi">
                                    </div>

                                    <div class="item-details">
                                        <p class="item-description" href="#">Bows</p>
                                        <p class="item-price">Rp 399.000</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 shop-item-wrapper">
                            <a href="shop/item">
                                <div class="shop-item">
                                    <div class="item-pic-frame">
                                        <img class="item-pic" src="{{ asset('img/shop-item.gif') }}" alt="Bows by Lusy Wahyudi" title="Bows by Lusy Wahyudi">
                                    </div>

                                    <div class="item-details">
                                        <p class="item-description" href="#">Bows</p>
                                        <p class="item-price">Rp 399.000</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 shop-item-wrapper">
                            <a href="shop/item">
                                <div class="shop-item">
                                    <div class="item-pic-frame">
                                        <img class="item-pic" src="{{ asset('img/shop-item.gif') }}" alt="Bows by Lusy Wahyudi" title="Bows by Lusy Wahyudi">
                                    </div>

                                    <div class="item-details">
                                        <p class="item-description" href="#">Bows</p>
                                        <p class="item-price">Rp 399.000</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 shop-item-wrapper">
                            <a href="shop/item">
                                <div class="shop-item">
                                    <div class="item-pic-frame">
                                        <img class="item-pic" src="{{ asset('img/shop-item.gif') }}" alt="Bows by Lusy Wahyudi" title="Bows by Lusy Wahyudi">
                                    </div>

                                    <div class="item-details">
                                        <p class="item-description" href="#">Bows</p>
                                        <p class="item-price">Rp 399.000</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 shop-item-wrapper">
                            <a href="shop/item">
                                <div class="shop-item">
                                    <div class="item-pic-frame">
                                        <img class="item-pic" src="{{ asset('img/shop-item.gif') }}" alt="Bows by Lusy Wahyudi" title="Bows by Lusy Wahyudi">
                                    </div>

                                    <div class="item-details">
                                        <p class="item-description" href="#">Bows</p>
                                        <p class="item-price">Rp 399.000</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="padding-40"></div>

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
            </div>
            <!-- End of Shop Items - /-->

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

    function getAll(){
        removeCategoriesActiveClass();

        removeActiveClass('all-option');
        
        if(submenuExist) {
            removeSubcategory();
        }

        $.ajax({
            type: 'GET',
            url: 'https://' + window.location.hostname + '/shop/all',
            dataType: 'JSON',
            success: function (data) {

                prepareItems(data);
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
        $.ajax({
            type: 'GET',
            url: 'https://' + window.location.hostname + '/shop/category/' + parseInt(categoryId) + '/items',
            dataType: 'JSON',
            success: function (data) {

                prepareItems(data);
            }
        });
    }

    function getSubcategoryItems(subcategoryId, subcategoryListOrder) {
        if(subCategoryChosen){
            removeSubcategoriesActiveClass();
        }

        var option = document.getElementById('subcategory-' + subcategoryListOrder);
        option.setAttribute('class', 'active');
        subCategoryChosen = true;

        $.ajax({
            type: 'GET',
            url: 'https://' + window.location.hostname + '/shop/subcategory/' + parseInt(subcategoryId) + '/items',
            dataType: 'JSON',
            success: function (data) {

                prepareItems(data);
            }
        });
    }

    function removeSubcategoriesActiveClass(){
        for (var i = 0; i < subcategoryCount; i++) {
            removeActiveClass('subcategory-' + i);
        };
        subCategoryChosen = false;
    };

    function prepareItems(data){

    }
</script>
@endpush