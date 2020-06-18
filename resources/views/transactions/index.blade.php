@extends('layouts.admin')
@section('content')

@if (!Auth::guest()) <!--if user has registered and logged in-->

	<div class="table-container">
		<a class="back-link" href="{{ route('index') }}">< Back</a>

		<h2 style="clear: left;">Transactions</h2>

		<form class="transactions">
		<meta name="csrf-token" content="{{ csrf_token() }}">		

			@if(count($transactions) > 0)

		  		@foreach ($transactions as $transaction)
		  			<?php $formatted_date = date_create_from_format('Y-m-d H:i:s', $transaction->transaction_date); 
		  			$transaction_date = $formatted_date->format('d/m/Y');
		  			?>

		  			<li data-transactionId="{{ $transaction->id }}"><a>{{ $transaction_date }}</a>
		  			<span class="delete" data-toggle="modal" data-target="#delete_modal_<?php echo $transaction->id; ?>">x</span>

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

			@else
				<p>No transactions to show!</p>

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

@endif

@endsection