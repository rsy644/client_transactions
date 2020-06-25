<!--view code-->

@extends('layouts.admin')
@section('content')
@if (!Auth::guest()) <!--if user has registered and logged in-->

	<div class="table-container">

		<h2>Clients</h2>

		<a class="create success button" href="{!! route('clients.create') !!}">Add</a><br/><br/>	

		

			@if(isset($clients) && count($clients) > 0)
				<form class="clients">
				<meta name="csrf-token" content="{{ csrf_token() }}">
					<ul class="client_list">
					
				  		@foreach ($clients as $client)
				  			<li data-clientID="{{ $client->id }}"><a href="{{ route('clients.show', $client->id) }}">{{ $client->first_name . ' ' . $client->last_name }}</a>
					  			<span class="delete_x" data-toggle="modal" data-target="#delete_modal_<?php echo $client->id; ?>" data-model="<?php echo $client->id; ?>">x</span>

					  			<div class="modal fade" id="delete_modal_<?php echo $client->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
								    	<div class="modal-content">
								      		<div class="modal-header">	        
								        		<h4 class="modal-title" id="myModalLabel">Are you sure you want to delete client '<?php echo $client->first_name . ' ' . $client->last_name ; ?>'?</h4>
								        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								      		</div>
								     		<div class="modal-footer">
										        <button type="button" data-val="{{ $client->id }}" class="delete_button btn btn-default" data-dismiss="modal">Yes</button>
										        <button type="button" class="btn btn-primary">No</button>
						      				</div>
						    			</div>
						  			</div>
						  		</div>
						  	</li>


						@endforeach
					</ul>

				</form>

				{{ $clients->links() }}

			@else
				<p>Welcome! Please use the above link to get started by adding a client.</p>

			@endif
	</div>

@endif

<script>

		// Variable to hold request
		var request;

		// Bind to the submit event of our form
		$(".delete_button").click(function(event){

			// Prevent default posting of form - put here to work in case of errors
    		event.preventDefault();

    		$('.alert-success').hide();

			var client_id = $(this).data('val');

			console.log(client_id);
			var client = $('li[data-clientID="' + client_id + '"]');

			

    		

    		$.ajaxSetup({
    			headers: {
    				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    			}
    		});

		    // Fire off the request
		    $.ajax({
		        url: "/clients/" + client_id + "/delete",
		        type: "delete",
		        dataType: "JSON",
		        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		        data: {
		        	"client_id": client_id
		        },
		        success: function (response)
		        {
		        		client.remove();
		        },
		        error: function(xhr) {
		        	console.log(xhr.responseText);
		        }
		    });

		   });
	</script>

@endsection


