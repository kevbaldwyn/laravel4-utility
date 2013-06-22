@extends('layouts.master')

@section('content')
	<h1>There was an error</h1>
	<p>An error occurred and has been reported to the system administrator.</p>

	@if(isset($additional_errors))
		<p>Additionaly the following errors were reported, please report them.</p>
		@foreach($additional_errors as $error)
			<ul>
				<li>{{ $error }}</li>
			</ul>
		@endforeach
	@endif
@stop