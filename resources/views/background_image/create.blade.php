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
						</div>
						<div class="panel-body">
							<form action="{{ route('background_images.store') }}" enctype="multipart/form-data" method="POST">
								@csrf							
								<x-form.wrapper title="Title">
									<x-form.input name="title" />
								</x-form.wrapper>				
								<x-form.wrapper title="Image">
									<x-form.file name="file" />
								</x-form.wrapper>
								<x-form.button text="Submit"></x-form.button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection