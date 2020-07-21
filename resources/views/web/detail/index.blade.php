@extends('layout.web.app')
@section('title','Home')

@section('content')
 <div class="row">
	<div class="col-md-12">
		<div class="heading-title">
		<h2>The <span>Product</span> <span class="text-yellow">.</span></h2>
		</div>
		<div class="row">
		<!-- begin:product-image-slider -->
		<div class="col-md-6 col-sm-6">
			<div id="product-single" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<div class="item active">
					<div class="product-single">
						<img src="{{url('template/web/img/product')}}/{{$dataBarang->foto}}" class="img-responsive">
					</div>
				</div>

				<!-- <div class="item">
					<div class="product-single">
						<img src="{{url('/template/web/img/product11.jpg')}}" class="img-responsive">
					</div>
				</div>
				<div class="item">
					<div class="product-single">
						<img src="{{url('/template/web/img/product12.jpg')}}" class="img-responsive">
					</div>
				</div> -->

			</div>

			<!-- <a class="left carousel-control" href="#product-single" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="right carousel-control" href="#product-single" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a> -->
			</div>
		</div>
		<!-- end:product-image-slider -->

		<!-- begin:product-spesification -->
		<div class="col-md-6 col-sm-6">
			<div class="single-desc">
			<form method="post" action="{{ url('add-cart') }}">
			{{ csrf_field() }}
				<span class="visible-xs">
					<strong>{{$dataBarang->nama_barang}} / In Stock</strong>
				</span>

				<table>
				<tbody>
					<tr class="hidden-xs">
						<td><strong>Brand</strong></td>
						<td>:</td>
						<td>{{$dataBarang->nama_barang}}</td>
					</tr>
					{{--  <tr class="hidden-xs">
						<td><strong>Product Code</strong></td>
						<td>:</td>
						<td>KDPR0{{$dataBarang->id}}</td>
					</tr>  --}}
					<tr class="hidden-xs">
						<td><strong>Availability</strong></td>
						<td>:</td>
						<td>{{$dataBarang->stok}}</td>
						{{--  <input type="hidden" name="stok" class="form-control" value="{{$dataBarang->stok}}">  --}}
					</tr>
					<tr>
						<td colspan="3">
						<span class="price">Rp. {{format_uang($dataBarang->harga)}}</span></td>
					</tr>
					<tr>
						<td><strong>Quantity</strong></td>
						<td>:</td>
						<td>
						<input min="0" max="{{$dataBarang->stok}}" type="number" name="jumlah_qty" class="form-control" placeholder="Pilih Jumlah Beli">
						<input type="hidden" name="id_barang" class="form-control" value="{{$dataBarang->id}}">
							@if($errors->has('jumlah_qty'))
							<div class="text-danger">
								{{ $errors->first('jumlah_qty')}}
							</div>
						@endif
						</td>
					</tr>
					<tr>
						<td><strong>Size</strong></td>
						<td>:</td>
						<td>
						<select class="form-control" name="ukuran">
							<option value="0">--Pilih Ukuran--</option>
							<option value="S">S</option>
							<option value="M">M</option>
							<option value="L">L</option>
							<option value="XL">XL</option>
						</select>
							@if($errors->has('ukuran'))
							<div class="text-danger">
								{{ $errors->first('ukuran')}}
							</div>
						@endif
						</td>
					</tr>
					<tr>
						<td><strong>Note</strong></td>
						<td>:</td>
						<td>
							<div class="form-group">
								<textarea class="form-control" name="note" required placeholder="Masukan note untuk warna dan ukuran">{{old('note')}}</textarea>
								<strong>*Jika warna dan ukuran berbeda-beda, silahkan isi di note.</strong>
								@if($errors->has('note'))
									<div class="text-danger">
									{{ $errors->first('note')}}
									</div>
								@endif
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="3">
						@if(Auth::check()) 
							<button class="btn btn-sm btn-primary">Add to Cart</button>
						@else  
							<a href="{{url('login')}}" class="btn btn-sm btn-primary">Login</a>
						@endif
						</td>  
					</tr>
				</tbody>
				</table>
			</form>
			</div>
		</div>
		<!-- end:product-spesification -->
		</div>
		<!-- break -->
		<!-- begin:product-detail -->
		<div class="row">
		<div class="col-md-12 content-detail">
			<ul id="myTab" class="nav nav-tabs">
				<li class="active"><a href="#desc" data-toggle="tab">Description</a></li>
			</ul>

			<div id="myTabContent" class="tab-content">
				<div class="tab-pane fade active in" id="desc">
					{!! $dataBarang->deskripsi !!}
				</div>
			</div>
		</div>
		</div>
		<!-- end:product-detail -->
	</div>
</div>
@endsection