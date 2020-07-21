@if(Session::has('flash_message'))
	<div class="alert alert-success" style="color:grren;">
		<div>{{ Session::get('flash_message') }}</div>
	</div>
@elseif(Session::has('flash_message_error'))
	<div class="alert alert-danger" style="color:red;">
		<div>{{ Session::get('flash_message_error') }}</div>
	</div>
@endif 