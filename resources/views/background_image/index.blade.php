@extends('layout.master')

@section('content')
<div class="main" style="margin-top: 50px !important">
	<div class="main-control">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">Background Image</h3>
							<div class="right">
								<a href="{{ route('background_images.create') }}" class="btn btn-primary">
									<i class="lnr lnr-plus-circle"></i> Create
								</a>
							</div>
						</div>
						<div class="panel-body">
							<table class="table table-hover data">
								<thead>
									<tr>
										<th>Title</th>
										<th>Image</th>
										<th>#</th>
									</tr>
								</thead>
								<tbody>
									@foreach($rows as $row)
									<tr>						
										<td>{{ $row->title }}</td>
										<td>
											<img src="{{ asset('background_image/' . $row->file) }}" alt="{{ $row->title }}" style="height: 200px; widows: 200px;">
										</td>
										@if(auth()->user()->role == 'admin')
										<td>
											<a href="{{ route('background_images.edit', $row->id) }}" class="btn btn-sm btn-warning">Edit</a>

											<form action="{{ route('background_images.destroy', $row->id) }}" method="POST">
												@csrf
												@method("DELETE")

												<button onclick="return confirm('Are you sure want to delete this data?')" type="submit" class="btn btn-danger">Delete</button>
											</form>
										</td>
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
@endsection