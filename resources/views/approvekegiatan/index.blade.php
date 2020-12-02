@extends('layout.master')

@section('content')
		<div class="main">
			<div class="main-control">
				<div class="container-fluid" style="margin-top: 50px !important;">
					<div class="row">
						<div class="col-md-12">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Kegiatan Ormawa</h3>
									<div class="left">
										<input type="checkbox" onclick="toggle(this);" />Select All

										<form action="{{url('/approvekegiatanall')}}" id="form">
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
												
												<th>Nama Kegiatan</th>
												<th>Organisasi Mahasiswa</th>
												<th>Deskripsi Kegiatan</th>
												<th>Tanggal Kegiatan</th>
												<th>Status</th>
												<th>Aksi</th>
												
											</tr>
									</thead>
									<tbody>
											@foreach($kegiatan as $kegiatan)	
												@foreach($data_ormawa as $ormawa)
													@if($ormawa->user_id == auth()->user()->id && $kegiatan->ormawa_id == $ormawa->id || auth()->user()->role == 'admin' && $kegiatan->ormawa_id == $ormawa->id)
													<tr>
														<td>
														<input form="form" type="checkbox" name="approveId[]" value="{{ $kegiatan->id }}">
														</td>
														
														<td>{{$kegiatan->nama_kegiatan}}</td>
														<td>
																{{$ormawa->nama_ormawa}}
														</td>

														<td>{{$kegiatan->deskripsi_kegiatan}}</td>
														<td>{{$kegiatan->tanggal_kegiatan}}</td>
														<td>

															@if($kegiatan->status == '0' || $kegiatan->status == null)
															<span class="badge badge-danger">belum di approve</span>
														@else
															<span class="badge badge-success">sudah di approve</span>
														@endif
														
													</td>

													<td>
														<button id="buttonViewModal" type="button" class="btn btn-primary" data-toggle="modal" data-id="{{$kegiatan->poster}}" data-target="#viewModal">
														  View file
														</button>
													@if($kegiatan->status != '1')
														<a href="{{url('/approvekegiatan/'.$kegiatan->id)}}" class="btn btn-sm btn-warning">approve</a>
													@else
														<a href="{{url('/approvekegiatan2/'.$kegiatan->id)}}"  class="btn btn-sm btn-danger">disapprove</a>
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


<!-- 	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Input Data Kegiatan</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>

				      <div class="modal-body">
				      		<form action="/kegiatan/create" method="POST" enctype="multipart/form-data">
				      			{{csrf_field()}}
				      		

				      		<div class="form-group">
							    <label for="exampleInputEmail1">Nama Ormawa</label>
							    <select class="form-control" id="exampleFormControlSelect1" name="ormawa_id">
							      <option value="">"------Pilih-------"</option>
							      @foreach($data_ormawa as $ormawa)
							      <option value="{{$ormawa->id}}">{{$ormawa->nama_ormawa}}</option>
							      @endforeach
							    </select>
							 </div>

				      		 <div class="form-group">
							    <label for="exampleInputEmail1">Poster</label>
							    <input type="file" name="poster" class="form-control" >
							  </div>	

							  <div class="form-group">
							    <label for="exampleInputEmail1">Nama Kegiatan</label>
							    <input type="text" name="nama_kegiatan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
							  </div>

							   <div class="form-group">
							    <label for="exampleModalleInputEmail1">Deskripsi Kegiatan</label>
							    <textarea id="konten" class="form-control" name="deskripsi_kegiatan" rows="10" cols="50"></textarea>	
							   </div>
							   
							  <div class="form-group">
							    <label for="exampleInputEmail1">Tanggal Kegiatan</label>
							    <input type="date" name="tanggal_kegiatan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
							    <input type="hidden" name="status" value="0">
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
 					</script>

 					<script>
 						
 						 $(document).on("click", "#buttonViewModal", function(){
							var file = $(this).data('id');
							var bodyElement = $('.modal-body-view-file');
							bodyElement.html('');
							var domImage = `<img src="${file}" style="width:100%; height: 100%;" />`

							bodyElement.append(domImage)

						})
 					</script>		
@stop