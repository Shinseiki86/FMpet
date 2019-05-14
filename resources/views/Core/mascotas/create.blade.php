@extends('layouts.menu')
@section('title', '/ Mascota Crear')

@section('page_heading', 'Nueva Mascota')

@section('section')
{{ Form::open(['route' => 'Core.mascotas.store', 'class' => 'form-horizontal']) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection
