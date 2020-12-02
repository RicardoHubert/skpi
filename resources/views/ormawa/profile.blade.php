@extends('layout.master')

@section('content')

<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<div class="panel panel-profile">
						<div class="clearfix">
							<!-- LEFT COLUMN -->
							<div class="profile-left">
								<!-- PROFILE HEADER -->
								<div class="profile-header">
									<div class="overlay"></div>
									<div class="profile-main" style="background-image: url('{{$ormawa->getAvatar()}}'); height: 200px; width: 100%">
									</div>
									<div class="profile-stat">
										<div class="row">
											<div class="col-md-12 stat-item">
												{{$ormawa->nama_ormawa}}
											</div>
										</div>
									</div>
								</div>
								<!-- END PROFILE HEADER -->
								<!-- PROFILE DETAIL -->
								<div class="profile-detail" style="background-color: white;">
									<div class="profile-info">
										<h4 class="heading">Data Ormawa</h4>
										<ul class="list-unstyled list-justify">
											<li>Kategori Ormawa <span>{{$ormawa->kategori_ormawa}}</span></li>
											<li>Visi <span>{{$ormawa->visi}}</span></li>
											<li>Misi <span>{{$ormawa->misi}}</span></li>
											
										</ul>
									</div>
									
									<div class="text-center"><a class="btn btn-warningf" href="/ormawa/{{$ormawa->id}}/edit">Edit Profile</a></div>
								</div>
								<!-- END PROFILE DETAIL -->
							</div>
							<!-- END LEFT COLUMN -->
							<!-- RIGHT COLUMN -->
							<div class="profile-right">

								<!-- TABBED CONTENT -->
								<div class="custom-tabs-line tabs-line-bottom left-aligned">
									<ul class="nav" role="tablist">
										<li class="active"><a role="tab" href="#tab-bottom-left1" data-toggle="tab">Aktivitas terakhir</a></li>
									</ul>
								</div>
								<div class="tab-content">
									<div class="tab-pane fade in active" id="tab-bottom-left1">
										<ul class="list-unstyled activity-timeline">
											@php
												$kegiatans = \App\Kegiatan::where('ormawa_id', request()->segment(2))->get();
											@endphp
											
                                			@foreach($kegiatans as $kegiatan)   
											<li>
												<i class="fa fa-comment activity-icon"></i>
												<p>{{ $kegiatan->nama_kegiatan }} <a href="/ormawa/{{ request()->segment(2) }}">{{ $kegiatan->deskripsi_kegiatan }}</a> <span class="timestamp">{{ $kegiatan->tanggal_kegiatan }}</span></p>
											</li>
											@endforeach
										</ul>
									
									</div>
								</div>
								<!-- END TABBED CONTENT -->
							</div>
							<!-- END RIGHT COLUMN -->
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>

@stop