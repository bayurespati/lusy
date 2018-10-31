@extends('layouts.admin_master')

@push('title')
	<title>Sosmed</title>
@endpush

@push('additional_css')
<link href="{{ asset('css/animation.css') }}" rel="stylesheet">
@endpush

@section('content')
	<div id="sosmed">
		<sosmed> </sosmed>
		<flash> </flash>
	</div>		
@endsection

@push('additional_js')
	<script src="{{ asset('js/admin/sosmed.js') }}"></script>
@endpush