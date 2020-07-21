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
                <li class="breadcrumb-item">Add Custom Kategori</li>
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
                <h4 class="m-b-0 text-white">Add New Custom Kategori</h4>
            </div>
            <div class="card-body">
				<form method="post" action="{{ url('/admin/savecustom') }}" enctype="multipart/form-data">                   
				{{ csrf_field() }}
                    <div class="form-group form-material">
                        <label>Nama</label>
                        <input type="text" name="nama_custom" value="{{ old('nama_custom') }}" class="form-control form-control-line" required> 
                        @if($errors->has('nama_custom'))
                            <div class="text-danger">
                                {{ $errors->first('nama_custom')}}
                            </div>
                        @endif
                    </div>
					<div class="form-group form-material">
                        <label>Harga</label>
                        <input type="number" name="harga" value="{{ old('harga') }}" class="form-control form-control-line" required> 
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
@endsection