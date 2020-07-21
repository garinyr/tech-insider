@extends('layout.admin.app')
@section('title','transaksi')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Transaksi</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Detail Transaksi</li>
        </ol>
    </div>
    <div class="col-md-7 col-4 align-self-center">       
    </div>
</div>

<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-body">  
			@include('partials.admin.flash') 
            <div class="table-responsive m-t-15">			
                <table id="myTable" class="table table-bordered table-striped">
                    
                    <tbody>
							<tr>
								<td ><b>Kode Transaksi</b></td>
                                <td colspan="4">KDTR0{{$dataTransaksi->id}}</td>
                            </tr>
                            <tr>
                                <td ><b>Nama User</b></td>
                                <td colspan="4">{{$dataTransaksi->user->nama_depan}} {{$dataTransaksi->user->nama_belakang}}</td>
                            </tr>
                            <tr>
                                <td ><b>Nama Penerima</b></td>
                                <td colspan="4">{{ $dataPengiriman->nama_penerima}}</td>
                            </tr>
                            <tr>
                                <td ><b>No Hp</b></td>
                                <td colspan="4">{{$dataTransaksi['user']['no_hp']}}</td>
                            </tr>
                            <tr>
                                <td ><b>Alamat</b></td>
                                <td colspan="4">{{ $dataTransaksi->alamat}}</td>
                            </tr>
                            <tr>
                                <td ><b>Provinsi</b></td>
                                <td colspan="4">{{ $dataPengiriman['provinsi_tujuan']}}</td>
                            </tr>
                            <tr>
                                <td ><b>Kota/Kabupaten</b></td>
                                <td colspan="4">{{ $dataPengiriman['kota_tujuan']}}</td>
                            </tr>
                            <tr>
                                <td ><b>No Resi</b></td>
                                @if(!isset($dataPengiriman['resi_pengiriman']) || empty($dataPengiriman['resi_pengiriman']))
                                <td colspan="4">Belum Ada Data Resi</td>
                                @else
                                <td colspan="4">{{ $dataPengiriman['resi_pengiriman']}}</td>
                                @endif
                            </tr>
                            <tr>
                                <td ></td>
                                <td colspan="4"></td>
                            </tr>
                            <tr>
                                <td><b>Foto Produk</b></td>
                                <td><b>Nama Produk</b></td>
                                <td><b>Quantity</b></td>
                                <td><b>Harga Satuan</b></td>
                                <td><b>Total Harga</b></td>
                            </tr>
                            @if(!empty($dataOrder['custom_design']))
                            <tr>
                                <td><img src="{{ URL::asset('template/web/img/customOrder') }}/{{$dataProduk['foto']}}" class="img-cart" width="150px" height="150px" /></td>
                                <td><strong>{{$dataProduk['nama_barang']}}</strong></td>
                                <td>
                                    {{$dataOrder['qty']}}
                                </td>
                                <td>Rp. {{format_uang($dataProduk['harga'])}}</td>
                                <td>Rp. {{format_uang($dataOrder['total'])}}</td>
                            </tr>
                            
                            @else
                            @foreach($dataOrder as $v)
                                <tr>
                                    <td><img src="{{ URL::asset('template/web/img/product') }}/{{$v->product->foto}}" class="img-cart" width="150px" height="150px" /></td>
                                    <td><strong>{{$v->product->nama_barang}}</strong><p>Size : {{$v->ukuran}}</p></td>
                                    <td>
                                        {{$v->qty}}
                                    </td>
                                    <td>Rp. {{format_uang($v->harga)}}</td>
                                    <td>Rp. {{format_uang($v->total)}}</td>
                                </tr>
                            @endforeach
                            @endif
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
                                <td>Rp. {{format_uang($dataTransaksi['total'])}}</td>
                            </tr>                          
					</tbody>
                </table>
                
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
            </div>
        </div>
    </div>
    </div>
</div>



@endsection

@section('js')
<script>
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
</script>
@endsection