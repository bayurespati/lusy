@extends('layouts.admin_master')

@push('title')
	<title>Admin-Gallery-Subcategories</title>
@endpush

@push('additional_css')
<link href="{{ asset('css/animation.css') }}" rel="stylesheet">
@endpush

@section('content')
	<div id="subcategories" class="container">
		<h3>Gallery's Subcategories Master</h3>

		<p class="m-0">
			This is where you can customise subcategories of categories used in Gallery page.
		</p>
		<p>
			(caution: deleting a subcategory will also deletes items that belong to that subcategory).
		</p>
		
		<subcategories> </subcategories>
		<flash> </flash>
	</div>		
@endsection

@push('additional_js')
	<script src="{{ asset('js/admin/gallery/subcategories.js') }}"></script>
@endpush