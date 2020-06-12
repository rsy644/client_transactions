@extends('layouts.admin')
@section('content')
<!--Anything in here, in this section, is what is going to print into our content yield-->
	
	<div class="table-container">
		<?php echo '<img class="company-logo" src="' . Config::get('app.url') . '/storage/' . $company->logo . '"/>'; ?>
		<h1 class="company-title">{{{ $company->name }}}</h1>

		<div class="admin-links">
			<a href="{{route('companies.edit', $company->id) }}">Edit Company</a><br/>
			<a href="{{route('employees.create', $company->id) }}">Add Employee</a><br/><br/><br/>
		</div>

		

			<p>Email: <a href="mailto: {{ $company->email }}">{{ $company->email }}</a></p>



			<p>Website: <a href="http://{{ $company->website }}">{{ $company->website }}</a></p>

		
		<p>Employees:</p>
		<form class="employees">
		<meta name="csrf-token" content="{{ csrf_token() }}">
			@if(isset($employees) && count($employees) > 0)
				<ul id="employees" class="employees">
				@foreach($employees as $employee)
					<li><a href="{{ route('employees.show', [$company->id, $employee->id]) }}">{{ $employee->first_name . ' ' . $employee->last_name }}</a><span class="delete" data-val="{{ $employee->id }}">x</span></li>

				@endforeach
				</ul>
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
	
@endsection