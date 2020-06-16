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

			  		@foreach ($clients as $client)

			  			<li><a href="{{ route('clients.show', $client->id) }}">{{ $client->first_name . ' ' . $client->last_name }}</a>
			  			<span class="delete" data-val="{{ $client->id }}">x</span></li>
					@endforeach

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
		$(".delete").click(function(event){

			var client_id = $(this).data('val');

			var client = $(this).parent();

    		// Prevent default posting of form - put here to work in case of errors
    		event.preventDefault();

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


