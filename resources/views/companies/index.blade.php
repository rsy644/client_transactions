<!--view code-->

@extends('layouts.admin')
@section('content')
@if (!Auth::guest()) <!--if user has registered and logged in-->

	<div class="table-container">

		<h2>Companies</h2>

		<a class="create success button" href="{!! route('companies.create') !!}">Add</a><br/><br/>			

		@if(count($companies) > 0)

	  		@foreach ($companies as $company)

	  			<a href="{{ route('companies.show', $company->id) }}">{{ $company->name }}</a><br />
			@endforeach

		@else
			<p>No companies to show!</p>

		@endif
			
	</div>

@endif

@endsection


