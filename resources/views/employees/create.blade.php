@extends('layouts.admin')
@section('content')

	@if (!Auth::guest()) <!--if user has registered and logged in-->

	<div class="table-container">

		<h2>Add an Employee</h2>

		<form method="POST" role="form" enctype="multipart form-data" action="{{route('employees.store') }}">
		@csrf

			<div class="form-input">
				<label for="first_name">First Name</label>
				<input id="first_name" name="first_name" class="first_name" value="">

			</div>
			<div class="form-input">
				<label for="last_name">Last Name</label>
				<input id="last_name" name="last_name" class="last_name" value="">
			</div>

			<input type="hidden" id="company_id" name="company_id" value="{{ $company->id }}">

			<div class="form-input">
				<label for="email">Email</label>
				<input id="email" name="email" class="email" value="">

			</div>
			<div class="form-input">
				<label for="phone">Phone</label>
				<input id="phone" name="phone" class="phone" value="">
			</div>

			<input type="submit" class="btn btn-success submit" value="Add">

		</form>
			
	</div>

	@endif

@endsection