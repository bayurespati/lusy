@extends('layouts.admin_master')

@push('title')
	<title>Admin-About-Classes</title>
@endpush

@push('additional_css')
<link href="{{ asset('css/animation.css') }}" rel="stylesheet">
@endpush

@section('content')
	<div id="classes">
		<classes> </classes>
		<flash> </flash>
	</div>		
@endsection

@push('additional_js')
	<script src="{{ asset('js/admin/about/classes.js') }}"></script>
@endpush