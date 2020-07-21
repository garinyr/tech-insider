@extends('layout.web.app')
@section('title','Pengiriman')

@section('content')
<!-- begin:content -->
<div class="col-md-12 col-sm-8 content">
	<div class="row">
	<div class="col-md-12">
		
		<h3>Transaction Information</h3>
		<hr />

		<div class="box">
			<div class="box-head">
				<h3>Your Invoiced</h3>
			</div>
			<div class="box-content">
				<p>Please record the number of your <strong>invoice</strong> before leaving this page, <strong>invoice</strong> number used to check the status of your purchase and use of goods for payment confirmation.</p>
			<form method="POST" action="{{ url('/submit') }}">
				{{ csrf_field() }}
				<table class="table table-bordered">
				<thead>
					<tr>
						<th>Kode Transaksi</th>
						<th>{{$kodeDepan}}</th>
					</tr>
					<tr>
						<td>Pelanggan</td>
						<td>{{Auth::user()->nama_depan}}</td>
					</tr>
					<tr>
						<td>Order Date</td>
						<td>{{Date("Y-m-d H:i:s", time()+60*60*7)}}</td>
					</tr>
				</thead>
				<thead>
					<tr>
						<th colspan="2">Pengiriman</th>
						
					</tr>
					<tr>
						<td>Kota Asal</td>
						<td>
							<select class="form-control" name="city_origin">
								<option value="455">Tangerang</option>
							</select>
							@if($errors->has('city_origin'))
							<span>
								<div class="text-danger">
								{{ $errors->first('city_origin')}}
								</div>
							</span>
							@endif
						</td>
					</tr>
					<tr>
						<td>Provinsi</td>
						<td>
							<select class="form-control" name="province_destination" required>
								<option value="">Pilih Provinsi</option>

								@foreach ($provinces as $province => $value )
								<option value="{{ $province }}">{{ $value }}</option>
								@endforeach
							</select>
							@if($errors->has('province_destination'))
							<span>
								<div class="text-danger">
								{{ $errors->first('province_destination')}}
								</div>
							</span>
							@endif
						</td>
					</tr>
					<tr>
						<td>Kota</td>
						<td>
							<select class="form-control" name="city_destination" required>
								<option>Pilih Kota</option>
							</select>
							@if($errors->has('city_destination'))
							<span>
								<div class="text-danger">
								{{ $errors->first('city_destination')}}
								</div>
							</span>
							@endif
						</td>
					</tr>
					<tr>
						<td>Kurir</td>
						<td>
							<select  name="courier" class="form-control" required>
								<option value="">Pilih Kurir</option>
								@foreach ($couriers as $courier => $value )
								<option value="{{ $courier }}">{{ $value }}</option>
								@endforeach
							</select>
							@if($errors->has('courier'))
							<span>
								<div class="text-danger">
								{{ $errors->first('courier')}}
								</div>
							</span>
							@endif
						</td>
					</tr>
					<tr>
						<td>Nama Penerima</td>
						<td>
							<input type="text" name="nama_penerima" {{ old('nama_penerima') }}  placeholder="Nama Penerima" class="form-control col-xs-12" required></input>	
						@if($errors->has('nama_penerima'))
							<span>
								<div class="text-danger">
									{{ $errors->first('nama_penerima')}}
								</div>
							</span>
						@endif
						</td>
					</tr>
					<tr>
						<td rowspan="2">Alamat Lengkap</td>
						<td>
							<textarea name="alamat" {{ old('alamat') }} id="" rows="5" placeholder="Alamat Lengkap" class="form-control col-xs-12" required>{{$dataUser->alamat}}</textarea>
						<span>
							<i><strong>
								*Jika kirim ke alamat berbeda, hapus dan tuliskan alamat baru
							</strong></i>
							@if($errors->has('alamat'))
								<p class="text-danger">
								{{ $errors->first('alamat')}}
								</p>
							@endif
						</span>
						</td>
					</tr>
				</thead>
				</table>
			</div>
		</div>
		<button type="submit" class="btn btn-primary pull-right">Next</button>
	</form>
	</div>
	</div>
</div>
<!-- end:content -->
@endsection

@section('js')
<!-- jquery 3.2.1 -->
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/popper.min.js" integrity="sha256-1XfFQxRfNvDJW3FdZ+xlo2SbodG2+rFArw6XsVzu3bc=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $('select[name="province_destination"]').on('change', function() {
            let provinceId = $(this).val();
			console.log(provinceId);
            if(provinceId) {
                jQuery.ajax({
                    url:'/province/'+provinceId+'/cities',
                    type: "GET",
                    dataType: "json",
                    success:function(data){
                        // alert(data);
                        $('select[name="city_destination"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="city_destination"]').append('<option value="'+ key +'">' + value + '</option>'); 
                        });
                    },
                });
            } else {
                $('select[name="city_destination"]').empty();
            }
        });
		$('select[name="city_destination"]').on('change', function() {
			
            let city_origin 		= "455";
            let city_destination 	= "226";
            let weight 				= "1000";
			let courier 			= "tiki";
			console.log(city_origin,city_destination,weight,courier);
			console.log('/cost/'+city_origin+'/'+city_destination+'/'+weight+'/'+courier);
            // if(city_destination) {
            //     jQuery.ajax({
            //         url:'/cost/'+city_origin+'/'+city_destination+'/'+weight+'/'+courier,
            //         type: "GET",
            //         dataType: "json",
            //         success:function(data){
            //             alert('berhasil');
                        
            //         },
            //     });
            // } else {
            //     alert('gagal');
            // }
			
		});    
    });
</script>

@endsection