@extends('layout.master')

@section('content')

<div class="main">
	<div class="main-control">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading">
						<h3 class="panel-title">Edit Data Skpi</h3>

						</div>
						<div class="panel-body">
							<form action="{{url('/skpi/'.$data_skpi->id)}}/update" method="POST" enctype="multipart/form-data">
						{{csrf_field()}}

							
				      		  <div class="form-group">
							   <label for="exampleInputEmail1">Nama Mahasiswa</label>
							    <select class="form-control select2" id="exampleFormControlSelect1" name="user_id" required>
							      <option value="">"------Pilih-------"</option>
									@foreach($data_kalbiser as $item)
							      	<option value="{{$item->user_id}}" {{ $data_skpi->user_id == $item->user_id ? 'selected' : null }}><span>{{ $item->nim }} - {{$item->nama}}</span></option>

							     	@endforeach
							     </select>
							 </div>
			      		

						 <x-form.wrapper title="Jenis Dokumen" required="true">
							    <select class="form-control" id="exampleFormControlSelect1" name="jenis_dokumen" required>
							      <option value="">"------Pilih-------"</option>
							      <option value="SK" {{ $data_skpi->jenis_dokumen == 'SK' ? 'selected' : null }}>Surat Keputusan (SK)</option>
							      <option value="SERTIFIKAT" {{ $data_skpi->jenis_dokumen == 'SERTIFIKAT' ? 'selected' : null }}>Sertifikat</option>
							      <option value="STU" {{ $data_skpi->jenis_dokumen == 'STU' ? 'selected' : null }}>Surat Tugas (STU)</option>
							      <option value="PIAGAM" {{ $data_skpi->jenis_dokumen == 'PIAGAM' ? 'selected' : null }}>Piagam</option>
							      <option value="Lain-lain" {{ $data_skpi->jenis_dokumen == 'Lain-lain' ? 'selected' : null }}>Lain-lain</option>
							    </select>
						</x-form.wrapper>

						<x-form.wrapper title="Tanggal Dokumen" required="true">
								<input readonly type="text" name="tanggal_dokumen" class="form-control datepicker date" aria-describedby="emailHelp" placeholder="dd/mm/yyyy" value="{{$data_skpi->tanggal_dokumen}}" id="tanggaldokumen">
				      	</x-form.wrapper>

				      	<x-form.wrapper title="Tahun" required="true">
								<input readonly type="text" name="tahun" class="form-control" aria-describedby="emailHelp" placeholder="dd/mm/yyyy" value="{{$data_skpi->tahun}}">
				      	</x-form.wrapper>

				      	<x-form.wrapper title="Judul Sertifikat" required="true">
				      			<x-form.input name="judul_sertifikat" required placeholder="Judul Sertifikat" value="{{$data_skpi->judul_sertifikat}}" />
				      	</x-form.wrapper>


				      	<x-form.wrapper title="Penyelenggara" required="true">
				      			<x-form.input name="penyelenggara" required placeholder="Penyelenggara" value="{{$data_skpi->penyelenggara}}" />
				      	</x-form.wrapper>

					

					 <input type="hidden" name="status" value="0">
				      <div class="modal-footer">
						<button type="submit" class="btn btn-primary">Submit</button>
						</form>
				      </div>
				    </div>
				  </div>
				</div>
<script>
		$(document).ready(function() {
    	$('.select2').select2();
		});

		$(".datepicker.date").datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
      		changeYear: true
		});


</script>
@stop