@extends('layout.master')

@section('content')
<div class="main">
	<div class="main-control">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading">
						<h3 class="panel-title">Edit Data Prodi</h3>
						</div>
						<div class="panel-body">
							<form action="{{url('/prodi/'.$prodi->id)}}/update"method="POST" enctype="multipart/form-data">
						{{csrf_field()}}

						<x-form.wrapper title="Nama Prodi" required="true">
			      			<x-form.input value="{{ $prodi->nama_prodi }}" name="nama_prodi" required placeholder="Nama Prodi" />
			      		</x-form.wrapper>
						<!--<div class="form-group">
							<input type="hidden" name="email" class="form-control" id="exampleInputEmail1" value="{{$prodi->user->email}}" aria-describedby="emailHelp" placeholder="Email">
						</div> -->

							<button type="submit" class="btn btn-warning">Update</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop