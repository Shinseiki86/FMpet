@include('widgets.select2')
<div class='col-md-8 col-md-offset-2'>

	@include('widgets.forms.input', ['type'=>'text', 'column'=>4, 'name'=>'CIUD_CODIGO', 'label'=>'Código', 'options'=>['maxlength' => '25'] ])

	@include('widgets.forms.input', ['type'=>'text', 'column'=>8, 'name'=>'CIUD_NOMBRE', 'label'=>'Nombre', 'options'=>['maxlength' => '300'] ])

	{{-- @include('widgets.forms.input', ['type'=>'select', 'name'=>'DEPA_ID', 'label'=>'Departamento', 'data'=>$arrDepartamentos ]) --}}

	@include('widgets.forms.input', ['type'=>'select', 'name'=>'DEPA_ID', 'label'=>'Departamento', 'ajax'=>['model'=>'Departamento','column'=>'DEPA_NOMBRE'], 'options'=>['required'] ])

	<!-- Botones -->
	@include('widgets.forms.buttons', ['url' => 'CnfgGeograficos/ciudades'])

</div>