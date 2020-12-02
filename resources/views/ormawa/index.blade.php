@extends('layout.master')

@section('content')
		<div class="main">
			<div class="main-control">
				<div class="container-fluid" style="margin-top: 50px !important;">
					<div class="row">
						<div class="col-md-12">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Data Ormawa</h3>
									@if(auth()->user()->role == 'admin')
									<div class="right">
									<button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-plus-circle"></i>Create New Data Ormawa</button>
									@endif
									</div>
								</div>
							<div class="panel-body">
									 <table class="table table-hover data">
									 	<thead>
												<tr>
													<th>Logo Ormawa</th>
													<th>Nama Ormawa</th>
													<th>Kategori Ormawa</th>
													<th>Visi</th>
													<th>Misi</th>
													<th>Email</th>
													@if(auth()->user()->role == 'admin')		
													<th>Aksi</th>
													@endif
												</tr>
										</thead>
										<tbody>
												@foreach($data_ormawa as $ormawa)
												@if($ormawa->user_id == auth()->user()->id || auth()->user()->role == 'admin')
												<tr>

													<td><img style="height: 50px;" src="logo/{{$ormawa->logo_ormawa}}"/><a href="{{url('/ormawa/'.$ormawa->id)}}/profile"></a></td>
													<td><a href="{{url('/ormawa/'.$ormawa->id)}}/profile">{{$ormawa->nama_ormawa}}</td></a>
													<td>{{$ormawa->kategori_ormawa}}</td>
													<td>{{$ormawa->visi}}</td>
													<td>{{$ormawa->misi}}</td>
													<td>{{$ormawa->email}}</td>
													@if(auth()->user()->role == 'admin')
													<td>
														<!--  <a href="{{url('/ormawa/'.$ormawa->id)}}"> -->
														<a href="{{url('/ormawa/'.$ormawa->id)}}/edit" class="btn btn-sm btn-warning">Edit</a>
														<a href="{{url('/ormawa/'.$ormawa->id)}}/delete" class="btn btn-sm btn-danger" onclick="return confirm('Jika data ini dihapus maka dapat menghilangkan seluruh kegiatan didalamnya, Apakah anda yakin ingin menghapus data ini??')">Delete</a>
													<!-- <button id="buttonViewModal" type="button" class="btn btn-primary" data-toggle="modal" data-id="{{ asset($ormawa->logo_ormawa)}}" data-target="#viewModal">
														  View file
														</button>	 -->
													</td>
													@endif
													@endif
												</tr>
												@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	<script type="text/javascript">
	$(document).ready(function() {
	$('.data').DataTable({
		 "lengthMenu": [[7, 25, 50, -1], [7, 25, 50, "All"]]
	});
	});
	</script>

	<script type="text/javascript">
	$(document).on("click", "#buttonViewModal", function(){
		var skpiId = $(this).data('id');
		var bodyElement = $('.modal-body-view-file');
		bodyElement.html('');
		var domImage = `<img src="${skpiId}" style="width:80%" />`

		bodyElement.append(domImage)
	});
	</script>


	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Input Data Ormawa</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				      		<form action="{{url('/ormawa/create')}}"  method="POST" enctype="multipart/form-data">
				      			{{csrf_field()}}

				      		<x-form.wrapper title="Logo Ormawa" required="true">
				      			<x-form.file name="logo_ormawa" required />	
				      		</x-form.wrapper>

				      		<x-form.wrapper title="Background Ormawa" required="true">
				      			<x-form.file name="bg_ormawa" required />
				      			<span>Ukuran Dimensi 1920 x 1080</span>
				      		</x-form.wrapper>


							  <div class="form-group">
							  
							    <input type="hidden" name="user_id" value="Ormawa" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
							  </div>

							<x-form.wrapper title="Nama Ormawa" required="true">
				      			<x-form.input name="nama_ormawa" required placeholder="Nama Ormawa" />
				      		</x-form.wrapper>

							<x-form.wrapper title="Kategori Ormawa" required="true">
				      			<x-form.input name="kategori_ormawa" required placeholder="Kategori Ormawa" />
				      			(UKM, UKR, HMJ)
				      		</x-form.wrapper>

							<x-form.wrapper title="Visi" required="true">
				      			<x-form.input name="visi" required placeholder="Visi" />
				      		</x-form.wrapper>

							<x-form.wrapper title="Misi" required="true">
				      			<x-form.input name="misi" required placeholder="Misi" />
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

<!-- <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div> -->
@endsection