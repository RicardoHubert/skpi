<div class="col">
	<input 
		type="file" 
		name="{{ $name }}" 
		class="form-control" 
		placeholder="{{ $placeholder ?? null }}" 
		{{ isset($required) ? 'required' : null }}>
	<span>
		(Maksimal dokumen 5 MB & format JPEG)
	</span>

	@if($errors->first($name))
	<p style="color: red">{{ $errors->first($name) }}</p>
	@endif

	{{ $slot }}
</div>
	