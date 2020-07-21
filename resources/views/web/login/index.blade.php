@extends('layout.web.app')
@section('title','Home')

@section('content')
<!-- begin:content -->
<div class="col-md-12 col-sm-8 content">
	<div class="row">
	<div class="col-md-12">
	
		<div class="row">
			<div class="col-md-12 col-sm-6">
				@include('partials.web.flash')
				<h3>Already Registered ? <a href="{{url('registrasi')}}" class="btn btn-primary">Register</a></h3>
				<hr />
				<form action="{{ url('postlogin') }}" method="POST">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="username">Email</label>
					<input type="email" name="email" class="form-control" placeholder="Email">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" class="form-control" placeholder="Password">
				</div>
				<!-- <a href="#">Forgot your password ?</a><br><br> -->
				<input type="submit" class="btn btn-primary">
				</form>
			</div>
		</div>

		
	</div>
	</div>
</div>
@endsection