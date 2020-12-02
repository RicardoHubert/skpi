@extends('layout.master')

@section('content')
		<div class="main">
			<div class="main-control">
				<div class="container-fluid" style="margin-top: 50px !important;">
					<div class="row">
						<div class="col-md-12">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Kompetisi</h3>
								
									<div class="right">
									<button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-plus-circle"></i> Create New Kompetisi 	</button>
									</div>
								</div>
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-hover data">

											<thead>
												<tr>	
													<th>Poster Kompetisi</th>
													<th>Ormawa</th>
													<th>Program Studi</th>
													<th>Nama Mahasiswa</th>
													<th>NIM</th>
													<th>Nama kompetisi</th>
													<th>Jenis Kompetisi</th>		
													<th>URL</th>
													<th>Judul Sertifikat</th>
													<th>Sertifikat Peserta</th>
													<th>Skala</th>
													<th>Pencapaian</th>
													<th>Nama Kegiatan</th>
													<th>Tanggal Kegiatan</th>
													<th>Penyelenggara</th>
													<th>status</th>
													<th>Aksi</th>
												
												</tr>
										</thead>
										<tbody>
											
												@foreach($kompetisiinternals as $kompetisiinternal)	
												@foreach($kalbisers as $kalbiser)
												@foreach($ormawas as $ormawa)
													@if($kalbiser->user_id == auth()->user()->id && $kompetisiinternal->user_id == $kalbiser->user_id && $kompetisiinternal->ormawa_id == $ormawa->id || auth()->user()->role == 'admin' && $kompetisiinternal->user_id == $kalbiser->user_id && $kompetisiinternal->ormawa_id == $ormawa->id || $ormawa->user_id == auth()->user()->id && $kompetisiinternal->user_id == $kalbiser->user_id && $kalbiser->user_id && $kompetisiinternal->ormawa_id == $ormawa->id)

													
												<tr>
													<td>
														
														<a href="{{url($kompetisiinternal->poster)}}">
														<img style="height: 50px;" src="{{$kompetisiinternal->poster}}" />
														</a>
													
													</td>
													<td>{{$ormawa->nama_ormawa}}</td>
													<td>{{$kalbiser->prodi->nama_prodi}}</td>
													<td>{{$kalbiser->nama}}</td>
													<td>{{$kalbiser->nim}}</td>
													<td>{{$kompetisiinternal->nama_kompetisi}}</td>
													<td>{{$kompetisiinternal->jenis_kompetisi}}</td>
													<td>{{$kompetisiinternal->url}}</td>
													<td>{{$kompetisiinternal->sertifikat}}</td>
													<td>
														<a href="{{$kompetisiinternal->file_sertifikat}}">
														<img style="height: 50px;" src="{{$kompetisiinternal->file_sertifikat}}" />
														</a>
														 (bukti ikut serta melalui sertifikat)
													</td>
													<td>{{$kompetisiinternal->skala}}</td>
													<td>{{$kompetisiinternal->pencapaian}}</td>
													<td>{{$kompetisiinternal->nama_kegiatan}}</td>
													<td>{{$kompetisiinternal->tanggal_kegiatan}}</td>
													<td>{{$kompetisiinternal->penyelenggara}}</td>
													<td>@if($kompetisiinternal->status == '0' || $kompetisiinternal->status == null)
														<br>
															<span class="alert alert-danger">Belum Di Approve</span>
														@else
														<br>
															<span class="alert alert-success">Sudah Di Approved</span>
														@endif
														
													</td>


													<td>
													@if(auth()->user()->role == 'admin'|| auth()->user()->role == 'student' && $kalbiser->user_id == auth()->user()->id)
														<a href="{{url('/kompetisiinternal/fileupload/'.$kompetisiinternal->id)}}" class="btn btn-sm btn-primary">Upload File Pendukung</a>
														<form action="{{ route('file.download') }}" method="POST">
															@csrf
															<input type="hidden" name="file" value="{{$kompetisiinternal->file_sertifikat}}">
															<button type="submit">Download Sertifikat</button>
														</form>	
														<a href="{{url('/kompetisiinternal/'.$kompetisiinternal->id)}}/edit" class="btn btn-sm btn-warning">Edit</a>
														<a href="{{url('/kompetisiinternal/'.$kompetisiinternal->id)}}/delete" class="btn btn-sm btn-danger" onclick="return confirm('Jika data ini dihapus maka dapat menghilangkan seluruh kompetisiinternal didalamnya, Apakah anda yakin ingin menghapus data ini??')">Delete</a>
													@endif
													</td>
												</tr>
													@endif
													@endforeach
											@endforeach
											@endforeach
										
										</tbody>
										<tfoot>
													<td></td>
													<th></th>
													<th></th>
													<th></th>
													<th></th>
													<th></th>
													<th></th>
													<th></th>
													<th></th>
													<td></td>
													<th></th>
													<th></th>
													<th></th>
													<th></th>
													<th></th>
													<th></th>													

										</tfoot>
									</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<script type="text/javascript">
	$(document).ready(function() {


	    $('.data tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    
		});

	    var table = $('.data').DataTable( {
        "aLengthMenu": [[7, 10, 50, -1], [7, 10, 50, "All"]]

    	} );

		 $(".data tfoot input").on( 'keyup change', function () {
        table
            .column( $(this).parent().index()+':visible' )
            .search( this.value )
            .draw();
    	});
	});


	</script>
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">	
				        <h5 class="modal-title" id="exampleModalLabel">Input Data kompetisi</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				      		<form action="{{url('/kompetisiinternal/create/')}}"  method="POST" enctype="multipart/form-data">
				      			{{csrf_field()}}

							  <x-form.wrapper title="Bukti Pendukung" required="true">
				      			<x-form.file name="poster" required />
				      			Bukti mengikuti kompetisi	
				      		</x-form.wrapper>	


							  <x-form.wrapper title="Nama Kompetisi" required="true">
				      			<x-form.input name="nama_kompetisi" required placeholder="Nama Kompetisi" />
				      		</x-form.wrapper>

 							 <div class="form-group">
							   <label for="exampleInputEmail1">Nama Mahasiswa</label>
							    <select class="form-control mySelect2" name="user_id" required>
							      <option value="">"------Pilih-------"</option>
									@foreach($kalbisers as $kalbiser)

									@if($kalbiser->user_id == auth()->user()->id || auth()->user()->role == 'admin' ||  auth()->user()->role == 'Ormawa')
							      <option value="{{$kalbiser->user_id}}">{{$kalbiser->nama}} <span>{{$kalbiser->nim}}</span></option>

							      	@endif
							     	@endforeach
							     </select>
							 </div>

							 <div class="form-group">
							    <label for="exampleInputEmail1">Nama Ormawa</label>
							    <select class="form-control mySelect2" name="ormawa_id">
							      <option value="">"------Pilih-------"</option>
							      @foreach($ormawas as $ormawa)
							      <option value="{{$ormawa->id}}">{{$ormawa->nama_ormawa}}</option>
							      @endforeach
							    </select>
							 </div>

							  <div class="form-group">
							    <label for="exampleInputEmail1">Jenis kompetisi</label>
							    <select class="form-control mySelect2" name="jenis_kompetisi" required>
							      <option value="">"------Pilih Jenis kompetisi-------"</option>
							      <option value="Internal">Internal</option>
							      <option value="Eksternal">Eksternal</option>
							    </select>
							 </div>

							 <x-form.wrapper title="URL">
				      			<x-form.input name="url" required placeholder="Url" />
				      			Nama Kegiatan sesuai dengan judul di proposal
				      		</x-form.wrapper>

							 <x-form.wrapper title="Judul Sertifikat" required="true">
				      			<x-form.input name="sertifikat" required placeholder="Judul Sertifikat" />
				      		</x-form.wrapper>

				      		<x-form.wrapper title="File Unggah Sertifikat" required="true">
				      			<x-form.file name="file_sertifikat" required />	
				      			Piagam, Sertifikat, dsb
				      		</x-form.wrapper>	

							   <x-form.wrapper title="Skala" required="true">
							    <select class="form-control" id="exampleFormControl mySelect2" name="skala" required>
							      <option value="">"------Pilih skala-------"</option>
							      <option value="Wilayah">Wilayah</option>
							      <option value="Nasional">Nasional</option>
							      <option value="Internasional">Internasional</option>
							     - Nasional(minimal peserta dari 3 provinsi yang berbeda)
							     - Internasional(minimal peserta dari 3 negara yang berbeda)
							    </select>

							</x-form.wrapper>

							 <x-form.wrapper title="Pencapaian" required="true">
				      			<x-form.input name="pencapaian" required placeholder="Pencapaian" />
				      		</x-form.wrapper>


							 <x-form.wrapper title="Nama Kegiatan" required="true">
				      			<x-form.input name="nama_kegiatan" required placeholder="Nama Kegiatan" />
				      		</x-form.wrapper>


							  <x-form.wrapper title="Tanggal Kegiatan" required="true">
							    <input readonly type="text" name="tanggal_kegiatan" class="form-control datepicker date" aria-describedby="emailHelp">
							   </x-form.wrapper>
							    
							 <x-form.wrapper title="Penyelenggara" required="true">
				      			<x-form.input name="penyelenggara" required placeholder="Penyelenggara" />
				      		</x-form.wrapper>

				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Submit</button>
						
						</form>
				      </div>
				    </div>
				  </div>
				</div>
					

<script>
 	$(document).ready(function() {
    $('.mySelect2').select2({
        dropdownParent: $('#exampleModal')
    });

		$(".datepicker.date").datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
      		changeYear: true
		});
});

 </script>		
@stop