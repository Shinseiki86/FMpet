@extends('layouts.menu')
@section('title', '/ Persona Editar')

@section('page_heading', 'Actualizar Persona')

@section('section')
{{ Form::model($persona, ['action' => ['Core\PersonaController@update', $persona->PERS_ID ], 'method' => 'PUT', 'class' => 'form-horizontal' ]) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection