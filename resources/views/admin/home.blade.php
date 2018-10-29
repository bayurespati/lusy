@extends('layouts.admin')

@push('title')
	<title>Home</title>
@endpush

@push('additional_css')
<link href="{{ asset('css/animation.css') }}" rel="stylesheet">
@endpush

@section('content')
	<div id="home">
		<home> </home>
	</div>		
@endsection

@push('additional_js')
	<script src="{{ asset('js/admin/home.js') }}"></script>
@endpush