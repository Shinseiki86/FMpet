@include('widgets.select2')
<div class='col-md-8 col-md-offset-2'>

	@include('widgets.forms.input', ['type'=>'text', 'column'=>4, 'name'=>'BARR_CODIGO', 'label'=>'Código', 'options'=>['maxlength' => '25'] ])

	@include('widgets.forms.input', ['type'=>'text', 'column'=>8, 'name'=>'BARR_NOMBRE', 'label'=>'Nombre', 'options'=>['maxlength' => '300'] ])

	@include('widgets.forms.input', ['type'=>'number', 'column'=>4, 'name'=>'BARR_ESTRATO', 'label'=>'Estrato', 'options'=>['size' => '999999'] ])

	@include('widgets.forms.input', ['type'=>'select', 'column'=>8, 'name'=>'CIUD_ID', 'label'=>'Ciudad', 'data'=>$arrCiudades ])

	<!-- Botones -->
	@include('widgets.forms.buttons', ['url' => 'CnfgGeograficos/barrios'])

</div>