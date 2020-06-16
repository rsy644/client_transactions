@extends('layouts.admin')
@section('content')

	@if (!Auth::guest()) <!--if user has registered and logged in-->

	<div class="table-container">
		<a class="back-link" href="{{ url()->previous() }}">Back</a>

		<h2 style="clear: left">Add a Transaction</h2>

		<form method="POST" role="form" enctype="multipart form-data" action="{{route('transactions.store') }}">
		@csrf

			<div class="form-input">
				<label for="transaction_date">Transaction Date</label>
				<input id="transaction_date" name="transaction_date" class="transaction_date" value="">
			</div>

			<input type="hidden" id="client_id" name="client_id" value="{{ $client->id }}">

			<div class="form-input">
				<label for="amount">Amount</label>
				<input id="amount" name="amount" class="amount" value="">

			</div>

			<input type="submit" class="btn btn-success submit" value="Add">

		</form>
			
	</div>

	@endif

@endsection