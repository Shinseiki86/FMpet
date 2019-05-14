@extends('layouts.menu')
@section('title', '/ Ciudad Crear')

@section('page_heading', 'Nueva Ciudad')

@section('section')
{{ Form::open(['route' => 'CnfgGeograficos.ciudades.store', 'class' => 'form-horizontal']) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection
