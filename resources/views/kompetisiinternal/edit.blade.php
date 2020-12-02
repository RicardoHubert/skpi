@extends('layout.master')

@section('content')
<div class="main">
	<div class="main-control">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading">
						<h3 class="panel-title">Edit Data Kompetisi Internal</h3>
						</div>
						<div class="panel-body">
							<form action="{{url('/kompetisiinternal/'.$kompetisiinternal->id)}}/update" method="POST" enctype="multipart/form-data">
						{{csrf_field()}}	

						<x-form.wrapper title="Poster" required="true">
				      			<x-form.file name="poster" value="{{$kompetisiinternal->poster}}" required/>
				      	</x-form.wrapper>					

						<x-form.wrapper title="Nama Kompetisi" required="true">
			      			<x-form.input value="{{ $kompetisiinternal->nama_kompetisi }}" name="nama_kompetisi" required placeholder="Nama Kompetisi" />
			      		</x-form.wrapper>

			 		<x-form.wrapper title="Jenis Kompetisi" required="true">
		      			<select class="form-control" name="jenis_kompetisi" required>		      
					  <option value="">"------Pilih Jenis kompetisi-------"</option>
			      <option value="Internal">Internal</option>
			      <option value="Eksternal">Eksternal</option>
					    </select>
		      		</x-form.wrapper>

						<x-form.wrapper title="URL">
			      			<x-form.input value="{{ $kompetisiinternal->url }}" name="url" placeholder="URL " />
			      		</x-form.wrapper>

						<x-form.wrapper title="Judul Sertifikat" required="true">
			      			<x-form.input value="{{ $kompetisiinternal->sertifikat }}" name="sertifikat" required/>
			      		</x-form.wrapper>

				  <x-form.wrapper title="File Unggah Sertifikat" required="true">
				      			<x-form.file name="file_sertifikat" value="{{$kompetisiinternal->file_sertifikat}}" required/>
				  </x-form.wrapper>

				 	<x-form.wrapper title="Skala" required="true">
		      			<select class="form-control" name="skala" required>		      
					  <option value="">"------Pilih skala-------"</option>
			      <option value="Internal">Internal</option>
			      <option value="Eksternal">Eksternal</option>
					    </select>
		      		</x-form.wrapper>

				<x-form.wrapper title="Pencapaian" required="true">
		  			<x-form.input value="{{ $kompetisiinternal->pencapaian }}" name="pencapaian" required placeholder="Pencapaian " />
		  		</x-form.wrapper>

				 <x-form.wrapper title="Nama Kegiatan" required="true">
		  			<x-form.input value="{{ $kompetisiinternal->nama_kegiatan }}" name="nama_kegiatan" required placeholder="Nama Kegiatan " />
		  		</x-form.wrapper>

				 <x-form.wrapper title="Tanggal Kegiatan" required="true">
		  			<input readonly type="text" value="{{ $kompetisiinternal->tanggal_kegiatan }}" class="form-control datepicker date" name="tanggal_kegiatan" required placeholder="tanggal_kegiatan" />
		  		</x-form.wrapper>

				 <x-form.wrapper title="Penyelenggara" required="true">
		  			<x-form.input value="{{ $kompetisiinternal->penyelenggara }}" name="penyelenggara" required placeholder="Penyelenggara " />
		  		</x-form.wrapper>



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
		$(document).ready(function() {
			$(".datepicker.date").datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
      		changeYear: true
		});
});
</script>
@stop