@extends('layout.admin.app')
@section('title','transaksi')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Transaksi</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">List Transaksi</li>
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
                    <thead>
                        <tr>
							<th>No</th>
                            <th>Kode Transaksi</th>
                            <th width="20%">Nama User</th>
                            <th width="20%">Total</th>
                            <th>Status</th>
                            <th>Bukti Transfer</th>
                            {{-- <th>Detail</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
						@php $no = 1; @endphp
                         @foreach ($dataTransaksi as $data) 
                         @php
                            $dataOrder = App\Models\Order::where('transaksi_id', $data['id'])->get();
                            if(!empty($dataOrder['custom_design'])){
                                $kode = 'KDTR - 0';
                            }
                         @endphp   
							<tr>
                                <td>{{$no++}}</td>
                                <td>{{$data->kd_transaksi}}</td>
                                {{-- @if(!empty($dataOrder['custom_design']))
                                    @if(  $data->id < 10 )
                                    <td>KDTR - 0{{$data->id}}</td>
                                    @else
                                    <td>KDTR - {{$data->id}}</td>
                                    @endif
                                @else
                                    @if(  $data->id < 10 )
                                    <td>Custom - 0{{$data->id}}</td>
                                    @else
                                    <td>Custom - {{$data->id}}</td>
                                    @endif
                                @endif --}}
								<td>{{$data->user->nama_depan}}</td>
								<td>Rp. {{ format_uang($data->total) }}</td>
								<td>
                                <center>
								@if($data->status_pembayaran == 1)
									<span class="label label-warning">Pending</span>
								@elseif($data->status_pembayaran == 2)
									<span class="label label-success">Sudah Dibayar</span>
								@elseif($data->status_pembayaran == 3)
									<span class="label label-info">Sudah Dikirim</span>
                                @else
                                    <span class="label label-danger">Reject</span>
								@endif
                                </center>
                                </td>
                                <td>
                                <center>
                                    <button style="margin : 5px;" type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal{{$data->id}}">
										<i class="mdi mdi-eye"></i>
								    </button>
                                    
                                </center>
                                    <div class="modal fade" id="exampleModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{$data->bukti_foto}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- <img src="https://thefutureorganization.com/wp-content/uploads/2008/07/google-logo-300x211.jpg" alt=""> -->
                                                <div class="card">
                                                    <img class="card-img-top img-responsive" src="{{url('/')}}/template/web/img/bukti_pembayaran/{{$data->bukti_foto}}" alt="Card image cap">
                                                </div>
                                            </div>                                    
                                            </div>  
                                        </div>
                                    </div>
                                </td>
								{{-- <td>
                                    <a href="{{url('admin/viewtransaksi')}}/{{$data->id}}" class="btn btn-info">
                                        <i class="mdi mdi-account"></i>
                                    </a>
								</td> --}}
								<td>
                                <a style="margin : 5px;" href="{{url('admin/viewtransaksi')}}/{{$data->id}}" class="btn btn-info" title="Detail">
                                    <i class="mdi mdi-account-card-details"></i>
                                </a>
								@if($data->status_pembayaran == 1)
									<a style="margin : 5px;" href="{{url('admin/acctransaksi')}}/{{$data->id}}" onclick="return confirm('Are You Sure Approve this?')" class="btn btn-info" title="Approve">
										<i class="fa fa-check"></i>
									</a>

									<a style="margin : 5px;" href="{{url('admin/rejecttransaksi')}}/{{$data->id}}" onclick="return confirm('Are You Sure Reject this?')" class="btn btn-danger" title="Reject">
										<i class="fa fa-ban"></i>
									</a>
								@elseif($data->status_pembayaran == 2)
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#inputresi{{$data->id}}">
										<i class="fa fa-barcode"></i>
                                        Input Resi
								    </button>
                                    <div class="modal fade" id="inputresi{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Masukan No Resi</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{ url('/admin/saveresi',array($data->id)) }}" enctype="multipart/form-data">
         			                                {{ csrf_field() }}              
                                                    <div class="form-group form-material">
                                                        {{-- <label>Nomor Resi</label> --}}
                                                        <input type="text" name="no_resi" value="" class="form-control form-control-line" required=""> 
                                                    </div>
                                                    
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                
                                                            </div>
                                                            <div class="col-md-6"> 
                                                                <div class="row text-right">
                                                                    <div class="col-md-offset-3 col-md-12">
                                                                        <a href="{{ url('/admin/transaksi') }}" class="btn btn-inverse">Cancel</a>
                                                                        <button type="submit" class="btn btn-success">Submit</button>
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
                                
                                @else
								@endif
								</td>                            
							</tr>
						@endforeach                           
					</tbody>
				</table>
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