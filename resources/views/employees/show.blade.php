@extends('layouts.admin')
@section('content')
<!--Anything in here, in this section, is what is going to print into our content yield-->
	
	<div class="table-container">
		<h1>{{{ $employee->first_name . ' ' . $employee->last_name }}}</h1>

		<a href="{{route('employees.edit', [$company->id, $employee->id]) }}">Edit Employee</a><br/><br/>

		<?php if($employee->email != ""){ ?>
			<p>Email: <a href="mailto: {{ $employee->email }}">{{ $employee->email }}</a></p>
		<?php } ?>

		<p>Telephone: <a href="tel:{{ $employee->phone }}">{{ $employee->phone }}</a></p>

		
	</div>	 
	
@endsection