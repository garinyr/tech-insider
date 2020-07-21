@extends('layout.web.app')
@section('title','Home')

@section('content')
<!-- begin:content -->
<div class="col-md-12 col-sm-8 content">
	<div class="row">
		<div class="col-md-12">
		@include('partials.web.flash')
			<h3>Your Cart</h3>
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
			@if($countKeranjang > 0)
			@foreach($dataKeranjang as $v)
			<tr>
				<td><img src="{{ URL::asset('template/web/img/product') }}/{{$v->product->foto}}" class="img-cart" alt="{{$v->product->nama_barang}}" /></td>
			<td><strong>{{$v->product->nama_barang}}</strong><p>Size : {{$v->ukuran}}</p></td>
				<td>
				<form class="form-inline" method="post" action='{{ url("/edit-cart/{$v->id}") }}'>
				{{ csrf_field() }}
					<input class="form-control" type="text" value="{{$v->qty}}" name="updateqty" />
					<button rel="tooltip" onclick="return confirm('Are You Sure Update Data?')" title="Update" class="btn btn-default"><i class="fa fa-pencil"></i></button>
					<a href='{{ url("/delete-cart/{$v->id}") }}' onclick="return confirm('Are You Sure Delete Data?')" class="btn btn-primary" rel="tooltip" title="Delete"><i class="fa fa-trash-o"></i></a>
				</form>
				</td>
				<td>Rp. {{format_uang($v->product->harga)}}</td>
				<td>Rp. {{format_uang($v->total)}}</td>
			</tr>
			@endforeach
			<tr>
				<td colspan="6">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="4" class="text-right"><strong>Total</strong></td>
				<td>Rp. {{format_uang($dataSum)}}</td>
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
			<a href="{{url('/')}}" class="btn btn-default">Continue Shopping</a>
			@if($countKeranjang > 0)
			<a href="{{url('invoice')}}" class="btn btn-primary pull-right">Next</a>
			@else
			<!-- <a href="{{url('/')}}" class="btn btn-primary pull-right">Next</a> -->
			@endif
		</div>
	</div>
</div>
<!-- end:content -->
@endsection