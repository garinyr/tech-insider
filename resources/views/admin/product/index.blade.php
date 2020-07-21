@extends('layout.admin.app')
@section('title','product')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Product</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">List Product</li>
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
			<a href="{{ url('admin/product') }}" class="btn btn-info"><i class="fa fa-table"></i> Show Data</a>       
            <a href="{{ url('admin/addproduct') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add Data</a>           
            <div class="table-responsive m-t-15">
			
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
						 	<th>No</th>
                            {{--  <th>Kode Product</th>  --}}
                            <th>Nama Product</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Foto</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
						@php $no = 1; @endphp
                        @foreach ($dataProduct as $data)    
                        <tr>
                            <td>{{$no++}}</td>
                            {{--  @if(  $data->id < 10 )
                            <td>KDTR - 0{{$data->id}}</td>
                            @else
                            <td>KDTR - {{$data->id}}</td>
                            @endif  --}}
							<td>{{$data->nama_barang}}</td>
							<td>Rp. {{format_uang($data->harga)}}</td>
							
                            <td>{{$data->stok}}</td>
                            <td>
								<button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal{{$data->id}}">
									<i class="mdi mdi-eye"></i>
								</button>
								<div class="modal fade" id="exampleModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">{{$data->foto}}</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										</div>
										<div class="modal-body">
											<!-- <img src="{{url('/')}}/template/web/img/product/{{$data->foto}}" alt=""> -->
											<div class="card">
												<img class="card-img-top img-responsive" src="{{url('/')}}/template/web/img/product/{{$data->foto}}" alt="Card image cap">
											</div>
										</div>                                    
									</div>  
									</div>
								</div>
                            </td>
                            <td>
                                <a href="{{url('admin/editproduct')}}/{{$data->id}}" class="btn btn-info">
									Update
                                </a>
                                <a style="margin : 5px;" href="{{url('admin/deletebarang')}}/{{$data->id}}" onclick="return confirm('Are You Sure Delete this?')" class="btn btn-danger" title="Delete Data">
                                    Delete
                                </a>
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