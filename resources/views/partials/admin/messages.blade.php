@php

$dataNotifikasi = \App\Models\Notifikasi::join('users','tb_notifikasi.user_id','users.id')
	->where("tb_notifikasi.status_read","0")->where("tb_notifikasi.user_id",Auth::user()->id)->orderBy('tb_notifikasi.created_at', 'DESC')
	->select(
                  'users.nama_lengkap',
				  'users.foto_profile',
				  'tb_notifikasi.id_notifikasi',
				  'tb_notifikasi.class',
				  'tb_notifikasi.donasi_id',
                  'tb_notifikasi.keterangan',
				  'tb_notifikasi.link',
                  'tb_notifikasi.created_at'
          )->take(3)
	->get();

$countNotifikasi = $dataNotifikasi->count();
@endphp

@if($countNotifikasi > 0)
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
		<!-- masukin didatabase class notify -->
        <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
    </a>
    <div class="dropdown-menu mailbox dropdown-menu-right scale-up" aria-labelledby="2">
        <ul>
            <li>
                <div class="drop-title">You have new Notifications</div>
            </li>
            <li>
                <div class="message-center">
					@foreach($dataNotifikasi as $v)
						<!-- Message online busy away offline -->
						<a href="{{route($v->link, ['download4'=>$v->donasi_id, 'download3'=>$v->id_notifikasi])}}">
							<div class="user-img"> <img src="@if (empty($v->foto_profile)){{ URL::asset('dashboard-material/images/temanbaikku/Logokecil.png') }}@else{{ url('/') }}/dashboard-material/uploads/images/profile/{{$v->foto_profile}}@endif" alt="user" class="img-circle"> <span class="profile-status {{$v->class}} pull-right"></span> </div>
							<div class="mail-contnet">
								<h5>{{str_limit(strip_tags($v->nama_lengkap),16)}}</h5> <span class="mail-desc">{{$v->keterangan}}</span> <span class="time">{{$v->created_at}}</span> </div>
						</a>
						<!-- Message -->
					@endforeach
                </div>
            </li>
            <!-- <li>
				<a class="nav-link text-center" href=""> <strong>See all notify</strong></a>
            </li> -->
        </ul>
    </div>
</li>

@else
<!-- ini jika tidak ada notify -->
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
        <div class="fauzan"> <span class="heartbit"></span> <span class="point"></span> </div>
    </a>
</li>
@endif