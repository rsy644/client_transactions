@extends('layouts.admin')
@section('content')

	@if (!Auth::guest()) <!--if user has registered and logged in-->

	<div class="table-container">

		<h2>Edit a Company</h2>

		<form method="POST" role="form" enctype="multipart form-data" action="{{route('companies.store') }}">
		@csrf
			<input type="hidden" name="update" value="1">
			<input type="hidden" name="company_id" value="{{ $company->id }}">
			<div class="form-input">
				<label for="name">Name</label>
				<input id="name" name="name" class="name" value="{{ $company->name }}">

			</div>
			<div class="form-input">
				<label for="email">Email</label>
				<input id="email" name="email" class="email" value="{{ $company->email }}">

			</div>
			<div class="form-input">
				<label for="logo">Logo</label>
				<input id="logo" name="logo" class="logo" value="{{ $company->logo }}">

			</div>
			<div class="form-input">
				<label for="website">Website</label>
				<input id="website" name="website" class="website" value="{{ $company->website }}">
			</div>

			<input type="submit" class="btn btn-success submit" value="Update">

		</form>
			
	</div>

	@endif

@endsection