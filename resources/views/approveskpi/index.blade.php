
@extends('layout.master')

@section('content')
		<div class="main">
			<div class="main-control">
				<div class="container-fluid" style="margin-top: 50px !important;">
					<div class="row">
						<div class="col-md-12">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">SKPI</h3>
									<div class="left">
										<input type="checkbox" onclick="toggle(this);" />Select All

										<form action="{{url('/approveskpiall')}}"id="form">
												<button type="submit" class="button btn-xl" style="background-color: yellow;" value="Approve All">Approve All</button>
										</form>
									</div>
<!-- 									<div class="right">
									<button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-plus-circle"></i></button>
									</div> -->
								</div>
							<div class="panel-body">
								<div class="table-responsive">
									 <table class="table table-hover data">
									 	<thead>
												<tr>
													<th></th>
													<th>NIM</th>
													<th>Nama Mahasiswa</th>	
													<th>Program Studi</th>					
													<th>Jenis Dokumen</th>
													<th>Tanggal Dokumen</th>
													<th>Judul Sertifikat</th>
													<th>Status</th>
													<th>Aksi</th>		
											</tr>
										</thead>
										<tbody>


												<tr>										
												@foreach($data_skpi as $skpi)
													@foreach($data_kalbiser as $kalbiser)
														@if($kalbiser->user_id == $skpi->user_id && $skpi->user_id == auth()->user()->id || auth()->user()->role == 'admin' && $kalbiser->user_id == $skpi->user_id)	
															<td>
																<input form="form" type="checkbox" name="approveId[]" value="{{ $skpi->id }}">
															</td>
														
															<td>{{$kalbiser->nim}}</td>
															<td>{{$kalbiser->nama}}</td>
															<td>{{$kalbiser->prodi->nama_prodi}}</td>
														


															<td>{{$skpi->jenis_dokumen}}</td>
															<td>{{$skpi->tanggal_dokumen}}</td>
															<td>{{$skpi->judul_sertifikat}}</td>
															<td>@if($skpi->status == '0' && $skpi->user_id == auth()->user()->id || $skpi->status == null && $skpi->user_id == auth()->user()->id || $skpi->status == '0' && auth()->user()->role == 'admin' || $skpi->status == null && auth()->user()->role == 'admin')
															<span class="badge badge-danger">Belum Di Approve</span>
														@elseif($skpi->status == '1' && $skpi->user_id == auth()->user()->id || $skpi->status == null && $skpi->user_id == auth()->user()->id || $skpi->status == '1' && auth()->user()->role == 'admin')
															<span class="badge badge-success">Sudah Di Approve</span>
														@endif


													</td>
															<td>
															<button id="buttonViewModal" type="button" class="btn btn-primary" data-toggle="modal" data-id="{{ asset($skpi->file_skpi) }}" data-target="#viewModal">
																View File
															</button>
															@if($skpi->status != '1')
																<a href="{{url('/approveskpi/'.$skpi->id)}}"class="btn btn-sm btn-warning">approve</a>
															@else
																<a href="{{url('/approveskpi2/'.$skpi->id)}}"class="btn btn-sm btn-danger">disapprove</a>
															@endif
															</td>
													</tr>
													
														@endif
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
	    // Setup - add a text input to each footer cell
    	$('.data tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    
		});

		  var table = $('.data').DataTable( {
         "lengthMenu": [[7, 25, 30, -1], [7, 25, 30, "All"]]

    	} );

		 $(".data tfoot input").on( 'keyup change', function () {
        table
            .column( $(this).parent().index()+':visible' )
            .search( this.value )
            .draw();
    	});
	});
	</script>


<!-- Button View Modal untuk vie files gambar -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-body-view-file" style="width: 250%"></div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
</div>



	<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Input Data SKPI</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				      		<form action="/skpi/create" method="POST" enctype="multipart/form-data">
				      			{{csrf_field()}}

				      		  <div class="form-group">
							    <label for="exampleInputEmail1">File Unggah</label>
							    <input type="file" name="file_skpi" class="form-control" >
							  </div>

				      		  <div class="form-group">									   	
							   <label for="exampleInputEmail1">Nama Mahasiswa</label>
							    <select class="form-control" id="exampleFormControlSelect1" name="user_id">
							      <option value="">"------Pilih-------"</option>
				  					
									@foreach($data_kalbiser as $kalbiser)
									@if($kalbiser->user_id == auth()->user()->id|| auth()->user()->role == 'admin')	
							      <option value="{{$kalbiser->user_id}}">{{$kalbiser->nama}} <span>{{$kalbiser->nim}}</span></option>
	
							      	@endif
							     	@endforeach
							     </select>
							 </div>



					  
						 	<div class="form-group">
							    <label for="exampleInputEmail1">Jenis Dokumen</label>
							    <select class="form-control" id="exampleFormControlSelect1" name="jenis_dokumen">
							      <option value="">"------Pilih-------"</option>
							      <option value="jkk">JKK</option>
							      <option value="seminar">Seminar</option>
							      <option value="piagam">Piagam</option>
							      <option value="kompetisi eksternal">Kompetisi Eksternal</option>
							    </select>
							</div>

							  <div class="form-group">
							    <label for="exampleInputEmail1">Tanggal Dokumen</label>
							    <input type="text" name="tanggal_dokumen" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="dd/mm/yyyy">
							  </div>

							  <div class="form-group">
							    <label for="exampleInputEmail1">Judul Sertifikat</label>
							    <input type="text" name="judul_sertifikat" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
							  </div> -->
<!-- 					  <br>
					  	<div class="form-check form-check-inline">
						  <input class="form-check-input " type="radio" name="kegiatan_id" id="kegiatan_radio" value="kegiatan">
						  <label class="form-check-labl" for="inlineRadio1">Kegiatan</label>
						  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
						  <input class="form-check-input " type="radio" name="kegiatan_id" id="kompetisi_radio" value="kompetisi">
						  <label class="form-check-label" for="inlineRadio1">Kompetisi</label>
						</div>
						<br> -->

						
<!-- 
					  <div class="form-group kegiatan_radio_hasil">
				
					    	<label for="exampleInputEmail1">Kegiatan</label>
							     <select class="form-control" id="exampleFormControlSelect1" name="kegiatan_id">
							      <option value="">"------Pilih-------"</option>
							      <option value="">tess</option>
							    </select>
					    
					  </div>

  					  <div class="form-group kompetisi_radio_hasil">
				
					    	<label for="exampleInputEmail1">Kompetisi</label>
							     <select class="form-control" id="exampleFormControlSelect1" name="kompetisi_id">
							      <option value="">"------Pilih-------"</option>
							      <option value="">tes</option>
							    </select>
					    
					  </div> -->
					

				
					  <input type="hidden" name="status" value="0">
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Submit</button>
						</form>
				      </div>
				    </div>
				  </div>




			


<script>
	function toggle(source) {
	    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
	    for (var i = 0; i < checkboxes.length; i++) {
	        if (checkboxes[i] != source)
	            checkboxes[i].checked = source.checked;
	    }
	}

	$(document).ready(function(){
		$('#search_text').keyup(function(){
			var txt = $(this).val();
			if(txt != '')
			{

			}
			else{
				$('#result').html('');
				$.ajax({
					url:'index',
					method:"post",
					data:{search:txt},
					dataType:"text",
					success:function(data){
						$('#result').html(data);
					}
				});
			}
		});

		$(document).on("click", "#buttonViewModal", function(){
		var skpiId = $(this).data('id');
		var bodyElement = $('.modal-body-view-file');
		bodyElement.html('');
		var domImage = `<img src="${skpiId}" style="width:80%" />`

		bodyElement.append(domImage)
	})
	
	});
</script>
@stop