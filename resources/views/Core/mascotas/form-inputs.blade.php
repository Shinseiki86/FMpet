@include('widgets.select2')
<div class='col-md-8 col-md-offset-2'>

	@include('widgets.forms.input', ['type'=>'text', 'column'=>8, 'name'=>'MASC_NOMBRE', 'label'=>'Nombre', 'options'=>['maxlength' => '300'] ])

	@include('widgets.forms.input', ['type'=>'number', 'column'=>4, 'name'=>'MASC_EDAD', 'label'=>'Edad', 'options'=>['size' => '999999'] ])

	@include('widgets.forms.input', ['type'=>'select', 'column'=>12, 'name'=>'PERS_ID', 'label'=>'Dueño', 'data'=>$arrPersonas])

	<!-- Botones -->
	@include('widgets.forms.buttons', ['url' => 'core/mascotas'])

</div>