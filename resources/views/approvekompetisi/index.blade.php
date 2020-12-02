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

									<div class="left">
										<input type="checkbox" onclick="toggle(this);" />Select All

										<form action="{{url('/approvekompetisiall')}}" id="form">
												<button type="submit" class="button btn-xl" style="background-color: yellow;" value="Approve All">Approve All</button>
										</form>
									</div>
								</div>
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-hover data">

											<thead>
												<tr>
													<th></th>
													<th>Poster Kompetisi</th>
													<th>Organisasi Mahasiswa</th>
													<th>Nama Mahasiswa</th>
													<th>NIM</th>
													<th>Nama kompetisi</th>
													<th>Jenis Kompetisi</th>		
													<th>URL</th>
													<th>Judul Sertifikat</th>
													<th>File Unggah</th>
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
											<tr>
												@foreach($kompetisiinternals as $kompetisiinternal)	
												@foreach($kalbisers as $kalbiser)
												@foreach($ormawas as $ormawa)
													@if($kalbiser->user_id == auth()->user()->id && $kompetisiinternal->user_id == $kalbiser->user_id && $kompetisiinternal->ormawa_id == $ormawa->id || auth()->user()->role == 'admin' && $kompetisiinternal->user_id == $kalbiser->user_id && $kompetisiinternal->ormawa_id == $ormawa->id )

												
													<td>
													<input form="form" type="checkbox" name="approveId[]" value="{{ $kompetisiinternal->id }}">
													</td>
													<td><a href="{{$kompetisiinternal->poster}}"><img style="height: 50px;" src="{{$kompetisiinternal->poster}}" /></a></td>
													<td>{{$ormawa->nama_ormawa}}</td>
													<td>{{$kalbiser->nama}}</td>
													<td>{{$kalbiser->nim}}</td>
													<td>{{$kompetisiinternal->nama_kompetisi}}</td>
													<td>{{$kompetisiinternal->jenis_kompetisi}}</td>
													<td>{{$kompetisiinternal->url}}</td>
													<td>{{$kompetisiinternal->sertifikat}}</td>
													<td><a href="{{$kompetisiinternal->file_sertifikat}}"><img style="height: 50px;" src="{{$kompetisiinternal->file_sertifikat}}" /></a></td>
													<td>{{$kompetisiinternal->skala}}</td>
													<td>{{$kompetisiinternal->pencapaian}}</td>
													<td>{{$kompetisiinternal->nama_kegiatan}}</td>
													<td>{{$kompetisiinternal->tanggal_kegiatan}}</td>
													<td>{{$kompetisiinternal->penyelenggara}}</td>
													<td>
													
														@if($kompetisiinternal->status == '0' || $kompetisiinternal->status == null)
															<span class="badge badge-danger">belum di approve</span>
														@else
															<span class="badge badge-success">sudah di approve</span>
														@endif
														
													</td>


													<td>
													@if($kompetisiinternal->status != '1')
														<a href="{{url('/approvekompetisi/'.$kompetisiinternal->id)}}" class="btn btn-sm btn-warning">approve</a>
													@else
														<a href="{{url('/approvekompetisi2/'.$kompetisiinternal->id)}}" class="btn btn-sm btn-danger">disapprove</a>
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
													<td></td>
													<th></th>
													<th></th>
													<th></th>
													<th></th>
													<th></th>
													<th></th>
													<th></th>
													<th></th>
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
	function toggle(source) {
	var checkboxes = document.querySelectorAll('input[type="checkbox"]');
	for (var i = 0; i < checkboxes.length; i++) {
	if (checkboxes[i] != source)
	checkboxes[i].checked = source.checked;
	}
}
	</script>



	<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">	
				        <h5 class="modal-title" id="exampleModalLabel">Input Data kompetisi</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				      		<form action="/kompetisiinternal/create" method="POST" enctype="multipart/form-data">
				      			{{csrf_field()}}

				      		 <div class="form-group">
							    <label for="exampleInputEmail1">Poster Kompetisi</label>
							    <input type="file" name="poster" class="form-control" >
							  </div>	

							  <div class="form-group">
							    <label for="exampleInputEmail1">Nama kompetisi</label>
							    <input type="text" name="nama_kompetisi" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
							  </div>

							   <div class="form-group">
							    <label for="exampleInputEmail1">Nama Ormawa</label>
							    <select class="form-control" id="exampleFormControlSelect1" name="ormawa_id">
							      <option value="">"------Pilih-------"</option>
							      @foreach($ormawas as $ormawa)
							         <option value="{{$ormawa->user_id}}">{{$ormawa['nama_ormawa']}}</option>s
							      @endforeach
							      <option value="others">Other</option>
							    </select>
							 </div>

							  <div class="form-group">
							    <label for="exampleInputEmail1">Jenis kompetisi</label>
							    <select class="form-control" id="exampleFormControlSelect1" name="jenis_kompetisi">
							      <option value="">"------Pilih Jenis kompetisi-------"</option>
							      <option value="Internal">Internal</option>
							      <option value="Eksternal">Eksternal</option>
							    </select>
							 </div>

							   <div class="form-group">
							    <label for="exampleInputEmail1">URL</label>
							    <textarea id="konten" class="form-control" name="url" rows="10" cols="50"></textarea>		  
							</div>

							<div class="form-group">
							    <label for="exampleInputEmail1">Judul Sertifikat</label>
							    <input type="text" name="sertifikat" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
							 </div>


				      		 <div class="form-group">
							    <label for="exampleInputEmail1">File Unggah Sertifikat</label>
							    <input type="file" name="file_sertifikat" class="form-control" >
							  </div>

							  <div class="form-group">
							    <label for="exampleInputEmail1">Skala</label>
							    <select class="form-control" id="exampleFormControlSelect1" name="skala">
							      <option value="">"------Pilih skala-------"</option>
							      <option value="Wilayah">Wilayah</option>
							      <option value="Nasional">Nasional</option>
							      <option value="Internasional">Internasional</option>
							    </select>
							 </div>

							 <div class="form-group">
							    <label for="exampleInputEmail1">Pencapaian</label>
							    <input type="text" name="pencapaian" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
							 </div>

							<div class="form-group">
							    <label for="exampleInputEmail1">Nama Kegiatan</label>
							    <input type="text" name="nama_kegiatan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
							 </div>

							 <div class="form-group">
							    <label for="exampleInputEmail1">Tanggal Kegiatan</label>
							    <input type="date" name="tanggal_kegiatan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
							 </div>

							 <div class="form-group">
							    <label for="exampleInputEmail1">Penyelenggara</label>
							    <input type="text" name="penyelenggara" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
							 </div>

				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Submit</button>
						<a href="" class="btn btn-success"> Request to Admin</a>
						</form>
				      </div>
				    </div>
				  </div> -->
				</div>
				<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
					<script>
 						var konten = document.getElementById("konten");
    					CKEDITOR.replace(konten,{language:'en-gb'});
 						CKEDITOR.config.allowedContent = true;

 							function toggle(source) {
						    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
						    for (var i = 0; i < checkboxes.length; i++) {
						        if (checkboxes[i] != source)
						            checkboxes[i].checked = source.checked;
						    }
						}

 					</script>
@stop