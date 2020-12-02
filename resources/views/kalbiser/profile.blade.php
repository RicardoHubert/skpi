@extends('layout.master')

@section('content')
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<div class="panel panel-profile">
						<div class="clearfix">
							<!-- LEFT COLUMN -->
							<div class="profile-left">
								<!-- PROFILE HEADER -->
		

								<div class="profile-header">
									<div class="overlay"></div>
									<div class="profile-main" style="background-image: url('{{asset('fotokalbiser/'. $kalbiser->foto) }}'); height: 250px; max-height: 100%; width: 100%">
									</div>
									<div class="profile-stat">
										<div class="row">
											<div class="col-md-12 stat-item">
												{{$kalbiser->nama}}
											</div>
										</div>
									</div>
								</div>
								<!-- END PROFILE HEADER -->
								<!-- PROFILE DETAIL -->
								<div class="profile-detail" style="background-color: white">
									<div class="profile-info">
										<h4 class="heading">Personal Info</h4>
										<ul class="list-unstyled list-justify">
											<li>Nama <span>{{$kalbiser->nama}}</span></li>
											<li>NIM <span>{{$kalbiser->nim}}</span></li>
											<li>Program Studi <span>{{$kalbiser->prodi->nama_prodi}}</span></li>
											<li>Student Email <span>{{$kalbiser->email}}</a></span></li>
										</ul>
									</div>
								</div>
								<!-- END PROFILE DETAIL -->
							</div>
							<!-- END LEFT COLUMN -->
							<!-- RIGHT COLUMN -->
							<div class="profile-right">
								<!-- END AWARDS -->
								<!-- TABBED CONTENT -->
								<div class="custom-tabs-line tabs-line-bottom left-aligned">
									<ul class="nav" role="tablist">
										<li><a href="#tab-bottom-left2" role="tab" data-toggle="tab">Document SKPI <span class="badge"></span></a></li>
									</ul>
								</div>
								<div class="tab-content">
									<div class="tab-pane fade in active" id="tab-bottom-left2">
											<div class="table-responsive">
											<table class="table project-table data">
												<thead>
													<tr>
														<th>Judul Sertifikat</th>
														<th>Tanggal Dokumen</th>
														<th>Status</th>
														@if(auth()->user()->role == 'admin' || auth()->user()->role == 'Prodi' || auth()->user()->role == 'Ormawa')
														<th>Aksi</th>
														<th>Approved/Disapproved by</th>
														@elseif(auth()->user()->role == 'ao' || auth()->user()->role == 'student' )
														<th>Approved/Disapproved by</th>
														@endif
													</tr>
												</thead>
												<tbody>

													@foreach ($kalbiser->skpi->all() as $skpi)
                                                        <tr>
                                                            <td>{{$skpi->judul_sertifikat}}</td>
                                                            <td>{{$skpi->tanggal_dokumen}}</td>
                                                            
                                                            <td>

                                                                <span class="alert-{{$skpi->status == null || $skpi->status == 0 ? 'warning' : 'success'}}">
                                                                    {{$skpi->status == null || $skpi->status == 0 ? "Belum" : "Sudah"}} Diapprove
                                                                </span>
	                                                            </td>
	                                                           @if(auth()->user()->role == 'admin' || auth()->user()->role == 'Prodi' || auth()->user()->role == 'Ormawa')
	                                                         <td>@if($skpi->status != '1')
																<a href="{{url('/approveskpi/'.$skpi->id)}}" class="btn btn-sm btn-warning">approve</a>
																<button id="buttonViewModal" type="button" class="btn btn-primary" data-toggle="modal" data-id="{{ asset($skpi->file_skpi) }}" data-target="#viewModal">
														  View file
														</button>							
															@else
																<a href="{{url('/approveskpi2/'.$skpi->id)}}" class="btn btn-sm btn-danger">disapprove</a>
																<button id="buttonViewModal" type="button" class="btn btn-primary" data-toggle="modal" data-id="{{ asset($skpi->file_skpi) }}" data-target="#viewModal">
														  View file
														</button>
															@endif
															@endif
															</td>
															<td>
															@foreach($users as $user)
																@if($skpi->approvedby == $user->id)
																	{{$user->name}}
																@endif
															@endforeach
															</td>
                                                        </tr>
													@endforeach
												</tbody>
												<tfoot>
													<th></th>
													<th></th>
													<th></th>
													<td></td>
													<th></th>
												</tfoot>
											</table>
										</div>
										@if(auth()->user()->role != 'student')
										<div class="margin-top-30 text-center">
                                            <a href="{{$kalbiser->skpi()->count("status", "<>", null) > 0 ? route('skpi.printlist', ['id' => $kalbiser->id]) : '#'}}" class="btn btn-primary btn-md" >Download File Word</a>
										</div>
										@endif
									</div>
								</div>
								<!-- END TABBED CONTENT -->
							</div>
							<!-- END RIGHT COLUMN -->
						</div>
					</div>
				</div>
			</div>
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
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->

		<div class="clearfix"></div>

	<script type="text/javascript">
	$(document).ready(function() {
	    // Setup - add a text input to each footer cell
    	$('.data tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    
		});

		  var table = $('.data').DataTable( {
         "lengthMenu": [[7, 25, 50, -1], [7, 25, 50, "All"]]
    	} );

		 $(".data tfoot input").on( 'keyup change', function () {
        table
            .column( $(this).parent().index()+':visible' )
            .search( this.value )
            .draw();
    	});
		 	$(document).on("click", "#buttonViewModal", function(){
		var skpiId = $(this).data('id');
		var bodyElement = $('.modal-body-view-file');
		bodyElement.html('');
		var domImage = `<img src="${skpiId}" style="width:150%" />`

		bodyElement.append(domImage)
	})
	});
	</script>
@stop
