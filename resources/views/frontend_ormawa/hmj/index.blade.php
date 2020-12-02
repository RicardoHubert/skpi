@extends('layout.master_frontend')

@section('content')

    <!-- <div class="page-header header-filter header-small" data-parallax="true" style="background-image: url({{url('bg_ormawa/back_tracerstudy.jpg')}});"> -->
        <div class="page-header header-filter header-small data-parallax=true">
        <img src="{{asset('bg_ormawa/'.$ormawa->bg_ormawa)}}"  style="height: 100%;object-fit:cover;opacity: 0.8; width: 55%;">
          <div class="container">
            <h1 class="title text-center">{{$ormawa->nama_ormawa}}</h1>
            <h4 class="title text-center">Active</h4>
 <!--            <img  src="{{asset('logo//'.$ormawa->logo_ormawa)}}" style="height: 200px;opacity: 0.8;" width="30%"> -->

        </div>
        </div>
    </div>


    

        <div class="tab-content tab-space">
            <div class="tab-pane active show" id="agenda">
                <div class="blogs-4" id="blogs-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="title">Kegiatan Terakhir</h2>
                            </div>
                        </div>
                    </div>

                                <?php
                                    $jumlah = 0; ?>
                                <?php 
                                    $total = 3; ?>
                                @foreach($data_kegiatan as $kegiatan)   
                               
                                @if($kegiatan->ormawa_id == $ormawa->id)
                              

                                <div class="card card-plain card-blog">
                                <div class="container">
                                <div class="row">
                              
                                    <div class="col-md-6">
                                        <div class="card-header card-header-image">
                                            <a target="_blank" href="{{asset($kegiatan->poster)}}">
                                                <img class="img" src="{{asset($kegiatan->poster)}} " style="height: 250px; ">
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <h3 class="card-title">
                                            <a href="#pablo">{{$kegiatan->nama_kegiatan}}</a>
                                        </h3>
                                        <hr>
                                        <p class="card-description">
                                            {{$kegiatan->deskripsi_kegiatan}}  </p>                                 
                                        <ul>
                                         <li class="row">Tanggal : {{ date('d-M-Y', strtotime($kegiatan->tanggal_kegiatan))}}
                                        </li>
                                        </ul>
                                   
                                    
                                     @if($kegiatan->status == '0' || $kegiatan->status == null)
                                    <span class="badge badge-danger">On Progress</span>
                                    
                                   
                                   

                                    
                                                    @else
                                                        <span class="badge badge-success">Sudah Di Approved</span>
                                                        <a href="{{url('/pendaftaran_kegiatan/'.$kegiatan->id)}}" class="btn btn-sm btn-warning">Daftar</a>
                                                    @endif
                                    
                                    </div>                               
                                    </div>
                                    </div>
                               
                                @endif
                                @endforeach
                            </div>
                        </div>

                <div class="tab-content tab-space">
            <!-- <div class="tab-pane active show" id="agenda">
                <div class="blogs-4" id="blogs-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="title">Prestasi</h2>
                            </div>
                        </div>
                    </div>
                                @php
                                    $ormawaId = request()->segment(2);
                                    $kegiatan = \App\Kegiatan::where('ormawa_id', $ormawaId)->get()->pluck('id');
                                    $files = \App\FileKompetisiInternal::whereIn('kompetisiinternal_id', $kegiatan)->get()->take(2);
                                @endphp
                                @foreach($files as $kegiatan)   
                              

                                <div class="card card-plain card-blog">
                                <div class="container">
                                <div class="row">
                              
                                    <div class="col-md-6">
                                        <div class="card-header card-header-image">
                                            <a target="_blank" href="{{asset('kompetisiinernal/'.$kegiatan->file)}}">
                                                <img class="img" src="{{asset('kompetisiinernal/'.$kegiatan->file)}}" style="max-width: 30%;height: 250px;object-fit: ">
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <h3 class="card-title">
                                            <a href="#pablo">{{$kegiatan->kegiataninternal->nama_kegiatan}}</a>
                                        </h3>
                                        <hr>
                                        <p class="card-description">
                                            {{$kegiatan->kegiataninternal->deskripsi_kegiatan }}  </p>                                 
                                        <ul>
                                         <li class="row">Tanggal : {{ date('d-M-Y', strtotime($kegiatan->kegiataninternal->tanggal_kegiatan))}}
                                        </li>
                                        </ul>
                                   
                                    
                                    </div>                               
                                    </div>
                                    </div>
                               
                                @endforeach
                            </div>
                        </div> -->
            
            <div class="main main-raised">
        <div class="container">
            
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>VISI</h2>
                            <p class="justify"> {{$ormawa->visi}}</p>
                            <br>
                            <br>
                        </div>
                        <div class="col-md-6">
                            <h2>MISI</h2>
                            <p class="justify"> {{$ormawa->misi}}</p>
                        </div>
                    </div>
                </div>
            
        </div>
    </div>
                          <!--   <h1 class="text-center">Kegiatan Terakhir</h1> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</html>
@endsection
