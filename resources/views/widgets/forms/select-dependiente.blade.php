@push('scripts')
	{!! Html::script('js/select2/select2-dependiente.js') !!}
	<script type='text/javascript'>
		$(document).ready(function(){
			if( $('#{{$children}}').val() == '' || $('#{{$children}}').val() == null)
				$('#{{$children}}').prop('disabled', true);

			var parentValue = $('#{{$parent}}').val();
			console.log('{!! url('getDataSelectDepediente').'?model='.$model.'&parent='.$parent.'&return='.$column !!}&value='+parentValue);
			fillDropDownAjax(
				'{{$parent}}',
				$('#{{$children}}'),
				'{!! url('getDataSelectDepediente').'?model='.$model.'&parent='.$parent.'&return='.$column !!}',
				'{{isset($idBusqueda)?$idBusqueda:$children}}',
				'{{$column}}',
				'{{isset($msgModel)?$msgModel:'datos'}}'
			)
		});
	</script>
@endpush

