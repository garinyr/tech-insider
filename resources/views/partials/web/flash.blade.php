@if(Session::has('flash_message'))
	<div class="alert alert-success" style="background-color: #8E9190;color:white;">
		<div>{{ Session::get('flash_message') }}</div>
	</div>
@elseif(Session::has('flash_message_error'))
	<div class="alert alert-danger" style="background-color: #C32145;color:white;">
		<div>{{ Session::get('flash_message_error') }}</div>
	</div>
@endif 