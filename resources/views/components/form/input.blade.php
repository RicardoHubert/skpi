<input 
	type="{{ $type ?? 'text'}}" 
	name="{{ $name }}" 
	class="form-control" 
	value="{{ $value ?? null }}"
	placeholder="{{ $placeholder ?? null }}" 
	{{ isset($required) ? 'required' : null }}>