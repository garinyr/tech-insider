@if(Session::has('flash_message'))
	<div class="alert alert-success alert-dismissible {{ Session::has('penting') ? 'alert-important' : '' }}" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		{{ Session::get('flash_message') }}
	</div>
@endif

@if(Session::has('flash_error_message'))
	<div class="alert alert-danger alert-dismissible {{ Session::has('penting') ? 'alert-important' : '' }}" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		{{ Session::get('flash_error_message') }}
	</div>
@endif