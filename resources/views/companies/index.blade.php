<!--view code-->

@extends('layouts.admin')
@section('content')
@if (!Auth::guest()) <!--if user has registered and logged in-->

	<div class="table-container">

		<h2>Companies</h2>

		<a class="create success button" href="{!! route('companies.create') !!}">Add</a><br/><br/>	

		

			@if(isset($companies) && count($companies) > 0)
				<form class="companies">
				<meta name="csrf-token" content="{{ csrf_token() }}">		

			  		@foreach ($companies as $company)

			  			<li><a href="{{ route('companies.show', $company->id) }}">{{ $company->name }}</a>
			  			<span class="delete" data-val="{{ $company->id }}">x</span></li>
					@endforeach

				</form>

				{{ $companies->links() }}

			@else
				<p>Welcome! Please use the above link to get started by adding a company.</p>

			@endif

		
			
	</div>

@endif

<script>

		// Variable to hold request
		var request;

		// Bind to the submit event of our form
		$(".delete").click(function(event){

			var company_id = $(this).data('val');

			var company = $(this).parent();

    		// Prevent default posting of form - put here to work in case of errors
    		event.preventDefault();

    		$.ajaxSetup({
    			headers: {
    				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    			}
    		});

		    // Fire off the request
		    $.ajax({
		        url: "/companies/" + company_id + "/delete",
		        type: "delete",
		        dataType: "JSON",
		        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		        data: {
		        	"company_id": company_id
		        },
		        success: function (response)
		        {
		        		company.remove();
		        },
		        error: function(xhr) {
		        	console.log(xhr.responseText);
		        }
		    });

		   });
	</script>

@endsection


