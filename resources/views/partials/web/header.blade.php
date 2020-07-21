<!-- begin:navbar -->
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-6" style="top: 10px;">
		<div class="logo">
			<a href="{{url('/')}}"><img src="{{ URL::asset('foto/Logo Tech Insider Black.svg') }}"
			alt="Logo Tech Insider" style="width:175px;">
		</div>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-6">
		<div class="account">
		<ul>
			<li id="your-account">
				<div class="hidden-xs">
					<h4>@if(Auth::check()) {{Auth::user()->nama_depan}} @else  @endif</h4>
					@if(Auth::check())
						<a href="{{url('cart')}}"><i class="btn btn-primary">My Cart</i></a>
						<a href="{{url('historypembelian')}}"><i class="btn btn-primary">Order History</i></a>
					@endif
						@if(Auth::check()) <a style="color: white" class="btn btn-logout" href="{{url('logout')}}">Log Out</a> 
						@else <a class="btn btn-primary" href="{{url('login')}}" style="color: white">Log in</a> @endif
				</div>
				<div class="visible-xs">
					@if(Auth::check()) 
					<!-- <a style="color: white" class="btn btn-logout" href="{{url('logout')}}">Log Out</a>  -->
					@else 
					<a class="btn btn-primary" href="{{url('login')}}" style="color: white"><i class="fa fa-user"></i>&nbsp;&nbsp; Log in</a> 
					@endif</a>
				</div>
			</li>

			<li>
			@if(Auth::check())
			<div class="visible-xs">
				<a href="{{url('cart')}}" class="btn btn-primary">@php if ( Auth::check() ) {
						$dataKeranjang = \App\Models\Keranjang::where('user_id', Auth::user()->id)->count();
					};@endphp @if($dataKeranjang==0) @else <span class="cart-item"> {{$dataKeranjang}} </span> @endif <i class="fa fa-shopping-cart"></i></a>
				<a href="{{url('historypembelian')}}" class="btn btn-primary"><i class="fa fa-calendar"></i></a>
				<a href="@if(Auth::check()) {{url('logout')}} @else {{url('login')}} @endif " class="btn btn-logout"><i class="fa fa-sign-out"></i></a>
				</div>
			@endif
			</li>
		</ul>
		</div>
	</div>
</div> 
<!-- end:logo -->

<!-- begin:nav-menus -->
<div class="row">
	<div class="col-md-12">
		<div class="nav-menus">
		
		</div>
	</div>
</div>
<!-- end:nav-menus -->