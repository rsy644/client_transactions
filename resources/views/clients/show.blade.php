@extends('layouts.admin')
@section('content')
<!--Anything in here, in this section, is what is going to print into our content yield-->
	
	<div class="table-container">
		<a class="back-link" href="{{ route('clients.index') }}">< Back</a>

		<?php
			if(strlen($client->avatar) <= 30){// checks whether image is dummy data (from factory) or real
				echo '<img class="client-avatar" src="' . Config::get('app.url') . '/storage/' . $client->avatar . '"/>';
			}
		?>
		<h1 class="client-title">{{{ $client->first_name . ' ' . $client->last_name }}}</h1>

		<div class="admin-links">
			<a href="{{route('clients.edit', $client->id) }}">Edit Client</a><br/>
			<a href="{{route('transactions.create', $client->id) }}">Add Transaction</a><br/><br/><br/>
		</div>

		

			<p>Email: <a href="mailto: {{ $client->email }}">{{ $client->email }}</a></p>

		
		<p>Transactions:</p>
		<form class="transactions">
		<meta name="csrf-token" content="{{ csrf_token() }}">
			@if(isset($transactions) && count($transactions) > 0)
				<ul id="transactions" class="transactions">
				@foreach($transactions as $transaction)
					@php 
					$formatted_date = date_create_from_format('Y-m-d H:i:s', $transaction->transaction_date);
					$transaction_date = $formatted_date->format('d/m/Y');

					 @endphp
					<li data-transactionId="{{ $transaction->id }}" class="transaction-entry"><a href="{{ route('transactions.show', [$client->id, $transaction->id]) }}">{{ $transaction_date }}</a><span class="delete" data-toggle="modal" data-target="#delete_modal_<?php echo $transaction->id; ?>">x</span></li>
					<div class="modal fade" id="delete_modal_<?php echo $transaction->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">	        
					        <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete transaction '<?php echo $transaction_date; ?>'?</h4>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					      </div>
					      <div class="modal-footer">
					        <button type="button" data-val="{{ $transaction->id }}" class="delete_button btn btn-default" data-dismiss="modal">Yes</button>
					        <button type="button" class="btn btn-primary">No</button>
					      </div>

					    </div>
					  </div>
					</div>

				@endforeach
				</ul>
			@endif

		</form>
		{{ $transactions->links() }}
	</div>

	

	<script>

		// Variable to hold request
		var request;

		// Bind to the submit event of our form
		$(".delete_button").click(function(event){

			var transaction_id = $(this).data('val');


			var transaction = $('li[data-transactionID="' + transaction_id + '"]');

			console.log(transaction_id);
			console.log($('li[data-transactionID="' + transaction_id + '"]'));

    		// Prevent default posting of form - put here to work in case of errors
    		event.preventDefault();

    		$.ajaxSetup({
    			headers: {
    				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    			}
    		});

		    // Fire off the request
		    $.ajax({
		        url: "/transactions/" + transaction_id + "/delete",
		        type: "delete",
		        dataType: "JSON",
		        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		        data: {
		        	"transaction_id": transaction_id
		        },
		        success: function (response)
		        {

		        		transaction.remove();

		        },
		        error: function(xhr) {
		        	console.log(xhr.responseText);
		        }
		    });

		   });
	</script>


	
@endsection