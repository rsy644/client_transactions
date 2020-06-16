@extends('layouts.admin')
@section('content')
<!--Anything in here, in this section, is what is going to print into our content yield-->
	
	<div class="table-container">
	<a class="back-link" href="{{ url()->previous() }}">< Back</a>

	@php
	$formatted_date = date_create_from_format('Y-m-d H:i:s', $transaction->transaction_date);
	$transaction_date = $formatted_date->format('d/m/Y');


	@endphp
		<h1 style="clear: left;">{{{ $transaction_date }}}</h1>

		<a href="{{route('transactions.edit', [$client->id, $transaction->id]) }}">Edit Transaction</a><br/><br/>

		<p>Date: {{ $transaction_date }}</p>


		<p>Amount: {{ $transaction->amount }}</p>

		
	</div>	 
	
@endsection