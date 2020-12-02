@extends('layout.master')

@section('content')
		<div class="main">
			<div class="main-control">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">SKPI</h3>
<!-- 									<div class="left">
										<form action="skpi/downloadword" method="POST">
											@csrf
											<button type="submit" style="background-color: indigo; color: white; padding: 15px; border-radius: 10px;">Word</button>
										</form>
									</div> -->
									<div class="right">
									<button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-plus-circle"></i> Create New SKPI </button>
									</div>
								</div>
							<div class="panel-body">
								<div class="table-responsive">
									 <table class="table table-hover data" id="tableexcel">
									 	<thead>
												<tr>
												
													<th>NIM</th>
													<th>Nama Mahasiswa</th>
													<th>Program Studi</th>
													<th>Jenis Dokumen</th>
													<th>Tanggal Dokumen</th>
													<th>Tahun Dokumen</th>
													<th>Judul Sertifikat</th>
													<th>Penyelenggara</th>
													<th>File</th>
													<th>Aksi</th>
													<th>Status</th>
													<th>Approved / Disapproved By</th>	
															
												</tr>

										</thead>
										<tbody>


												<tr>
												@foreach($data_skpi as $skpi)
												@foreach($data_kalbiser as $kalbiser)
														@if($kalbiser->user_id == $skpi->user_id && $skpi->user_id == auth()->user()->id || auth()->user()->role == 'admin' && $kalbiser->user_id == $skpi->user_id ||  auth()->user()->role == 'ao' && $kalbiser->user_id == $skpi->user_id)
														
															<td>{{$kalbiser->nim}}</td>
															<td>{{$kalbiser->nama}}</td>
															<td>{{$kalbiser->prodi->nama_prodi}}</td>



													<td>{{$skpi->jenis_dokumen}}</td>
													<td>{{$skpi->tanggal_dokumen}}</th>
													<th>{{$skpi->tahun}}</th>
													<th>{{$skpi->judul_sertifikat}}</th>
													<th>{{$skpi->penyelenggara}}</th>

													@if(auth()->user()->role == 'admin' && $skpi->user_id == auth()->user()->id|| auth()->user()->role == 'student'&& $skpi->user_id == auth()->user()->id || auth()->user()->role == 'admin' || auth()->user()->role == 'ao' )
													
													<td>
														<button id="buttonViewModal" type="button" class="btn btn-primary" data-toggle="modal" data-id="{{ asset($skpi->file_skpi) }}" data-target="#viewModal">
														  View file
														</button>

														<form action="{{ route('file.download') }}" method="POST">
															@csrf
															<input type="hidden" name="file" value="{{$skpi->file_skpi}}">
															<button type="submit">Download Sertifikat</button>
														</form>	
													</td>

													<td>
														<a href="{{url('/skpi/'.$skpi->id)}}/edit" class="btn btn-sm btn-warning">Edit</a>
														<a href="{{url('/skpi/'.$skpi->id)}}/delete"  class="btn btn-sm btn-danger" onclick="return confirm('Jika data ini dihapus maka dapat menghilangkan seluruh kegiatan didalamnya, Apakah anda yakin ingin menghapus data ini??')">Delete</a>
													</td>

														<td>@if($skpi->status == '0' && $skpi->user_id == auth()->user()->id || $skpi->status == null && $skpi->user_id == auth()->user()->id || $skpi->status == '0' && auth()->user()->role == 'admin' || $skpi->status == null && auth()->user()->role == 'admin' || $skpi->status == '0' && auth()->user()->role == 'ao' || $skpi->status == null && auth()->user()->role == 'ao')
															<br>
															<span class="alert alert-danger">Belum Di Approve</span>
														@elseif($skpi->status == '1' && $skpi->user_id == auth()->user()->id || $skpi->status == null && $skpi->user_id == auth()->user()->id || $skpi->status == '1' && auth()->user()->role == 'admin' || $skpi->status == '1' && auth()->user()->role == 'ao')
															<br>
															<span class="alert alert-success">Sudah Di Approve</span>
														@endif

													</td>

													<td>
													@foreach($users as $user)
														@if($skpi->approvedby == $user->id)
															{{$user->name}}
														@endif
													@endforeach
													</td>

													@elseif(auth()->user()->role == 'ao')
													<td>
														<form action="{{ route('file.download') }}" method="POST">
															@csrf
															<input type="hidden" name="file" value="{{$skpi->file_skpi}}">
															<button type="submit">Download Sertifikat</button>
														</form>	
													</td>
													
													@endif

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
													<th></th>
													<td></td>
													<td></td>
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

	<!-- Modal -->
	<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body-view-file"></div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	    </div>
	  </div>
	</div>
</div>
	<script type="text/javascript">
	$(document).on("click", "#buttonViewModal", function(){
		var skpiId = $(this).data('id');
		var bodyElement = $('.modal-body-view-file');
		bodyElement.html('');
		var domImage = `<img src="${skpiId}" style="width:80%" />`

		bodyElement.append(domImage)
	})



	
	$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('.data tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );

    // DataTable
    	$('#tableexcel').DataTable({
    	"lengthMenu": [[4, 7, 100, -1], [4,7, 100, "all"]],
    	"dom" :'Bfrtip',
    	"buttons" : [
            'excel'	
        ],
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;

                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });

    //  $('#example').DataTable( {
    //     responsive: {
    //         details: {
    //             display: $.fn.dataTable.Responsive.display.modal( {
    //                 header: function ( row ) {
    //                     var data = row.data();
    //                     return 'Details for '+data[0]+' '+data[1];
    //                 }
    //             } ),
    //             renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
    //                 tableClass: 'table'
    //             } )
    //         }
    //     }
    // } );

    //  $('#pks_id').on('change', function(){
    //  	var nopolID = $(this).val();
    //  	if(nopolID){
    //  		$.ajax({

    //  			url: '{{url("/backend/addendum/ajax")}}'+"/"+nopolID,
    //  			type: "GET",
    //  			dataType: "json",

    //  			success:function(data){
    //  				$('#tgl_pks').val('');

    //  				$('#nama_kontrak_pks').val('');

    //  				$.each(data, function(key, value){

    //  					$('#tgl_pks').val(value.tgl_pks);

    //  					$('#nama_kontrak_pks').val(value.nama_kontrak_pks);

    //  				});
    //  			}

    //  		});
    //  	}else{
    //  		$('#harga_driver_ajax').empty();
    //  	}

    //  });

});
	</script>






	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Input Data SKPI</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				      		<form action="{{url('/skpi/create')}}"  method="POST" enctype="multipart/form-data">
				      			{{csrf_field()}}

<!-- 				      		  <div class="form-group">
							    <label for="exampleInputEmail1">File Unggah</label>
							    <input type="file" name="file_skpi" class="form-control" >
							  </div>
							 (Maksimal dokumen 5 MB & format JPEG) -->

							 <x-form.wrapper title="File Unggah" required="true">
				      			<x-form.file name="file_skpi" required />
				      			Sertifikat, Piagam, dsb	
				      		</x-form.wrapper>


				      		  <div class="form-group">
							   <label for="exampleInputEmail1">Nama Mahasiswa</label>
							    <select class="form-control" id="mySelect2" name="user_id" required>
							      <option value="">"------Pilih-------"</option>

									@foreach($data_kalbiser as $kalbiser)
									@if($kalbiser->user_id == auth()->user()->id|| auth()->user()->role == 'admin')
							      <option value="{{$kalbiser->user_id}}">{{$kalbiser->nama}} <span>{{$kalbiser->nim}}</span></option>

							      	@endif
							     	@endforeach
							     </select>
							 </div>


							<x-form.wrapper title="Jenis Dokumen" required="true">
				      			<select class="form-control" name="jenis_dokumen" required>
				      			  <option value="">"------Pilih-------"</option>
							      <option value="SK">Surat Keputusan (SK)</option>
							      <option value="SERTIFIKAT">Sertifikat</option>
							      <option value="STU">Surat Tugas (STU)</option>
							      <option value="PIAGAM">Piagam</option>
							      <option value="Lain-lain">Lain-lain</option>			      			      
							    </select>
				      		</x-form.wrapper>

							<x-form.wrapper title="Tanggal Dokumen" required="true">
								<input readonly type="text" name="tanggal_dokumen" class="form-control datepicker date" aria-describedby="emailHelp" placeholder="dd/mm/yyyy">
				      		</x-form.wrapper>

				      		<x-form.wrapper title="Tahun Dokumen" required="true">
								<x-form.input name="tahun" required placeholder="Tahun" />
								Sesuai dengan tanggal dokumen
				      		</x-form.wrapper>

							 <x-form.wrapper title="Judul Sertifikat" required="true">
				      			<x-form.input name="judul_sertifikat" required placeholder="Judul Sertifikat" />
				      		</x-form.wrapper>

				      		<x-form.wrapper title="Penyelenggara" required="true">
				      			<x-form.input name="penyelenggara" required placeholder="Penyelenggara" />
				      			Nama Institusi penyelenggara / Organisasi Mahasiswa Kalbis Institute
				      		</x-form.wrapper>



					  <input type="hidden" name="status" value="0">
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Submit</button>
						</form>
				      </div>
				    </div>
				  </div>







<script>
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
		
		$('#mySelect2').select2({
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
