@extends('layouts.menu')
@section('title', '/ Barrio Editar')

@section('page_heading', 'Actualizar Barrio')

@section('section')
{{ Form::model($barrio, ['action' => ['CnfgGeograficos\BarrioController@update', $barrio->BARR_ID ], 'method' => 'PUT', 'class' => 'form-horizontal' ]) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection