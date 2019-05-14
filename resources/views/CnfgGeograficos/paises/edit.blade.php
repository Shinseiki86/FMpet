@extends('layouts.menu')
@section('title', '/ País Editar')

@section('page_heading', 'Actualizar País')

@section('section')
{{ Form::model($pais, ['action' => ['CnfgGeograficos\PaisController@update', $pais->PAIS_ID ], 'method' => 'PUT', 'class' => 'form-horizontal' ]) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection