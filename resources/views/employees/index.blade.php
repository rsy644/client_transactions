@extends('layouts.admin')
@section('content')

@if (!Auth::guest()) <!--if user has registered and logged in-->

	<div class="table-container">

		<h2>Employees</h2>

		<form class="employees">
		<meta name="csrf-token" content="{{ csrf_token() }}">		

			@if(count($employees) > 0)

		  		@foreach ($employees as $employee)

		  			<li><a>{{ $employee->first_name . ' ' . $employee->last_name }}</a>
		  			<span class="delete" data-val="{{ $employee->id }}">x</span></li>
				@endforeach

			@else
				<p>No employees to show!</p>

			@endif

		</form>

		{{ $employees->links() }}
			
	</div>

	<script>

		// Variable to hold request
		var request;

		// Bind to the submit event of our form
		$(".delete").click(function(event){

			var employee_id = $(this).data('val');

			var employee = $(this).parent();

    		// Prevent default posting of form - put here to work in case of errors
    		event.preventDefault();

    		$.ajaxSetup({
    			headers: {
    				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    			}
    		});

		    // Fire off the request
		    $.ajax({
		        url: "/employees/" + employee_id + "/delete",
		        type: "delete",
		        dataType: "JSON",
		        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		        data: {
		        	"employee_id": employee_id
		        },
		        success: function (response)
		        {

		        		employee.remove();

		        },
		        error: function(xhr) {
		        	console.log(xhr.responseText);
		        }
		    });

		   });
	</script>

@endif

@endsection