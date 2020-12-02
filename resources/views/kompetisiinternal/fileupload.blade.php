@extends('layout.master')

@section('content')
<div class="main">
	<div class="main-control">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading">
						<h3 class="panel-title">File Upload</h3>
						</div>
						<div class="panel-body">
							
							<form action="{{url('/kompetisiinternal/fileupload/'.$kompetisiinternal->id)}}" method="POST" enctype="multipart/form-data">
						{{csrf_field()}}

							<div class="col">
								<x-form.wrapper title="">
									<input type="file" name="files[]">
								</x-form.wrapper>
								<x-form.wrapper title="">
									<input type="file" name="files[]">
								</x-form.wrapper>
								<x-form.wrapper title="">
									<input type="file" name="files[]">
								</x-form.wrapper>
								<x-form.wrapper title="">
									<input type="file" name="files[]">
								</x-form.wrapper>
								<x-form.wrapper title="">
									<input type="file" name="files[]">
								</x-form.wrapper>
							</div>


							<button type="submit" class="btn btn-warning">Upload</button>
							</form>
						</div>
					</div>

					<table class="table table-bordered">
						<tr>
							<td></td>
							<td>Action</td>
						</tr>
						@foreach($files as $file)
						<tr>
							<td>
								<img src="{{ asset($file->file) }}" alt="" style="height: 200px; width: 200px">
							</td>
							<td>
								<form action="{{url('/kompetisiinternal/removeFile/'.$file->id)}}" method="POST">
									@csrf
									@method('DELETE')
									<button type="submit" class="btn btn-danger">Delete</button>
								</form>
								<form action="{{ route('file.download') }}" method="POST">
									@csrf
									<input type="hidden" name="file" value="{{ $file->file }}">
									<button type="submit" class="btn btn-info">Donwload</button>
								</form>
							</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@stop