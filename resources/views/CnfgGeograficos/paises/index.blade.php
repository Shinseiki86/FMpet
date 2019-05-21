@extends('layouts.menu')
@section('title', '/ Países')

@section('page_heading')
	<div class="row">
		<div id="titulo" class="pull-left" style="width: 80%">
			Países
		</div>
		<div id="btns-top" class="text-right" style="width: 0%">
			<a class='btn btn-primary' role='button' href="{{ route('CnfgGeograficos.paises.create') }}" data-tooltip="tooltip" title="Crear Nuevo" name="create">
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
				<th class="col-md-5">Nombre</th>
				<th class="col-md-1">Departamentos</th>
				<th class="col-md-1">Creado</th>
				<th class="col-md-1 all notFilter"></th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>

	@include('widgets.modals.modal-delete')
	@include('widgets.datatable.datatable-ajax', ['urlAjax'=>'getPaises', 'columns'=>[
		'PAIS_CODIGO',
		'PAIS_NOMBRE',
		'count_departamentos',
		'PAIS_CREADOPOR',
	]])	
@endsection