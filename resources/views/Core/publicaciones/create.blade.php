@extends('layouts.menu')
@section('title', '/ Publicación Crear')

@section('page_heading', 'Nueva Publicación')

@section('section')
{{ Form::open(['route' => 'Core.publicaciones.store', 'class' => 'form-horizontal', 'files' => true ]) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection
