@extends('layout.admin.app')
@section('title','User')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">User</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">List User</li>
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
                            <th>Nama User</th>
                            <th>Email</th>
							<th>Nomor Hp</th>
                            {{--  <th>Alamat</th>  --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
						@php $no = 1; @endphp
						@foreach ($dataUser as $data)    
                        <tr>
							<td>{{$no++}}</td>
                            <td>{{$data->nama_depan}} {{$data->nama_belakang}}</td>
                            <td>{{$data->email}}</td>
							<td>{{$data->no_hp}}</td>
                            {{--  <td>{{$data->alamat}}</td>  --}}
                            <td>
                                <a href="{{url('admin/edituser')}}/{{$data->id}}" class="btn btn-info">Update</a>
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