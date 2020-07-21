@extends('layout.admin.app')
@section('title','custom')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Custom</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">List Custom Kategori</li>
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
			<a href="{{ url('admin/custom') }}" class="btn btn-info"><i class="fa fa-table"></i> Show Data</a>       
            <a href="{{ url('admin/addcustom') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add Data</a>           
            <div class="table-responsive m-t-15">
			
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
						 	<th>No</th>
                            {{--  <th>Kode Product</th>  --}}
                            <th>Nama Product</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
						@php $no = 1; @endphp
                        @foreach ($dataProduct as $data)    
                        <tr>
                            <td>{{$no++}}</td>
							<td>{{$data->nama_kategori}}</td>
							<td>Rp. {{format_uang($data->harga)}}</td>
                            <td>
                                <a href="{{url('admin/editcustom')}}/{{$data->id}}" class="btn btn-info">
									Update
                                </a>
                                <a style="margin : 5px;" href="{{url('admin/deletecustom')}}/{{$data->id}}" onclick="return confirm('Are You Sure Delete this?')" class="btn btn-danger" title="Delete Data">
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