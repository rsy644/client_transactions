@extends('layouts.admin')
@section('content')

	@if (!Auth::guest()) <!--if user has registered and logged in-->

	<div class="table-container">
		<a class="back-link" href="{{ route('clients.show', $client->id) }}">< Back</a>

		<h2 style="clear: left;">Edit a Transaction</h2>

		<form method="POST" role="form" enctype="multipart form-data" action="{{route('transactions.store') }}">
		@csrf

			<input type="hidden" name="update" value="1">
			<input type="hidden" name="transaction_id" value="{{ $transaction->id }}">

				@php
					$formatted_date = date_create_from_format('Y-m-d H:i:s', $transaction->transaction_date);
					$transaction_date = $formatted_date->format('d/m/Y');
				@endphp

			<div class="form-input">
				<label for="transaction_date">Transaction Date</label>
				<input id="transaction_date" name="transaction_date" class="transaction_date" value="{{ $transaction_date }}">
			</div>

			<input type="hidden" id="client_id" name="client_id" value="{{ $client->id }}">

			<div class="form-input">
				<label for="amount">Amount</label>
				<input id="amount" name="amount" class="amount" value="{{ $transaction->amount }}">
			</div>

			<input type="submit" class="btn btn-success submit" value="Update">

		</form>
			
	</div>

	@endif

@endsection