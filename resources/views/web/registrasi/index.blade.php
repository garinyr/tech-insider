@extends('layout.web.app')
@section('title','Home')
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

@section('content')
<!-- begin:content -->
<div class="col-md-12 col-sm-8 content">
	<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-12 col-sm-6">
				<h3>Create An Account</h3>
				<hr />
				<form action="{{ url('postregistrasi') }}" method="POST">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="first_name">First Name</label>
					<input type="text" name="first_name" value="{{old('first_name')}}" class="form-control" required>
					@if($errors->has('first_name'))
						<div class="text-danger">
						{{ $errors->first('first_name')}}
						</div>
					@endif
				</div>
				<div class="form-group">
					<label for="last_name">Last Name</label>
					<input type="text" name="last_name" value="{{old('last_name')}}" class="form-control" required>
					@if($errors->has('last_name'))
						<div class="text-danger">
						{{ $errors->first('last_name')}}
						</div>
					@endif
				</div>
				<div class="form-group">
					<label for="email">E-mail</label>
					<input type="email" name="email" value="{{old('email')}}" class="form-control" required>
					@if($errors->has('email'))
						<div class="text-danger">
						{{ $errors->first('email')}}
						</div>
					@endif
				</div>
				<div class="form-group">
					<label for="no_hp">Phone</label>
					<input type="number" min="0" name="no_hp" value="{{old('no_hp')}}" class="form-control" required>
					@if($errors->has('no_hp'))
						<div class="text-danger">
						{{ $errors->first('no_hp')}}
						</div>
					@endif
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" class="form-control" onkeyup='check();' required>
					@if($errors->has('password'))
						<div class="text-danger">
						{{ $errors->first('password')}}
						</div>
					@endif
				</div>
				<div class="form-group">
					<label for="confirm_password">Konfirmasi Password</label>
					<input type="password" name="confirm_password" id="confirm_password" class="form-control" onkeyup='check();' required> 
					@if($errors->has('confirm_password'))
						<div class="text-danger">
						{{ $errors->first('confirm_password')}}
						</div>
					@endif
					<span id='message'></span>
				</div>
				<div class="form-group">
					<label for="address">Alamat</label>
					<textarea class="form-control" name="address" required>{{old('address')}}</textarea>
					@if($errors->has('address'))
						<div class="text-danger">
						{{ $errors->first('address')}}
						</div>
					@endif
				</div>
				<!-- <a href="account.html" class="btn btn-primary">Register</a> -->
				<input type="submit" class="btn btn-primary" value="Register">
				</form>
			</div>
		</div>
	</div>
	</div>

</div>
@endsection

<script>
	var check = function() {
		if (document.getElementById('password').value ==
			document.getElementById('confirm_password').value) {
			document.getElementById('message').style.color = 'green';
			document.getElementById('message').innerHTML = 'Password Matching';
		} else {
			document.getElementById('message').style.color = 'red';
			document.getElementById('message').innerHTML = 'Password Not Matching';
		}
		}
</script>	