@extends('layout.master')

@section('content')
<div class="main">
	<div class="main-control">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading">
						<h3 class="panel-title">Edit Data Ormawa</h3>
						</div>
						<div class="panel-body">
							<form action="{{url('/ormawa/'.$ormawa->id)}}/update" method="POST" enctype="multipart/form-data">
						{{csrf_field()}}

						<div class="form-group">
						<label for="exampleInputEmail1">Logo Ormawa</label>
						<input type="file" name="logo_ormawa" value="{{$ormawa->logo_ormawa}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Depan">
						</div>

			      		<x-form.wrapper title="Nama Ormawa" required="true">
			      			<x-form.input value="{{ $ormawa->nama_ormawa }}" name="nama_ormawa" required placeholder="Nama Ormawa" />
			      		</x-form.wrapper>
			
			      		<x-form.wrapper title="Kategori Ormawa" required="true">
			      			<x-form.input value="{{ $ormawa->kategori_ormawa }}" name="kategori_ormawa" required placeholder="Kategori Ormawa" />
			      		</x-form.wrapper>
			
			      		<x-form.wrapper title="Visi" required="true">
			      			<x-form.input value="{{ $ormawa->visi }}" name="visi" required placeholder="Visi" />
			      		</x-form.wrapper>
			
			      		<x-form.wrapper title="Misi" required="true">
			      			<x-form.input value="{{ $ormawa->misi }}" name="misi" required placeholder="Misi" />
			      		</x-form.wrapper>

						<div class="form-group">
							<input type="hidden" name="email" class="form-control" id="exampleInputEmail1" value="{{$ormawa->email}}" aria-describedby="emailHelp" placeholder="Email">
						</div>

						<div class="form-group">
							<input type="hidden" name="password" class="form-control" id="exampleInputEmail1" value="{{$ormawa->password}}" aria-describedby="emailHelp" placeholder="Password">
						</div>

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