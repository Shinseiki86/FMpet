@extends('layouts.menu')
@section('title', '/ Departamentos')

@section('page_heading')
	<div class="row">
		<div id="titulo" class="pull-left" style="width: 80%">
			Departamentos
		</div>
		<div id="btns-top" class="text-right" style="width: 0%">

			<!-- Importar registros por excel -->
			@include('widgets.modals.modal-import', ['model'=>'Departamento'])

			<a class='btn btn-primary' role='button' href="{{ route('CnfgGeograficos.departamentos.create') }}" data-tooltip="tooltip" title="Crear Nuevo" name="create">
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
				<th class="col-md-3">Nombre</th>
				<th class="col-md-3">País</th>
				<th class="col-md-1 notFilter">Ciudades</th>
				<th class="col-md-1">Creado</th>
				<th class="col-md-1 all notFilter"></th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>

	@include('widgets.modals.modal-delete')
	@include('widgets.datatable.datatable-ajax', ['urlAjax'=>'getDepartamentos', 'columns'=>[
		'DEPA_CODIGO',
		'DEPA_NOMBRE',
		'PAISES.PAIS_NOMBRE',
		'count_ciudades',
		'DEPA_CREADOPOR',
	]])	
@endsection