@extends('layout.web.app')
@section('title','Your Shopping History')

@section('content')
<!-- begin:content -->
<div class="col-md-12 col-sm-8 content">
	<div class="row">
		<div class="col-md-12">
		@include('partials.web.flash')
			<h3>Your Shopping  History </h3>
			<hr />
			
			<table class="table table-bordered table-striped">
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
				@if($countOrder > 0)
					@if(!empty($dataOrder['custom_design']))
						
						<tr>
							<td><img src="{{ URL::asset('template/web/img/customOrder') }}/{{$dataProduk->foto}}" class="img-cart" /></td>
							<td><strong>{{$dataProduk->nama_barang}}</strong></td>
							<td>
								{{$dataProduk->qty}}
							</td>
							<td>Rp. {{format_uang($dataProduk->harga)}}</td>
							<td>Rp. {{format_uang($dataOrder['total'])}}</td>
						</tr>
						
						<tr>
							<td colspan="6">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="4" class="text-right"><strong>Total Belanja</strong></td>
							<td>Rp. {{ format_uang($dataSum) }}</td>
						</tr>
						<tr>
							<td colspan="4" class="text-right"><strong>Biaya Pengiriman</strong></td>
							<td>Rp. {{format_uang($dataPengiriman->ongkir)}}</td>
						</tr>
						<tr>
							<td colspan="4" class="text-right"><strong>Total</strong></td>
							<td>Rp. {{format_uang($dataTransaksi['total'])}}</td>
						</tr>
						@if ($dataPengiriman->resi_pengiriman==!null)
							<tr>
								<td colspan="4" class="text-right"><strong>Resi Pengiriman</strong></td>
								<td>{{$dataPengiriman->resi_pengiriman}}</td>
							</tr>
							@if($dataPengiriman['nama_kurir'] == 'pos')
								<tr>
									<td colspan="4" class="text-right"><strong>Estimasi Pengiriman</strong></td>
									<td>{{$dataPengiriman->estimasi}}</td>
								</tr>
								@else
								<tr>
									<td colspan="4" class="text-right"><strong>Estimasi Pengiriman</strong></td>
									<td>{{$dataPengiriman->estimasi}} HARI</td>
								</tr>
							@endif
						@endif

					@else
						@foreach($dataOrder as $v)
							<tr>
								<td><img src="{{ URL::asset('template/web/img/product') }}/{{$v->product->foto}}" class="img-cart" /></td>
								<td><strong>{{$v->product->nama_barang}}</strong><p>Size : {{$v->ukuran}}</p></td>
								<td>
									{{$v->qty}}
								</td>
								<td>Rp. {{format_uang($v->harga)}}</td>
								<td>Rp. {{format_uang($v->total)}}</td>
							</tr>
						@endforeach
						<tr>
							<td colspan="6">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="4" class="text-right"><strong>Total Belanja</strong></td>
							<td>Rp. {{ format_uang($dataSum) }}</td>
						</tr>
						<tr>
							<td colspan="4" class="text-right"><strong>Biaya Pengiriman</strong></td>
							<td>Rp. {{format_uang($dataPengiriman->ongkir)}}</td>
						</tr>
						<tr>
							<td colspan="4" class="text-right"><strong>Total</strong></td>
							<td>Rp. {{format_uang($v->transaksi->total)}}</td>
						</tr>
						@if ($dataPengiriman->resi_pengiriman==!null)
							<tr>
								<td colspan="4" class="text-right"><strong>Resi Pengiriman</strong></td>
								<td>{{$dataPengiriman->resi_pengiriman}}</td>
							</tr>
							@if($dataPengiriman['nama_kurir'] == 'pos')
								<tr>
									<td colspan="4" class="text-right"><strong>Estimasi Pengiriman</strong></td>
									<td>{{$dataPengiriman->estimasi}}</td>
								</tr>
							@else
								<tr>
									<td colspan="4" class="text-right"><strong>Estimasi Pengiriman</strong></td>
									<td>{{$dataPengiriman->estimasi}} HARI</td>
								</tr>
							@endif
						@endif
					@endif		
				@else
					<tr>
						<td colspan="5"><center><strong>Belum ada Data Pembelian</strong></center></td>
					</tr>
				@endif
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- end:content -->
@endsection