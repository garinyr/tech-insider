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
							<th>{{$dataSession['kodeDepan']}}</th>
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
							<td>Nama Penerima</td>
							<td>{{$dataSession['namaPenerima']}}</td>
						</tr>
						<tr>
							<td>Kota Asal</td>
							<td>
								{{ $kota_origin->title }}
							</td>
						</tr>
						<tr>
							<td>Kota Tujuan</td>
							<td>
								{{$kota_destination->title}}
							</td>
						</tr>
						<tr>
							<td>Kurir</td>
							<td style="text-transform:uppercase" >
								{{$kurir}}
							</td>
						</tr>
						<tr>
							<td>Alamat Lengkap</td>
							<td>{{$alamat}}</td>
						</tr>
					
						{{-- <tr>
							<td>Total</td>
							<td>Rp. {{format_uang($dataSum)}}</td>
						</tr> --}}
						
					</thead>
				</table>

				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Product</th>
							<th>Description</th>
							<th>Qty</th>
							<th>Price</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						@if($countKeranjang > 0)
						@foreach($dataKeranjang as $v)
						<tr>
							<td><img src="{{ URL::asset('template/web/img/product') }}/{{$v->product->foto}}" class="img-cart" /></td>
							<td>
								<strong>{{$v->product->nama_barang}}</strong>
								<p>Size : {{$v->ukuran}}</p>
								<p>Note : {{$v->note}}</p>
							</td>
							<td>
								<p> {{$v->qty}} </p>
							</td>
							<td>Rp. {{format_uang($v->product->harga)}}</td>
							<td>Rp. {{format_uang($v->total)}}</td>
						</tr>
						@endforeach
						<tr>
							<td colspan="6">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="4" class="text-right"><strong>Total Belanja</strong></td>
							<td>Rp. {{format_uang($dataSum)}}</td>
						</tr>
						<tr>
							<td colspan="4" class="text-right"><strong>Biaya Pengiriman</strong></td>
							<td>Rp. {{format_uang($tarif)}}</td>
						</tr>
						<tr>
							<td colspan="4" class="text-right"><strong>Total</strong></td>
							
							<td>Rp. {{format_uang($total_final)}}</td>
						</tr>
						@else
						<tr>
							<td colspan="5"><center><strong>Belum ada Data Pembelian</strong></center></td>
						</tr>
						<!-- <tr>
							<td colspan="6">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="4" class="text-right">Total Product</td>
							<td>$86.00</td>
						</tr>
						<tr>
							<td colspan="4" class="text-right">Total Shipping</td>
							<td>$2.00</td>
						</tr>
						<tr>
							<td colspan="4" class="text-right"><strong>Total</strong></td>
							<td>$88.00</td>
						</tr> -->
						@endif
					</tbody>
				</table>
			</div>
		</div>
		<a href="{{url('payment')}}" class="btn btn-primary pull-right">Payment Confirmation</a>
		{{--  <button type="submit" class="btn btn-primary pull-right">Next</button>  --}}
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