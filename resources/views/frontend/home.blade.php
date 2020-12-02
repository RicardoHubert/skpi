@extends('layout.master_frontend')

@section('content')



       <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
          @foreach($backgrounds as $image)
            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->index == 0 ? 'active' : null }}"></li>
          @endforeach
            <li data-target="#carouselExampleIndicators"></li>
          </ol>

          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="card-header card-header-image">
                <img class="img" src="{{ asset('background_image/' . $backgrounds->first()->file) }}" alt="First slide" style="height: 650px;object-fit:cover;opacity: 0.8;" width="100%">
                <div class="carousel-caption d-none d-md-block">
               </div>
             </div>
           </div>

          @foreach($backgrounds as $image)
            @if ($loop->first) @continue @endif

            <div class="carousel-item">
              <div class="card-header card-header-image">
                <img class="img" src="{{asset('background_image/'. $image->file)}}" alt="{{ $loop->index + 1}} slide" style="height: 650px;object-fit:cover; opacity: 0.8;" width="100%">
             
              <div class="carousel-caption d-none d-md-block">
                  <!-- <h3>Kalbis Institute </h3> -->
                <p>...</p>
              </div>
              </div>
            </div>
          @endforeach

          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
            
          </div>
           <div class="card">
                <div class="container">
    
              <div class="row">
                <div class="col-md-10 ml-auto mr-auto">
                  <h2 class="title">Kegiatan Ormawa</h2>
                  <br>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="card card-plain card-blog">
                        <div class="card-header card-header-image">
                          <img class="img img-raised" src="{{ asset($kegiatans[0]->poster) }}">
                          <div class="colored-shadow">
                            <img src="{{ asset($kegiatans[0]->poster) }}" alt="" style="opacity: 1">
                          </div></div>
                          <div class="card-body">
                            <h6 class="card-category text-info">{{ $kegiatans[0]->nama_kegiatan }}</h6>
                            <p class="card-description">
                              {{ $kegiatans[0]->deskripsi_kegiatan }}
                            </p>
                            {{ $kegiatans[0]->tanggal_kegiatan }}
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="card card-plain card-blog">
                          <div class="card-header card-header-image">
                            <img class="img img-raised" src="{{ asset($kegiatans[1]->poster) }}">
                          <div class="colored-shadow">
                            <img src="{{ asset($kegiatans[1]->poster) }}" alt="" style="opacity: 1">
                          </div></div>
                            <div class="card-body ">
                              <h6 class="card-category text-success">
                                {{ $kegiatans[1]->nama_kegiatan }}
                              </h6>
                              <p class="card-description">
                                {{ $kegiatans[1]->deskripsi_kegiatan }}
                              </p>
                              {{ $kegiatans[1]->tanggal_kegiatan }}
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="card card-plain card-blog">
                            <div class="card-header card-header-image">
                              <img class="img img-raised" src="{{ asset($kegiatans[2]->poster) }}">
                              <div class="colored-shadow">
                                <img src="{{ asset($kegiatans[2]->poster) }}" alt="" style="opacity: 1">
                              </div></div>
                              <div class="card-body ">
                                <h6 class="card-category text-danger">
                                {{ $kegiatans[2]->nama_kegiatan }}
                                </h6>
                                <p class="card-description">
                                {{ $kegiatans[2]->deskripsi_kegiatan }} 
                                </p>
                                {{ $kegiatans[2]->tanggal_kegiatan }}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
         

  
              <div class="row">
                <div class="col-md-10 ml-auto mr-auto">
                  <h2 class="title">Prestasi</h2>
                  <br>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="card card-plain card-blog">
                        <div class="card-header card-header-image">
                          <img class="img img-raised" src="{{ asset($prestasis[0]->poster) }}">
                          <div class="colored-shadow">
                            <img src="{{ asset($prestasis[0]->poster) }}" alt="" style="opacity: 1">
                          </div></div>
                          <div class="card-body">
                            <h6 class="card-category text-info">{{ $prestasis[0]->nama_kompetisi }}</h6>
                            {{$prestasis[0]->skala }} - {{$prestasis[0]->pencapaian }}
                            <p class="card-description">
                              {{ $prestasis[0]->tanggal_kegiatan }} - {{ $prestasis[0]->penyelenggara }}
                            </p>
                          </div>
                        </div>
                      </div>


                      <div class="col-md-4">
                        <div class="card card-plain card-blog">
                          <div class="card-header card-header-image">
                            <img class="img img-raised" src="{{ asset($prestasis[1]->poster) }}">
                          <div class="colored-shadow">
                            <img src="{{ asset($prestasis[1]->poster) }}" alt="" style="opacity: 1">
                          </div></div>
                            <div class="card-body ">
                              <h6 class="card-category text-success">
                                {{ $prestasis[1]->nama_kompetisi }}
                              </h6>
                              {{$prestasis[1]->skala }} - {{$prestasis[1]->pencapaian }}
                              <p class="card-description">
                                {{ $prestasis[1]->tanggal_kegiatan }} - {{ $prestasis[1]->penyelenggara }}
                              </p>
                            </div>
                          </div>
                        </div>


                        <div class="col-md-4">
                          <div class="card card-plain card-blog">
                            <div class="card-header card-header-image">
                              <img class="img img-raised" src="{{ asset($prestasis[2]->poster) }}">
                              <div class="colored-shadow">
                                <img src="{{ asset($prestasis[2]->poster) }}" alt="" style="opacity: 1">
                              </div></div>
                              <div class="card-body ">
                                <h6 class="card-category text-danger">
                                {{ $prestasis[2]->nama_kompetisi }}
                                </h6>
                                {{$prestasis[2]->skala }} - {{$prestasis[2]->pencapaian }}
                                <p class="card-description">
                                {{ $prestasis[2]->tanggal_kegiatan }} - {{ $prestasis[2]->penyelenggara }}
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
          </div>
        

    

@endsection