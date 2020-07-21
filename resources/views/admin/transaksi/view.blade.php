@extends('layout.admin.app')
@section('title','Detail Transaksi')
@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Detail Transaksi</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"></li>
            </ol>
        </div>
        <div class="col-md-7 col-4 align-self-center">       
        </div>
    </div>
    <div class="col-md-7 col-4 align-self-center">
    </div>
</div>
<div class="container">
    <div class="col-12">
        <div class="card card-outline-info">
            <div class="card-header">
                @if(  $dataTransaksi['id'] < 10 )
                <h4 class="m-b-0 text-white">Kode Transaksi - KDTR - 0{{ $dataTransaksi['id'] }}</h4>
                @else
                <h4 class="m-b-0 text-white">Kode Transaksi - KDTR - {{ $dataTransaksi['id'] }}</h4>
                @endif
            </div>
            <div class="card-body">
                    <div class="form-group form-material">
                            <label>
                                <p><b>Nama User</b></p>
                            </label>
                        <p>
                            {{ $dataTransaksi['user']['name'] }}
                        </p>
                    </div><hr>
                    <div class="form-group form-material">
                            <label>
                                <p><b>Alamat</b></p>
                            </label>
                        <p>
                            {{ $dataTransaksi['alamat'] }}
                        </p>
                    </div><hr>
                    <div class="form-group form-material">
                            <label>
                                <p><b>No. HP</b></p>
                            </label>
                        <p>
                            {{ $dataTransaksi['user']['no_hp'] }}
                        </p>
                    </div><hr>
                    <div class="form-group form-material">
                            <label>
                                <p><b>Kota Tujuan</b></p>
                            </label>
                        <p>
                            {{ $dataPengiriman['kota_tujuan'] }}
                        </p>
                    </div><hr>
                    <div class="form-group form-material">
                        <label>
                            <p><b>Estimasi Pengiriman</b></p>
                        </label>
                        @if($dataPengiriman['nama_kurir'] == 'pos')
                            <p>
                                {{ $dataPengiriman['estimasi'] }}
                            </p>
                        @else
                            <p>
                                {{ $dataPengiriman['estimasi'] }} HARI
                            </p>
                        @endif
                    </div><hr>
                    <div class="form-group form-material">
                        <label>
                            <p><b>Daftar Belanja</b></p>
                        </label>
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
                                        <td><img src="{{ URL::asset('template/web/img/product') }}/{{$v->product->foto}}" class="img-cart" width="100px" height="200px" /></td>
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
                            {{--  @yield('admin.transaksi.tabledetail')  --}}
                            
                        </div>
                        @stop    
					
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6"> 
                                <div class="row text-right">
                                    <div class="col-md-offset-3 col-md-12">
                                        <a href="{{ url('admin/transaksi') }}" class="btn btn-inverse">Kembali</a>
                                        {{-- <button type="submit" class="btn btn-success">Submit</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection