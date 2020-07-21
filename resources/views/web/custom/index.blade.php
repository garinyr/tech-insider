@extends('layout.web.app')
@section('title','Home')
<script type='text/javascript'>
	function preview_image(event) 
	{
	 var reader = new FileReader();
	 reader.onload = function()
	 {
	  var output = document.getElementById('output_image');
	  output.src = reader.result;
	 }
	 reader.readAsDataURL(event.target.files[0]);
	}
	</script>
<style>
	body
	{
		width:100%;
		margin:0 auto;
		padding:0px;
		font-family:helvetica;
		background-color:#0B3861;
	}
	#wrapper
	{
		text-align:center;
		margin:0 auto;
		padding:0px;
		width:995px;
	}
	#output_image
	{
		max-width:300px;
	}
</style>
@section('content')

 <div class="row">
	<div class="col-md-12">
		<div class="heading-title">
		<h2>Create Your <span>own Design</span> <span class="text-yellow">.</span></h2>
		</div>
		<div class="row">
		<!-- begin:product-image-slider -->
		{{--  <div class="col-md-6 col-sm-6">
			<div id="product-single" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<div class="item active">
					<div class="product-single">
						<img src="{{url('template/web/img/product')}}/{{#}}" class="img-responsive">
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
		</div>  --}}
		<!-- end:product-image-slider -->

		<!-- begin:product-spesification -->
		<div class="col-md-6 col-sm-6">
			<div class="single-desc">
			<form method="POST" action="{{ url('/customCheckout') }}" enctype="multipart/form-data">
				{{ csrf_field() }}
				<span class="visible-xs">
					<strong> In Stock</strong>
				</span>

				<table>
				<tbody>
					{{-- custom kategori --}}
					<tr>
						<td><strong>Jenis Custom</strong></td>
						<td>:</td>
						<td>
							<select class="form-control" name="custom_id" required>
								<option value="">Pilih Custom</option>
								@foreach ($dataCustom as $data )
								<option value="{{ $data->id }}">{{ $data->nama_kategori }} - Rp. {{ format_uang($data->harga) }}</option>
								@endforeach
							</select>
							@if($errors->has('custom_id'))
							<div class="text-danger">
								{{ $errors->first('custom_id')}}
							</div>
							@endif
						</td>
					</tr>
					{{--  qty  --}}
					<tr>
						<td><strong>Quantity</strong></td>
						<td>:</td>
						<td>
						<input min="1" type="number" name="jumlah_qty" class="form-control" >
						{{--  <input type="hidden" name="id_barang" class="form-control" value="#">  --}}
							@if($errors->has('jumlah_qty'))
							<div class="text-danger">
								{{ $errors->first('jumlah_qty')}}
							</div>
						@endif
						</td>
					</tr>

					{{--  note  --}}
					<tr>
						<td><strong>Note</strong></td>
						<td>:</td>
						<td>
						<textarea type="text" name="note" class="form-control" placeholder="Masukan note untuk warna dan ukuran"></textarea>
							@if($errors->has('jumlah_qty'))
							<div class="text-danger">
								{{ $errors->first('jumlah_qty')}}
							</div>
						@endif
						</td>
					</tr>

					{{--  photo  --}}
					<tr>
						<td><strong>Choose file</strong></td>
							<td>:</td>
						<td>
							<div id="">
								<input name="photo" type="file" accept="image/*" onchange="preview_image(event)" required>
								<span>
									*Format JPG, PNG, SVG
								</span>
							</div>
							
							@if($errors->has('photo'))
							<div class="text-danger">
								{{ $errors->first('photo')}}
							</div>
							@endif
						</td>
					</tr>


					<tr>
						<td colspan="3">
							@if(Auth::check()) 
								<button class="btn btn-sm btn-primary">Checkout</button>
							@else  
								<a href="{{url('login')}}" class="btn btn-sm btn-primary">Login</a>
								<a href="{{url('registrasi')}}" class="btn btn-sm btn-info">Register</a>
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
				<li class="active"><a href="#desc" data-toggle="tab">Preview</a></li>
			</ul>

			<div id="myTabContent" class="tab-content">
				<div class="tab-pane fade active in" id="desc">
					
					<img id="output_image"/>
				</div>
			</div>
		</div>
		</div>
		<!-- end:product-detail -->
	</div>
	
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
    $("#inputFile").change(function(event) {  
      fadeInAdd();
      getURL(this);    
    });

    $("#inputFile").on('click',function(event){
      fadeInAdd();
    });

    function getURL(input) {    
      if (input.files && input.files[0]) {   
        var reader = new FileReader();
        var filename = $("#inputFile").val();
        filename = filename.substring(filename.lastIndexOf('\\')+1);
        reader.onload = function(e) {
          debugger;      
          $('#imgView').attr('src', e.target.result);
          $('#imgView').hide();
          $('#imgView').fadeIn(500);      
          $('.custom-file-label').text(filename);             
        }
        reader.readAsDataURL(input.files[0]);    
      }
      $(".alert").removeClass("loadAnimate").hide();
    }

    function fadeInAdd(){
      fadeInAlert();  
    }
    function fadeInAlert(text){
      $(".alert").text(text).addClass("loadAnimate");  
    }
</script>