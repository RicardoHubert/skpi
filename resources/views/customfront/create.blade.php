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
									<div class="right">
									<button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-plus-circle"></i>Create New Kalbiser</button>
									</div>
								</div>
							<div class="panel-body">
								<div class="table-responsive">
									 <table class="table table-hover data">
									 	<thead>
												<tr>
													<th>Background Frontend</th>
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
													<td><a href="/kalbiser/{{$kalbiser->id}}/profile">{{$kalbiser->nama}}</td></a>
													<td>{{$kalbiser->nim}}</td>
													<td>{{$kalbiser->prodi}}</td>
													<td>{{$kalbiser->tahun_akademik}}</td>
													<td>{{$kalbiser->nohp}}</td>
													<td>{{$kalbiser->email}}</td>
												

													
													
													<td>
														<a href="/kalbiser/{{$kalbiser->id}}/edit" class="btn btn-sm btn-warning">Edit</a>
														<a href="/kalbiser/{{$kalbiser->id}}/delete" class="btn btn-sm btn-danger" onclick="return confirm('Jika data ini dihapus maka dapat menghilangkan seluruh kegiatan didalamnya, Apakah anda yakin ingin menghapus data ini??')">Delete</a>

														<button id="buttonViewModal" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-id="fotokalbiser/{{$kalbiser->foto}}" data-target="#viewModal">
														  View file
														</button>
													</td>
												
												</tr>
												@endif
												
												@endforeach
										</tbody>
									
									</table>
									<div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



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
				      		<form action="/kalbiser/create" method="POST" enctype="multipart/form-data">
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
				      			<select class="form-control" name="prodi" required>
							      <option value="">"------Pilih Prodi-------"</option>
							      <option value="Manajemen">Manajemen</option>
							      <option value="Akuntansi">Akuntansi</option>
							      <option value="Ilmu Komunikasi">Ilmu Komunikasi</option>
							      <option value="Informatika">Informatika</option>
							      <option value="SI">Sistem Informasi</option>
							      <option value="DKV">Desain Komunikasi Visual</option>
							    </select>
				      		</x-form.wrapper>

							<x-form.wrapper title="Tahun Akademi" required="true">
							    <select class="form-control" name="tahun_akademik" required>
							      <option value="">"------Pilih Tahun Akademik-------"</option>
							      <option value="2017">2017</option>
							      <option value="2018">2018</option>
							      <option value="2019">2019</option>
							      <option value="2020">2020</option>
							      <option value="2021">2021</option>
							    </select>
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