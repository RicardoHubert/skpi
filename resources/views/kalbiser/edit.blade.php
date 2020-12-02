@extends('layout.master')

@section('content')
<div class="main">
	<div class="main-control">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading">
						<h3 class="panel-title">Edit Data Kalbiser</h3>
						</div>
						<div class="panel-body">
							<form action="{{url('/kalbiser/'.$kalbiser->id)}}/update" method="POST" enctype="multipart/form-data">
						{{csrf_field()}}

						<div class="form-group">
						<label>Foto</label>
						<input type="file" name="foto" value="{{$kalbiser->foto}}" class="form-control">
						</div>

						@if(auth()->user()->role == 'admin')

						<x-form.wrapper title="Nama" required="true">
			      			<x-form.input value="{{ $kalbiser->nama }}" name="nama_ormawa" required placeholder="Nama Kalbiser" />
			      		</x-form.wrapper>


						<x-form.wrapper title="NIM" required="true">
			      			<x-form.input value="{{ $kalbiser->nim }}" name="nim" required placeholder="NIM" />
			      		</x-form.wrapper>

							<x-form.wrapper title="Program Studi" required="true">
				      			<select class="form-control" name="prodi_id" required>
							      <option value="">"------Pilih Prodi-------"</option>
							      @foreach($prodi as $p)
							      <option value="{{ $p->id }}" {{ $kalbiser->prodi_id == $p->id ? 'selected' : null }}>{{ $p->nama_prodi }}</option>
							      @endforeach

							    </select>
				      		</x-form.wrapper>

						<x-form.wrapper title="No.Handphone" required="true">
			      			<x-form.input value="{{ $kalbiser->nohp }}" name="nohp" required placeholder="No.Handphone" />
			      		</x-form.wrapper>

			      		<x-form.wrapper title="Student Email" required="true">
			      			<x-form.input value="{{ $kalbiser->email }}" name="email" required placeholder="Email" />
			      		</x-form.wrapper>

						<button type="submit" class="btn btn-warning">Edit</button>

						@elseif(auth()->user()->role == 'student')

						<x-form.wrapper title="No.Handphone" required="true">
			      			<x-form.input value="{{ $kalbiser->nohp }}" name="nohp" required placeholder="No.Handphone" />
			      		</x-form.wrapper>

			      		<button type="submit" class="btn btn-warning">Edit</button>
			      		@endif

							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop