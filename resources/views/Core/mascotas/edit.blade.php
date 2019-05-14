@extends('layouts.menu')
@section('title', '/ Mascota Editar')

@section('page_heading', 'Actualizar Mascota')

@section('section')
{{ Form::model($mascota, ['action' => ['Core\MascotaController@update', $mascota->MASC_ID ], 'method' => 'PUT', 'class' => 'form-horizontal' ]) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection