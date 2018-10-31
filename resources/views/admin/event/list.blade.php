@extends('layouts.admin_master')

@push('title')
	<title>Admin-Event-List</title>
@endpush

@push('additional_css')
<link href="{{ asset('css/animation.css') }}" rel="stylesheet">
@endpush

@section('content')
	<div id="events">
		<events> </events>
		<flash> </flash>
	</div>		
@endsection

@push('additional_js')
	<script src="{{ asset('js/admin/event/list.js') }}"></script>
@endpush