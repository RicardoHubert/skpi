@extends('layout.master')

@section('content')
		<div class="main">
			<div class="main-control">
				<div class="container-fluid" style="margin-top: 50px !important;">
					<div class="row">
						<div class="col-md-12">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Data Kalbiser</h3>
									@if(auth()->user()->role != 'student')
									<div class="right">
									<button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-plus-circle"></i>Create New Kalbiser</button>
									</div>
									@endif
								</div>
							<div class="panel-body">
								<div class="table-responsive">
									 <table class="table table-hover data">
									 	<thead>
												<tr>
													<th>Nama</th>
													<th>NIM</th>
													<th>Program Studi</th>
													<th>Tahun Akademik</th>
													<th>No Handphone</th>
													<th>Student Email</th>
													<th>Aksi</th>
												</tr>
										</thead>
										<tbody>
												@foreach($data_kalbiser as $kalbiser)	
							      				@if($kalbiser->user_id == auth()->user()->id || auth()->user()->role == 'admin' || auth()->user()->role == 'ao')
												<tr>				
													<td><a href="{{url('/kalbiser/'.$kalbiser->id)}}/profile">{{$kalbiser->nama}}</td></a>
													<td>{{$kalbiser->nim}}</td>
													<td>{{$kalbiser->prodi->nama_prodi}}</td>
													<td>{{$kalbiser->tahun_akademik}}</td>
													<td>{{$kalbiser->nohp}}</td>
													<td>{{$kalbiser->email}}</td>
												

													
													
													<td>
														<a href="{{url('/kalbiser/'.$kalbiser->id)}}/edit" class="btn btn-sm btn-warning">Edit</a>
														<a href="{{url('/kalbiser/'.$kalbiser->id)}}/delete" class="btn btn-sm btn-danger" onclick="return confirm('Jika data ini dihapus maka dapat menghilangkan seluruh kegiatan didalamnya, Apakah anda yakin ingin menghapus data ini??')">Delete</a>

														<button id="buttonViewModal" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-id="fotokalbiser/{{$kalbiser->foto}}" data-target="#viewModal">
														  View file
														</button>
													</td>
												
												</tr>
												@endif
												
												@endforeach
										</tbody>
										<tfoot>
													<th></th>
													<th></th>
													<th></th>
													<th></th>
													<th></th>
													<th></th>
																									

										</tfoot>
									</table>
									<div>
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
         "lengthMenu": [[7, 25, 50, -1], [7, 25, 50, "All"]]
    	} );

		 $(".data tfoot input").on( 'keyup change', function () {
        table
            .column( $(this).parent().index()+':visible' )
            .search( this.value )
            .draw();
    	});
	});

	

	</script>

<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Foto Kalbiser</h5>
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


	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Input Data </h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				      		<form action="{{url('/kalbiser/create')}}"  method="POST" enctype="multipart/form-data">
				      			{{csrf_field()}}

				      		<x-form.wrapper title="Foto" required="true">
				      			<x-form.file name="foto" required />	
				      		</x-form.wrapper>

							<x-form.wrapper title="Nama Kalbiser" required="true">
				      			<x-form.input name="nama" required placeholder="Nama Kalbiser" />
				      		</x-form.wrapper>

							<x-form.wrapper title="NIM" required="true">
				      			<x-form.input name="nim" required placeholder="NIM" />
				      		</x-form.wrapper>

							<x-form.wrapper title="Prodi" required="true">
				      			<select class="form-control" name="prodi_id" required>
							      <option value="">"------Pilih Prodi-------"</option>
							      @foreach($prodi as $p)
							      <option value="{{ $p->id }}">{{ $p->nama_prodi }}</option>
							      @endforeach
							    </select>
				      		</x-form.wrapper>

							<x-form.wrapper title="Tahun Akademik" required="true">
								<x-form.input name="tahun_akademik" required placeholder="Tahun Akademik" />
				      		</x-form.wrapper>
  
							<x-form.wrapper title="NO.Handphone" required="true">
				      			<x-form.input name="nohp" required placeholder="NO.Handphone" />
				      		</x-form.wrapper>

							<x-form.wrapper title="Email" required="true">
				      			<x-form.input type="email" name="email" required placeholder="Email" />
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
	@stop