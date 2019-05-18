@push('scripts')
	{!! Html::script('js/select2/select2-dependiente.js') !!}
	<script type='text/javascript'>
		$(document).ready(function(){
			if( $('#{{$children}}').val() == '' || $('#{{$children}}').val() == null)
				$('#{{$children}}').prop('disabled', true);

			fillDropDownAjax(
				'{{$parent}}',
				$('#{{$children}}'),
				'{!! url('getArrModel').'?model='.$model.'&column='.$column !!}',
				'{{isset($idBusqueda)?$idBusqueda:$children}}',
				'{{$column}}',
				'{{isset($msgModel)?$msgModel:'datos'}}'
			)
		});
	</script>
@endpush

