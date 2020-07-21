@extends('layout.admin.app')
@section('title','custom')
@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Custom</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Edit Custom Kategori</li>
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
                <h4 class="m-b-0 text-white">Edit Custom Kategori</h4>
            </div>
            <div class="card-body">
				<form method="post" action="{{ url('/admin/editcustomsave', array($dataCustom->id)) }}" enctype="multipart/form-data">  
					{{ csrf_field() }}                 
                    <div class="form-group form-material">
                        <label>Nama Custom Kategori</label>
                        <input type="text" name="nama_custom" value="{{$dataCustom->nama_kategori}}" class="form-control form-control-line" required> 
                        @if($errors->has('nama_custom'))
                            <div class="text-danger">
                                {{ $errors->first('nama_custom')}}
                            </div>
                        @endif
                    </div>
					<div class="form-group form-material">
                        <label>Harga</label>
                        <input type="number" name="harga" value="{{$dataCustom->harga}}" class="form-control form-control-line" required> 
                        @if($errors->has('harga'))
                            <div class="text-danger">
                                {{ $errors->first('harga')}}
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
                                        <a href="{{ url('admin/custom') }}" class="btn btn-inverse">Cancel</a>
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