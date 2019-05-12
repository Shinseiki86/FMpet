@extends('layouts.menu')
@section('title', '/ Barrios')

@section('page_heading')
	<div class="row">
		<div id="titulo" class="col-xs-8 col-md-6 col-lg-6">
			Barrios
		</div>
		<div id="btns-top" class="col-xs-4 col-md-6 col-lg-6 text-right">
			<a class='btn btn-primary' role='button' href="{{ route('CnfgGeograficos.barrios.create') }}" data-tooltip="tooltip" title="Crear Nuevo" name="create">
				<i class="fas fa-plus" aria-hidden="true"></i>
			</a>
		</div>
	</div>
@endsection

@section('section')

	<table class="table table-striped" id="tabla">
		<thead>
			<tr>
				<th class="col-md-1">Código</th>
				<th class="col-md-4 all">Nombre</th>
				<th class="col-md-1">Estrato</th>
				{{-- <th class="col-md-1">Cod Ciudad</th> --}}
				<th class="col-md-4 all">Ciudad</th>
				<th class="hidden-xs col-md-1">Creado</th>
				<th class="col-md-1 all notFilter"></th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>

	@include('widgets.modals.modal-delete')
	@include('widgets.datatable.datatable-ajax', ['urlAjax'=>'getBarrios', 'columns'=>[
		'BARR_CODIGO',
		'BARR_NOMBRE',
		'BARR_ESTRATO',
		//'CIUDADES.CIUD_CODIGO',
		'CIUDADES.CIUD_NOMBRE',
		'BARR_CREADOPOR',
	]])	
@endsection
