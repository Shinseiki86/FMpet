@extends('layouts.menu')

@section('page_heading', 'Nuevo Departamento')

@section('section')
{{ Form::open(['route' => 'CnfgGeograficos.departamentos.store', 'class' => 'form-horizontal']) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection
