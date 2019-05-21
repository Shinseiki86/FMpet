{{ Form::file( 
	isset($multiple) && $multiple ? $name.'[]':$name,
	['class'=>'form-control'] + (isset($options)?$options:[]) + (isset($multiple) && $multiple ? ['multiple']:[])
)}}

<pre id="filelist_{{$name}}" style="display:none;"></pre>

@push('scripts')
<script type="text/javascript">
	document.getElementById('{{$name}}').addEventListener('change', function(e) {
		var list = document.getElementById('filelist_{{$name}}');
		list.innerHTML = '';
		for (var i = 0; i < this.files.length; i++) {
			list.innerHTML += (i + 1) + '. ' + this.files[i].name + '\n';
		}
		if (list.innerHTML == '') list.style.display = 'none';
		else list.style.display = 'block';
	});

</script>
@endpush