@extends('layouts.menu')

@section('page_heading', 'Nuevo País')

@section('section')
{{ Form::open(['route' => 'CnfgGeograficos.paises.store', 'class' => 'form-horizontal']) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection
