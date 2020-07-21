@extends('layout.web.app')
@section('title','Home')

@section('css')
	<style type="text/css">
		.pagination li{
			float: left;
			list-style-type: none;
			margin:5px;
		}
	</style>
@endsection

@section('content')
@include('partials.web.flash')
<!-- begin:home-slider -->
<div id="home-slider" class="carousel slide" data-ride="carousel">
<ol class="carousel-indicators">
	<li data-target="#home-slider" data-slide-to="0" class="active"></li>
	<li data-target="#home-slider" data-slide-to="1" class=""></li>
</ol>  
<div class="carousel-inner">
	<div class="item active">
	<img src="{{ URL::asset('foto/banner1.png') }}" alt="clotheshop">
	</div>
	<div class="item">
	<img src="{{ URL::asset('foto/banner2.png') }}" alt="clotheshop">
	</div>
</div>

</div>
<!-- end:home-slider -->

<!-- begin:best-seller -->
<div class="row">
	<div class="col-md-12">
		<div class="page-header">
		<h2>Our <small>Product</small></h2>
		</div>
	</div>
</div>

<div class="row product-container">

	@foreach($dataBarang as $v)
		<div class="col-md-3 col-sm-3 col-xs-6">
			<div class="thumbnail product-item">
			<a href='{{url("detail/{$v->id}")}}'><img alt="" src="{{ URL::asset('template/web/img/product') }}/{{$v->foto}}"></a>
			<div class="caption">
				<a href='{{url("detail/{$v->id}")}}'>
				<h5>
						{{$v->nama_barang}}
					</h2>
				</a>
				<p>Rp. {{format_uang($v->harga)}}</p>
				@if($v->stok < 1)
				<p>Pre Order</p>
				@else
				<img src="{{ URL::asset('foto/Official.svg') }}" style="height:15px;">	
				<img src="{{ URL::asset('foto/Available.svg') }}" style="height:15px;">
				@endif
			</div>
			</div>
		</div>
	@endforeach

</div>
<!-- end:best-seller -->  

<!-- begin:pagination -->
<div class="row">
	<div class="col-md-12">
		<center>
		
		@if ($dataBarang->hasPages())
			<ul class="pagination pagination">
				{{-- Previous Page Link --}}
				@if ($dataBarang->onFirstPage())
					<li class="disabled"><span>«</span></li>
				@else
					<li><a href="{{ $dataBarang->previousPageUrl() }}" rel="prev">«</a></li>
				@endif

				@if($dataBarang->currentPage() > 3)
					<li class="hidden-xs"><a href="{{ $dataBarang->url(1) }}">1</a></li>
				@endif
				@if($dataBarang->currentPage() > 4)
					<li><span>...</span></li>
				@endif
				@foreach(range(1, $dataBarang->lastPage()) as $i)
					@if($i >= $dataBarang->currentPage() - 2 && $i <= $dataBarang->currentPage() + 2)
						@if ($i == $dataBarang->currentPage())
							<li class="active"><span>{{ $i }}</span></li>
						@else
							<li><a href="{{ $dataBarang->url($i) }}">{{ $i }}</a></li>
						@endif
					@endif
				@endforeach
				@if($dataBarang->currentPage() < $dataBarang->lastPage() - 3)
					<li><span>...</span></li>
				@endif
				@if($dataBarang->currentPage() < $dataBarang->lastPage() - 2)
					<li class="hidden-xs"><a href="{{ $dataBarang->url($dataBarang->lastPage()) }}">{{ $dataBarang->lastPage() }}</a></li>
				@endif

				{{-- Next Page Link --}}
				@if ($dataBarang->hasMorePages())
					<li><a href="{{ $dataBarang->nextPageUrl() }}" rel="next">»</a></li>
				@else
					<li class="disabled"><span>»</span></li>
				@endif
			</ul>
		@endif

		</center>
	</div>
</div>

<div>
  <div class="card img-fluid" style="border:none; box-shadow: 2px 2px 5px #888888;">
    <img src="{{ URL::asset('foto/Your Design Here.png') }}" alt="Custom Order Tech Insider Cloting" style="border-radius: 3px; width:100%">
    <div class="card-img-overlay">
      <a href="{{url('/custom')}}" class="btn btn-list">Custom NOW</a>
    </div>
  </div>
</div>

<!-- end:pagination -->
@endsection