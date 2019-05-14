@include('widgets.select2')
<div class='col-md-8 col-md-offset-2'>

	@include('widgets.forms.input', ['type'=>'number', 'column'=>4, 'name'=>'PERS_NUMEROIDENTIFICACION', 'label'=>'# Documento', 'options'=>['size' => '999999999999999'] ])
	{{-- <div class="clearfix"></div> --}}

	@include('widgets.forms.input', ['type'=>'text', 'column'=>4, 'name'=>'PERS_NOMBRE', 'label'=>'Nombres', 'options'=>['maxlength' => '50'] ])
	@include('widgets.forms.input', ['type'=>'text', 'column'=>4, 'name'=>'PERS_APELLIDO', 'label'=>'Apellidos', 'options'=>['maxlength' => '50'] ])

	@include('widgets.forms.input', ['type'=>'number', 'column'=>4, 'name'=>'PERS_TELEFONO', 'label'=>'# Teléfono', 'options'=>['size' => '999999999999999'] ])
	@include('widgets.forms.input', ['type'=>'text', 'column'=>8, 'name'=>'PERS_DIRECCION', 'label'=>'Dirección residencia', 'options'=>['maxlength' => '100'] ])

	@include('widgets.forms.input', ['type'=>'email', 'column'=>12, 'name'=>'PERS_CORREO', 'label'=>'Correo', 'options'=>['maxlength' => '320'] ])

	<!-- Botones -->
	@include('widgets.forms.buttons', ['url' => 'core/personas'])

</div>