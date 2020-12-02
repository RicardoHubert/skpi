@extends('layout.master')

@section('content')
		<div class="main">
			<div class="main-control">
				<div class="container-fluid" style="margin-top: 50px !important;">
					<div class="row">
						<div class="col-md-12">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">NO E-SERTIF</h3>
<!-- 									<div class="left">
										<form action="skpi/downloadword" method="POST">
											@csrf
											<button type="submit" style="background-color: indigo; color: white; padding: 15px; border-radius: 10px;">Word</button>
										</form>
									</div> -->
								<!-- 	<div class="right">
									<button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-plus-circle"></i> Create New SKPI </button>
									</div> -->
								</div>
							<div class="panel-body">
								<div class="table-responsive">
									 <table class="table table-hover data" id="tableexcel">
									 	<thead>
												<tr>
													<th>Nomor E-Sertif</th>								
													<th>Nama Mahasiswa</th>
													<th>NIM</th>
													<th>Tanggal Dokumen</th>
													<th>Judul Sertifikat</th>
													<th>Organisasi Mahasiswa</th>
													<th>Status</th>
													<th>Aksi</th>
												</tr>
										</thead>
										<tbody>


												<tr>
												@foreach($data_skpi as $skpi)
												@foreach($data_kalbiser as $kalbiser)
												@foreach($data_ormawa as $ormawa)
														@if($kalbiser->user_id == $skpi->user_id && $skpi->user_id == auth()->user()->id || auth()->user()->role == 'admin' && $kalbiser->user_id == $skpi->user_id && $ormawa->id ==  $skpi->ormawa_id)
															<td>{{$skpi->nomor_file}}</td>
															<td>{{$kalbiser->nama}}</td>
															<td>{{$kalbiser->nim}}</td>
															

													<td>{{$skpi->tanggal_dokumen}}</td>
													<td>{{$skpi->judul_sertifikat}}</td>
													<td>{{$ormawa->nama_ormawa}}</td>
													
													<td>@if($skpi->status == '0' && $skpi->user_id == auth()->user()->id || $skpi->status == null && $skpi->user_id == auth()->user()->id || $skpi->status == '0' && auth()->user()->role == 'admin' || $skpi->status == null && auth()->user()->role == 'admin')
															<span class="badge badge-danger">Belum Di Approve</span>
														@elseif($skpi->status == '1' && $skpi->user_id == auth()->user()->id || $skpi->status == null && $skpi->user_id == auth()->user()->id || $skpi->status == '1' && auth()->user()->role == 'admin')
															<span class="badge badge-success">Sudah Di Approve</span>
														@endif

													</td>

													@if(auth()->user()->role == 'admin' && $skpi->user_id == auth()->user()->id|| auth()->user()->role == 'student'&& $skpi->user_id == auth()->user()->id || auth()->user()->role == 'admin')
													<td>
														<button id="buttonViewModal" type="button" class="btn btn-primary" data-toggle="modal" data-id="{{ asset($skpi->file_skpi) }}" data-target="#viewModal">
														  View file
														</button>
													</td>
													@endif
													</tr>

												</tr>
												@endif
												@endforeach
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
                        	.column( $(this).parent().index()+':visible' )
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });


});
	</script>
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
			dateFormat: "yy-mm-dd"
		});

	});
</script>
@stop
