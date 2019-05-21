@include('widgets.select2')
<div class='col-md-8 col-md-offset-2'>

	@include('widgets.forms.input', ['type'=>'text', 'column'=>8, 'name'=>'PUBL_TITULO', 'label'=>'Título', 'options'=>['maxlength' => '50', 'required'] ])

	@include('widgets.forms.input', ['type'=>'number', 'column'=>2, 'name'=>'PUBL_LATITUD', 'label'=>'Lat', 'options'=>['size' => '999999', 'required'] ])
	@include('widgets.forms.input', ['type'=>'number', 'column'=>2, 'name'=>'PUBL_LONGITUD', 'label'=>'Long', 'options'=>['size' => '999999', 'required'] ])


	@include('widgets.forms.input', [ 'type'=>'textarea', 'name'=>'PUBL_DESCRIPCION', 'label'=>'Descripción', 'options'=>['maxlength' => '300', 'required'] ])


	@include('widgets.forms.input', ['type'=>'select', 'column'=>6, 'name'=>'PUES_ID', 'label'=>'Estado', 'data'=>$arrPubEstados, 'options'=>['required'] ])
	@include('widgets.forms.input', ['type'=>'select', 'column'=>6, 'name'=>'PUTI_ID', 'label'=>'Tipo', 'data'=>$arrPubTipos, 'options'=>['required'] ])

	@include('widgets.forms.input', ['type'=>'select', 'column'=>6, 'name'=>'PERS_ID', 'label'=>'Dueño', 'data'=>$arrPersonas, 'options'=>['required'] ])
	@include('widgets.forms.input', ['type'=>'select', 'column'=>6, 'name'=>'MASC_ID', 'label'=>'Mascota', 'data'=>$arrMascotas, 'options'=>['required'] ])


	@include('widgets.forms.input', ['type'=>'select', 'column'=>6, 'name'=>'PAIS_ID', 'label'=>'Pais', 'data'=>$arrPaises, 'options'=>['required'] ])
	
	@include('widgets.forms.input', ['type'=>'select', 'column'=>6, 'name'=>'DEPA_ID', 'label'=>'Departamento',
		'dependiente'=>['parent'=>'PAIS_ID', 'model'=>'Departamento', 'column'=>'DEPA_NOMBRE'],
		'options'=>['required']
	])
	@include('widgets.forms.input', ['type'=>'select', 'column'=>6, 'name'=>'CIUD_ID', 'label'=>'Ciudad',
		'dependiente'=>['parent'=>'DEPA_ID', 'model'=>'Ciudad', 'column'=>'CIUD_NOMBRE'],
		'options'=>['required']
	])

	@include('widgets.forms.input', ['type'=>'select', 'column'=>6, 'name'=>'BARR_ID', 'label'=>'Barrio',
		'dependiente'=>['parent'=>'CIUD_ID', 'model'=>'Barrio', 'column'=>'BARR_NOMBRE'],
		'options'=>['required']
	])


	@include('widgets.forms.input', [ 'type'=>'file', 'name'=>'arrAdjuntos[]', 'label'=>'Adjuntos', 'options'=>['maxlength' => '255', 'multiple', 'accept'=>'image/*'] ])

	<!-- Botones -->
	@include('widgets.forms.buttons', ['url' => 'core/publicaciones'])

</div>