@extends('layouts.menu')
@section('title', '/ Persona Crear')

@section('page_heading', 'Nueva Persona')

@section('section')
{{ Form::open(['route' => 'Core.personas.store', 'class' => 'form-horizontal']) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection
