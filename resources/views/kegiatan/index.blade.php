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
									<div class="right">
									<button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-plus-circle"></i>Create New Kegiatan</button>
<!-- 									<a href="/kegiatan_anggota/create" class="btn btn-warning btn-sm" style="margin-left: 20px;">Create Anggota Kegiatan</a> -->
									</div>

								</div>
								
							<div class="panel-body">
								<div class="table-responsive">
								<table class="table table-hover data">
									<thead>
											<tr>
												
												<th>Nama/Tema Kegiatan</th>
												<th>Organisasi Mahasiswa</th>
												<th>Deskripsi Kegiatan</th>
												<th>Jenis Dokumen</th>
												<th>Tanggal Kegiatan</th>
												<th>Data Peserta</th>
												<th>Status</th>
												<th>Aksi</th>
												
											</tr>
									</thead>
									<tbody>
											@foreach($data_kegiatan as $kegiatan)	
												@foreach($data_ormawa as $ormawa)
													@if($ormawa->user_id == auth()->user()->id && $kegiatan->ormawa_id == $ormawa->id || auth()->user()->role == 'admin' && $kegiatan->ormawa_id == $ormawa->id)
													<tr>
															 
														<td>{{$kegiatan->nama_kegiatan}}</td>
														<td>
																{{$ormawa->nama_ormawa}}
														</td>

														<td>{{$kegiatan->deskripsi_kegiatan}}</td>
														<td>{{$kegiatan->sertifikat}}</td>
														<td>{{$kegiatan->tanggal_kegiatan}}</td>
														<td>
															<a href="{{url('/pendaftaran_kegiatan/ricardo/export_excel?kegiatanId='.$kegiatan->id)}}"class="btn btn-primary btn-sm" style="margin-left: 20px;">Convert Excel</a></td>
														<td>@if($kegiatan->status == '0' || $kegiatan->status == null)
															<span class="alert-danger">Belum Di Approve</span>
														@else
															<span class="alert-success">Sudah Di Approved</span>
														@endif
														
													</td>
														<td>
														<button id="buttonViewModal" type="button" class="btn btn-primary" data-toggle="modal" data-id="{{$kegiatan->poster}}" data-target="#viewModal">
														  View file
														</button>
														@if(auth()->user()->role == 'admin')
															<a href="{{url('/kegiatan/'.$kegiatan->id)}}/edit" class="btn btn-sm btn-warning">Edit</a>
															<a href="{{url('/kegiatan/'.$kegiatan->id)}}/delete" class="btn btn-sm btn-danger" onclick="return confirm('Jika data ini dihapus maka dapat menghilangkan seluruh kegiatan didalamnya, Apakah anda yakin ingin menghapus data ini??')">Delete</a>
														@endif
														</td>
													</tr>
													@endif
												@endforeach
											@endforeach
									</tbody>
									<tfoot>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<td></td>
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
				        <h5 class="modal-title" id="exampleModalLabel">Input Data Kegiatan</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>

				      <div class="modal-body">
				      		<form action="{{url('/kegiatan/create')}}"  method="POST" enctype="multipart/form-data">
				      			{{csrf_field()}}

							<x-form.wrapper title="Nama Ormawa" required="true">
							    <select class="form-control" id="exampleFormControlSelect1" name="ormawa_id" required>
				      			<option value="">"------Pilih-------"</option>
							      @foreach($data_ormawa as $ormawa)
							      <option value="{{$ormawa->id}}">{{$ormawa->nama_ormawa}}</option>
							      @endforeach
							     </select>
				      		</x-form.wrapper>

				      		<x-form.wrapper title="Poster" required="true">
				      			<x-form.file name="poster" required />	
				      		</x-form.wrapper>

				      		<x-form.wrapper title="Nama/Tema Kegiatan" required="true">
				      			<x-form.input name="nama_kegiatan" required placeholder="Nama Kegiatan" />
				      			Nama Kegiatan sesuaoi dengan judul di proposal
				      		</x-form.wrapper>


							<x-form.wrapper title="Deskripsi Kegiatan" required="true">
				      			 <textarea id="konten" class="form-control" name="deskripsi_kegiatan" rows="10" cols="50" required></textarea>
				      		</x-form.wrapper>

							<x-form.wrapper title="Jenis Dokumen" required="true">
				      			<select class="form-control" name="sertifikat" required>
				      			  <option value="">"------Pilih-------"</option>
							      <option value="SK">SK(Surat Keputusan)</option>
							      <option value="SERTIFIKAT">Sertifikat</option>
							      <option value="STU">Surat Tugas</option>
							      <option value="PIAGAM">Piagam</option>
							      <option value="Lain-lain">Lain-lain</option>
							    </select>
				      		</x-form.wrapper>
							   
							<x-form.wrapper title="Tanggal Kegiatan" required="true">
								<input readonly type="text" name="tanggal_kegiatan" class="form-control datepicker date" aria-describedby="emailHelp" placeholder="dd/mm/yyyy">
				      		</x-form.wrapper>
				      		<input type="hidden" name="status" value="0">
				      </div>

				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Submit</button>
						
						</form>
				      </div>
				    </div>
				  </div>
				</div>
				<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
					<script>
 						var konten = document.getElementById("konten");
    					CKEDITOR.replace(konten,{language:'en-gb'});
 						CKEDITOR.config.allowedContent = true;
 					</script>	

<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Kegiatan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body-view-file"></div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).on("click", "#buttonViewModal", function(){
		var file = $(this).data('id');
		var bodyElement = $('.modal-body-view-file');
		bodyElement.html('');
		var domImage = `<img src="${file}" style="width:100%; height: 100%;" />`

		bodyElement.append(domImage)



	})
</script>
<script>
		$(document).ready(function(){
		$(".datepicker.date").datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
      		changeYear: true
		});
	});
</script>	
@endsection