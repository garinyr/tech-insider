@extends('layout.web.app')
@section('title','Home')

@section('content')
<!-- begin:content -->
<div class="col-md-12 col-sm-8 content">
  <div class="row">
    <div class="col-md-12">

      <h3>Payment Confirmation</h3>
      <hr />

      <div class="box">
        <div class="box-head">
          <h3>Send Payment Confirmation</h3>
        </div>
        <div class="box-content">
          <form class="form-horizontal" method="post" action="{{ url('save-payment') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
              <label class="col-sm-3 control-label">Invoice</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" value="{{$kodeDepan}}" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Bank</label>
              <div class="col-sm-8">
                <select class="form-control" name="data_bank" required>
                  <option value="0">-- Pilih Bank --</option>
                  @foreach($dataBank as $v)
                  <option value="{{$v->id}}">{{$v->nama_bank}}</option>
                  @endforeach
                </select>
                <br>
                @if($errors->has('data_bank'))
                <div class="text-danger">
                  {{ $errors->first('data_bank')}}
                </div>
                @endif
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Attach File</label>
              <div class="col-sm-8">
                <img src="" id="showgambar" style="padding: 5px 5px 15px 0px; width: 100%">
                <input type="file" name="bukti_foto" id="inputgambar" class="input-file" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-8 col-sm-offset-3">
                <input type="submit" class="btn btn-primary" style="width: 25%">
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="box">
        <div class="box-head">
          <h3>Bank Account</h3>
        </div>
        <div class="box-content">
          <form class="form-horizontal" method="post" action="{{ url('save-payment') }}" enctype="multipart/form-data">
            @foreach($dataBank as $v)
            <div class="form-group">
              <label class="col-sm-3 control-label">{{$v->nama_bank}}</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" value="{{$v->no_rek}}" readonly>
              </div>
            </div>
            @endforeach
            <div class="form-group">
                <label class="col-sm-12 control-label" style="text-align: center">Nomor rekening diatas ATAS NAMA : GARIN YR</label>
              </div>
            @if($errors->has('data_bank'))
            <div class="text-danger">
              {{ $errors->first('data_bank')}}
            </div>
            @endif
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
<!-- end:content -->
@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
  $(document).ready(function(){
      $('#image-preview').hide();
      
    });
    
    
    $("#inputgambar").change(function () {
      $('#showgambar').show();
          readURL(this);
  
      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
  
          reader.onload = function (e) {
            // alert(e.target.result);
            $('#showgambar').attr('src', e.target.result).show();
          }
  
          reader.readAsDataURL(input.files[0]);
        }
      }
      });
      
      function myFunction() {
		$('#showgambar').attr('src', '');
	}

// function previewImage() {
//     document.getElementById("image-preview").style.display = "block";
//     var oFReader = new FileReader();
//      oFReader.readAsDataURL(document.getElementById("image-source").files[0]);
 
//     oFReader.onload = function(oFREvent) {
//       document.getElementById("image-preview").src = oFREvent.target.result;
//     };
//   };
</script>
@endsection