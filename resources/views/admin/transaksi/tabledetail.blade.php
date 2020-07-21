@extends('layout.web.app')
@section('title','Home')

@section('content')
<!-- begin:content -->
<div class="col-md-12 col-sm-8 content">
	<div class="row">
		<div class="col-md-12">
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
                @foreach($dataOrder as $v)
                <tr>
                    <td><img src="{{ URL::asset('template/web/img/product') }}/{{$v->product->foto}}" class="img-cart" width="200px" height="200px" /></td>
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
                    <td>Rp. {{format_uang($dataSum)}}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right"><strong>Biaya Pengiriman</strong></td>
                    <td>Rp. {{format_uang($dataPengiriman->ongkir)}}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right"><strong>Total</strong></td>
                    <td>Rp. {{format_uang($v->transaksi->total)}}</td>
                </tr>
                </tbody>
            </table>
		</div>
	</div>
</div>
<!-- end:content -->
@endsection