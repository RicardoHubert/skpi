@extends('layout.master')

@section('content')
<div class="main">
	<div class="main-control">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading">
						<h3 class="panel-title">Edit Data Kegiatan</h3>
						</div>
						<div class="panel-body">

							<form action="{{url('/kegiatan/'.$kegiatan->id)}}/update" method="POST" enctype="multipart/form-data">
						{{csrf_field()}}

						<x-form.wrapper title="Poster" required="true">
				      			<x-form.file name="poster" value="{{$kegiatan->poster}}" />	
				      	</x-form.wrapper>

							  <x-form.wrapper title="Nama/Tema Kegiatan" required="true">
				      			<x-form.input name="nama_kegiatan" required placeholder="Nama Kompetisi"  value="{{$kegiatan->nama_kegiatan}}"/>
				      		</x-form.wrapper>

				      		<x-form.wrapper title="Tanggal Kegiatan" required="true">
				      			<input readonly name="text" name="tanggal_kegiatan" class="form-control datepicker date" required placeholder="Tanggal Kegiatan"  value="{{$kegiatan->tanggal_kegiatan}}"/>

				      		</x-form.wrapper>


						<x-form.wrapper title="Deskripsi Kegiatan" required="true">
				      		<x-form.input name="deskripsi_kegiatan" required placeholder="Deskripsi Kegiatan"  value="{{$kegiatan->deskripsi_kegiatan}}"/>
				      	</x-form.wrapper>


				      	<div class="form-group">
							    <label for="exampleInputEmail1">Jenis Dokumen</label>
							    <select class="form-control" id="exampleFormControlSelect1" name="sertifikat" required>
							      <option value="">"------Pilih-------"</option>
							      <option value="SK" {{ $kegiatan->jenis_dokumen == 'SK' ? 'selected' : null }}>Surat Keputusan (SK)</option>
							      <option value="SERTIFIKAT" {{ $kegiatan->jenis_dokumen == 'SERTIFIKAT' ? 'selected' : null }}>Sertifikat</option>
							      <option value="STU" {{ $kegiatan->jenis_dokumen == 'STU' ? 'selected' : null }}>Surat Tugas (STU)</option>
							      <option value="PIAGAM" {{ $kegiatan->jenis_dokumen == 'PIAGAM' ? 'selected' : null }}>Piagam</option>

							      <option value="Lain-lain" {{ $kegiatan->jenis_dokumen == 'Lain-lain' ? 'selected' : null }}>Lain-lain</option>
							   
							    </select>


						</div>





							<button type="submit" class="btn btn-warning">Update</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$(".datepicker.date").datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
      		changeYear: true
		});
});
</script>
@stop