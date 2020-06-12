@extends('layouts.admin')
@section('content')

	@if (!Auth::guest()) <!--if user has registered and logged in-->

	<div class="table-container">

		<h2>Add a Company</h2>

		<form method="POST" role="form" enctype="multipart form-data" action="{{route('companies.store') }}">
		@csrf

			<div class="form-input">
				<label for="name">Name</label>
				<input id="name" name="name" class="name" value="">

			</div>
			<div class="form-input">
				<label for="email">Email</label>
				<input id="email" name="email" class="email" value="">

			</div>
			<div class="form-input">
				<label for="logo">Logo</label>
				<input type="file" id="logo" name="logo" class="logo" value="">

			</div>
			<div class="form-input">
				<label for="website">Website</label>
				<input id="website" name="website" class="website" value="">
			</div>

			<input type="submit" class="btn btn-success submit" value="Add">

		</form>
			
	</div>

	@endif

@endsection