@extends('layouts.menu')

@section('page_heading', 'Nuevo Barrio')

@section('section')
{{ Form::open(['route' => 'CnfgGeograficos.barrios.store', 'class' => 'form-horizontal']) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection
