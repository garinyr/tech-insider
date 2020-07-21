@extends('layout.admin.app')
@section('title','product')
@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Product</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Edit Product</li>
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
                <h4 class="m-b-0 text-white">Edit Product</h4>
            </div>
            <div class="card-body">
				<form method="post" action="{{ url('/admin/editproductsave', array($dataProduct->id)) }}" enctype="multipart/form-data">  
					{{ csrf_field() }}                 
                    <div class="form-group form-material">
                        <label>Nama Product</label>
                        <input type="text" name="nama_barang" value="{{$dataProduct->nama_barang}}" class="form-control form-control-line" required> 
                        @if($errors->has('nama_barang'))
                            <div class="text-danger">
                                {{ $errors->first('nama_barang')}}
                            </div>
                        @endif
                    </div>
					<div class="form-group form-material">
                        <label>Harga</label>
                        <input type="number" name="harga" value="{{$dataProduct->harga}}" class="form-control form-control-line" required> 
                        @if($errors->has('harga'))
                            <div class="text-danger">
                                {{ $errors->first('harga')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group form-material">
                            <label>Status Barang</label>
                            {{-- <input type="number" name="harga" value="{{$dataProduct->harga}}" class="form-control form-control-line" required>  --}}
                            <select class="form-control form-control-line" name="status_aktif" >
                                <option value="1">Tersedia</option>
                                <option value="2">Tidak Tersedia</option>
                            </select>
                           
                        </div>
                    <div class="form-group form-material">
						<label>Foto </label>
						<div class="card">
							<img class="card-img-top img-responsive" src="{{url('/')}}/template/web/img/product/{{$dataProduct->foto}}" alt="Card image cap">
						</div>
                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                            <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file" style="background:#F2F4F5;border-color:#92a8d1;border-bottom: 0px solid #ffffff;"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                            <input type="hidden">
                            <input type="file" name="foto"> </span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput" style="background:#F2F4F5;border-color:#92a8d1;border-bottom: 0px solid #ffffff;">Remove</a> </div>
                        @if($errors->has('foto'))
                            <div class="text-danger">
                                {{ $errors->first('foto')}}
                            </div>
                        @endif
                    </div>
                    {{-- <div class="form-group form-material">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" cols="30" rows="10" required>{{$dataProduct->deskripsi}}</textarea>
                            @if($errors->has('deskripsi'))
                                <div class="text-danger">
                                    {{ $errors->first('deskripsi')}}
                                </div>
                            @endif
                        </div> --}}
                        <div class="form-group">
                            <label>Cerita</label>
                             <textarea id="froala-editor" name="deskripsi">{!! $dataProduct->deskripsi !!}</textarea required>                     
                            @if($errors->has('deskripsi'))
                                <div class="text-danger">
                                    {{ $errors->first('deskripsi')}}
                                </div>
                            @endif
                        </div>
                        <div class="form-group form-material">
                            <label>Berat (gr)</label>
                            <input type="number" value="{{$dataProduct->berat}}" name="berat" class="form-control" cols="30" rows="10" required></input>
                            @if($errors->has('berat'))
                                <div class="text-danger">
                                    {{ $errors->first('berat')}}
                                </div>
                            @endif
                        </div>
                        <div class="form-group form-material">
                            <label>Stok</label>
                            <input type="number" value="{{$dataProduct->stok}}" name="stok" class="form-control" cols="30" rows="10" required></input>
                            @if($errors->has('stok'))
                                <div class="text-danger">
                                    {{ $errors->first('stok')}}
                                </div>
                            @endif
                        </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-6">
                                
                            </div>
                            <div class="col-md-6"> 
                                <div class="row text-right">
                                    <div class="col-md-offset-3 col-md-12">
                                        <a href="{{ url('admin/product') }}" class="btn btn-inverse">Cancel</a>
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
@endsection

@section('js')
<script>
	(function () {
	new FroalaEditor("#froala-editor", {
		imageInsertButtons: ['imageBack', '|', 'imageByURL'],
		imageResizeWithPercent: true,
		videoResponsive: true,
		imageEditButtons: ['imageReplace', 'imageRemove', '|', 'imageLink', 'linkOpen', 'linkEdit', 'linkRemove', '-', 'imageSize'],
        imageUploadRemoteUrls: false
	})
	})()
</script>
@endsection