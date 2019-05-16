@extends('layouts.menu')
@section('title', '/ Publicación Editar')

@section('page_heading', 'Actualizar Publicación')

@section('section')
{{ Form::model($publicacion, ['action' => ['Core\PublicacionController@update', $publicacion->PUBL_ID ], 'method' => 'PUT', 'class' => 'form-horizontal' ]) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection