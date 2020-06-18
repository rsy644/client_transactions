@extends('layouts.admin')
@section('content')

	@if (!Auth::guest()) <!--if user has registered and logged in-->

	<div class="table-container">

		<a class="back-link" href="{{ route('clients.index') }}">< Back</a>

		<h2 style="clear: left">Add a Client</h2>

		<form method="POST" role="form" enctype="multipart/form-data" action="{{route('clients.store') }}">
		@csrf

			<div class="form-input">
				<label for="first_name">First Name</label>
				<input id="first_name" name="first_name" class="first_name" value="">

			</div>
			<div class="form-input">
				<label for="last_name">Last Name</label>
				<input id="last_name" name="last_name" class="last_name" value="">

			</div>
			<div class="form-input">
				<label for="avatar">Avatar</label>
				<input type="file" id="avatar" name="avatar" class="avatar" value="">

			</div>
			<div class="form-input">
				<label for="email">Email</label>
				<input id="email" name="email" class="email" value="">
			</div>

			<input type="submit" class="btn btn-success submit" value="Add">

		</form>
			
	</div>

	@endif

@endsection