@extends('layout.web.app')
@section('title','Home')

@section('content')
<!-- begin:content -->
<div class="col-md-12 col-sm-8 content">
	<div class="row">
		<div class="col-md-12">
			@include('partials.web.flash')
			<h3>History Pembelian</h3>
			<hr />
			
			<table class="table table-bordered table-striped">
			<thead>
			<tr>
				<th>Invoice</th>
				<th>Total</th>
				<th>Status</th>
				<th>Tanggal</th>
				<th>Action</th>
			</tr>
			</thead>
			<tbody>
			@if($countTransaksi > 0)
			@foreach($dataTransaksi as $v)
			<tr>
				<td>{{$v->kd_transaksi}}</td>
				<td>Rp. {{format_uang($v->total)}}</td>
				<td>
					@if($v->status_pembayaran == 1)
						Pending
					@elseif($v->status_pembayaran == 0)
						Reject
					@elseif($v->status_pembayaran == 3)
						Sudah Dikirim
					@else
						Menunggu Dikirim
					@endif
				</td>
				<td>{{$v->created_at}}</td>
				<td>
					<a href="{{url('historypembelian/view-history')}}/{{$v->id}}" class="btn btn-info" rel="tooltip" title="View"><i class="fa fa-eye"></i></a>
				</td>
			</tr>
			@endforeach
			@else
			<tr>
				<td colspan="5"><center><strong>Belum ada Data Pembelian</strong></center></td>
			</tr>
			@endif
			
			<!-- <tr>
				<td>KDTR02</td>
				<td>Rp. 3.000.000</td>
				<td>
					Wait Confirmation Payment
				</td>
				<td>2019-08-07</td>
				<td>
					<a href="{{url('cart')}}" class="btn btn-info" rel="tooltip" title="View"><i class="fa fa-eye"></i></a>
					<a href="{{url('payment')}}" class="btn btn-warning" rel="tooltip" title="Payment Confirmation"><i class="fa fa-money"></i></a>
				</td>
			</tr>

			<tr>
				<td>KDTR03</td>
				<td>Rp. 5.000.000</td>
				<td>
					Finish
				</td>
				<td>2019-08-07</td>
				<td>
					<a href="{{url('cart')}}" class="btn btn-info" rel="tooltip" title="View"><i class="fa fa-eye"></i></a>
				</td>
			</tr> -->

			</tbody>
			</table>
		</div>
	</div>
</div>
<!-- end:content -->
@endsection