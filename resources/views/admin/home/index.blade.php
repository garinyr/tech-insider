@php

use App\Models\Transaksi;

 $tahun = $datatahun;
        $januari = $tahun.'-01';
        $febuari = $tahun.'-02';
        $maret = $tahun.'-03';
        $april = $tahun.'-04';
        $mei = $tahun.'-05';
        $juni = $tahun.'-06';
        $juli = $tahun.'-07';
        $agustus = $tahun.'-08';
        $september = $tahun.'-09';
        $oktober = $tahun.'-10';
        $november = $tahun.'-11';
        $desember = $tahun.'-12';

        $datajanuari = Transaksi::where('status_pembayaran', 2)->whereBetween('updated_at', [$januari.'-01', $januari.'-31'])->count();
        $datafebuari = Transaksi::where('status_pembayaran', 2)->whereBetween('updated_at', [$febuari.'-01', $febuari.'-31'])->count();
        $datamaret = Transaksi::where('status_pembayaran', 2)->whereBetween('updated_at', [$maret.'-01', $maret.'-31'])->count();
        $dataapril = Transaksi::where('status_pembayaran', 2)->whereBetween('updated_at', [$april.'-01', $april.'-31'])->count();
        $datamei = Transaksi::where('status_pembayaran', 2)->whereBetween('updated_at', [$mei.'-01', $mei.'-31'])->count();
        $datajuni = Transaksi::where('status_pembayaran', 2)->whereBetween('updated_at', [$juni.'-01', $juni.'-31'])->count();
        $datajuli = Transaksi::where('status_pembayaran', 2)->whereBetween('updated_at', [$juli.'-01', $juli.'-31'])->count();
        $dataagustus = Transaksi::where('status_pembayaran', 2)->whereBetween('updated_at', [$agustus.'-01', $agustus.'-31'])->count();
        $dataseptember = Transaksi::where('status_pembayaran', 2)->whereBetween('updated_at', [$september.'-01', $september.'-31'])->count();
        $dataoktober = Transaksi::where('status_pembayaran', 2)->whereBetween('updated_at', [$oktober.'-01', $oktober.'-31'])->count();
        $datanovember = Transaksi::where('status_pembayaran', 2)->whereBetween('updated_at', [$november.'-01', $november.'-31'])->count();
        $datadesember = Transaksi::where('status_pembayaran', 2)->whereBetween('updated_at', [$desember.'-01', $desember.'-31'])->count();

        $kumpulan = [];
        $kumpulandata=array(
            'datajanuari'=>$datajanuari,
            'datafebuari'=>$datafebuari,
            'datamaret'=>$datamaret,
            'dataapril'=>$dataapril,
            'datamei'=>$datamei,
            'datajuni'=>$datajuni,
            'datajuli'=>$datajuli,
            'dataagustus'=>$dataagustus,
            'dataseptember'=>$dataseptember,
            'dataoktober'=>$dataoktober,
            'datanovember'=>$datanovember,
            'datadesember'=>$datadesember,
        );
@endphp
@extends('layout.admin.app')
@section('title','Home')

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Dashboard</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Home</li>
        </ol>
    </div>
    <div class="col-md-7 col-4 align-self-center">
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->

<!-- Row -->
@include('partials.admin.flash')
<div class="row">
     <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                    <form action="{{ url('/admin') }}" method="GET">
                            <div class="row">                                
                                    {{ csrf_field() }}
                                    <div class="col-sm-5">
                                    <input type="number" name="tahun" placeholder="input tahun" class="form-control">
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-primary">submit</button>
                                    </div>
                            </div>
                        </form>
               </div>
                <canvas id="myChart" height="400"></canvas>
           
        </div>
    </div> 
</div>

<!-- Row -->

<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
@endsection

@section('js')
<script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober','November','Desember'],
                datasets: [{
                    label: 'Laporan Penjualan Tahun {{$tahun}}',
                    data: [{{$kumpulandata['datajanuari']}},
                        {{$kumpulandata['datafebuari']}},
                        {{$kumpulandata['datamaret']}},
                        {{$kumpulandata['dataapril']}},
                        {{$kumpulandata['datamei']}},
                        {{$kumpulandata['datajuni']}},
                        {{$kumpulandata['datajuli']}},
                        {{$kumpulandata['dataagustus']}},
                        {{$kumpulandata['dataseptember']}},
                        {{$kumpulandata['dataoktober']}},
                        {{$kumpulandata['datanovember']}},
                        {{$kumpulandata['datadesember']}}
                        
                        ],
                    backgroundColor: [
                        '#C32145',
                        '#C32145',
                        '#C32145',
                        '#C32145',
                        '#C32145',
                        '#C32145',
                        '#C32145',
                        '#C32145',
                        '#C32145',
                        '#C32145',
                        '#C32145',
                        '#C32145'
                    ],
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        </script>
@endsection