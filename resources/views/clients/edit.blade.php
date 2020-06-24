@extends('layouts.admin')
@section('content')

	@if (!Auth::guest()) <!--if user has registered and logged in-->

	<div class="table-container">
		<a class="back-link" href="{{ route('clients.show', $client->id) }}">< Back</a>

		<h2 style="clear: left">Edit a Client</h2>

		<form method="POST" role="form" enctype="multipart/form-data" action="{{route('clients.store') }}">
		@csrf
			<input type="hidden" name="update" value="1">
			<input type="hidden" name="client_id" value="{{ $client->id }}">
			<div class="form-input">
				<label for="first_name">First Name</label>
				<input id="first_name" name="first_name" class="first_name" value="{{ $client->first_name }}">

			</div>
			<div class="form-input">
				<label for="last_name">Last Name</label>
				<input id="last_name" name="last_name" class="last_name" value="{{ $client->last_name }}">

			</div>
			<div class="form-input">
				<label for="avatar">Avatar</label>
				<input type="file" id="avatar" name="avatar" class="avatar" value="">

			</div>
			<div class="form-input">
				<label for="email">Email</label>
				<input id="email" name="email" class="email" value="{{ $client->email }}">
			</div>

			<input type="submit" class="btn btn-success submit" value="Update">

		</form>
			
	</div>

	@endif

@endsection