@extends('layout.master_frontend')

@section('content')
		<div class="container">
			<div class="row">
				<div class="card m6" style="margin-top: 80px;">
					
					<div class="card-body" style="margin-bottom: 10px">
						<form action="{{url('/pendaftaran_kegiatan/create')}}"  method="POST" enctype="multipart/form-data">
							{{ csrf_field() }}

						<div class="main" style="margin-bottom:40px;">
							<h2>Pendaftaran Kegiatan</h2>
						</div>
						
							<div class="form-group">
								<label>Nama</label>
								<input type="text" name="nama" class="form-control">
								
							</div>

							<div class="form-group">
								<label>NIM</label>
								<input type="text" name="nim" class="form-control">
							</div>

							<div class="form-group">
								<label>Jurusan</label>
								<input type="text" name="jurusan" class="form-control">
							</div>

							<div class="form-group">
								<label>Email</label>
								<input type="text" name="email" class="form-control">
							</div>

							<div class="form-group">
								<label>No Telepon</label>
								<input type="text" name="no_telp" class="form-control">

							</div>

							<div class="form-group">
								<label>Asal Kampus</label>
								<input type="text" name="asal_kampus" class="form-control">

							</div>

							<div class="form-group">
							<input type="hidden" name="kegiatan_id" class="form-control" value="{{$kegiatan->id}}">
						</div>

							<button type="submit" class="waves-effect waves-light btn">Simpan</button>
							<a href="{{url('/pendaftaran_kegiatan/create')}}"  class="waves-effect waves-light btn light-blue"><i class="material-icons">arrow_back</i></a>
						</form>
					</div>
				</div>
			</div>
		</div>
@endsection