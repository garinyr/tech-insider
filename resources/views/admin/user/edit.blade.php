@extends('layout.admin.app')
@section('title','User')
@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">User</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Edit User</li>
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
                <h4 class="m-b-0 text-white">Edit User</h4>
            </div>
            <div class="card-body">
				<form method="post" action="{{ url('/admin/editusersave', array($dataUser->id)) }}" enctype="multipart/form-data">  
					{{ csrf_field() }}                 
                    <div class="form-group form-material">
                        <label>Nama User</label>
                        <input type="text" name="nama_user" value="{{$dataUser->name}}" class="form-control form-control-line"> 
                        @if($errors->has('nama_user'))
                            <div class="text-danger">
                                {{ $errors->first('nama_user')}}
                            </div>
                        @endif
                    </div>
					<div class="form-group form-material">
                        <label>Email</label>
                        <input type="text" name="email" value="{{$dataUser->email}}" class="form-control form-control-line"> 
                        @if($errors->has('email'))
                            <div class="text-danger">
                                {{ $errors->first('email')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group form-material">
                        <label>No. HP</label>
                        <input type="number" name="hp" value="{{$dataUser->no_hp}}" class="form-control form-control-line"> 
                        @if($errors->has('hp'))
                            <div class="text-danger">
                                {{ $errors->first('hp')}}
                            </div>
                        @endif
                    </div>
                    {{--  <div class="form-group form-material">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" cols="30" rows="10">{{$dataUser->alamat}}</textarea>
                        @if($errors->has('alamat'))
                            <div class="text-danger">
                                {{ $errors->first('alamat')}}
                            </div>
                        @endif
                    </div>  --}}
                    <div class="form-group form-material">
                        <label>New Password</label>
                        <input type="password" name="password" class="form-control" cols="30" rows="10"></input>
                        @if($errors->has('password'))
                            <div class="text-danger">
                                {{ $errors->first('password')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group form-material">
                        <label>Status</label>
                        <select class="form-control form-control-line" name="status" >
                            @if($dataUser->modul_name == 1 )
                            <option value="1" selected>Super Admin</option>
                            <option value="0">User</option>
                            @else
                            <option value="1" >Super Admin</option>
                            <option value="0"selected>User</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-6">
                                
                            </div>
                            <div class="col-md-6"> 
                                <div class="row text-right">
                                    <div class="col-md-offset-3 col-md-12">
                                        <a href="{{ url('admin/user') }}" class="btn btn-inverse">Cancel</a>
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