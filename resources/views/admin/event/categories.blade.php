@extends('layouts.admin_master')

@push('title')
	<title>Admin-Event-Category</title>
@endpush

@push('additional_css')
<link href="{{ asset('css/animation.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="wrapper" id="categories">

	<!-- SIDE BAR  -->
	<side-bar></side-bar>

	<!-- Page Content  -->
    <div id="content">
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fa fa-align-left"></i>
                    <span>Toggle Sidebar</span>
                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link" href="#" role="button" 
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{ Auth::user()->name }} 
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
		
		<div class="container">
	        <h3>Shop's Subcategories Master</h3>

			<p class="m-0">
				This is where you can customise categories used in Shop page.
			</p>
			<p>
				(caution: deleting a category will also deletes subcategories and items that belong to that category).
			</p>

	        <categories> </categories>
	        <flash> </flash>
        </div>
    </div>
</div>
@endsection

@push('additional_js')
	<script src="{{ asset('js/admin/event/categories.js') }}"></script>
@endpush