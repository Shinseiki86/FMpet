@extends('layouts.menu')
@section('title', '/ Personas')

@section('page_heading')
	<div class="row">
		<div id="titulo" class="col-xs-8 col-md-6 col-lg-6">
			Personas
		</div>
		<div id="btns-top" class="col-xs-4 col-md-6 col-lg-6 text-right">
			<a class='btn btn-primary' role='button' href="{{ route('Core.personas.create') }}" data-tooltip="tooltip" title="Crear Nuevo" name="create">
				<i class="fas fa-plus" aria-hidden="true"></i>
			</a>
		</div>
	</div>
@endsection

@section('section')

	<table class="table table-striped" id="tabla">
		<thead>
			<tr>
				<th class="col-md-1 all"># Doc</th>
				<th class="col-md-4 all">Nombre completo</th>
				<th class="col-md-2">Teléfono</th>
				<th class="col-md-4">Dirección</th>
				<th class="col-md-4">Correo</th>
				<th class="col-md-1 all notFilter">Cant. Mascotas</th>
				<th class="col-md-1">Creado</th>
				<th class="col-md-1 all notFilter"></th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>

	@include('widgets.modals.modal-delete')
	@include('widgets.datatable.datatable-ajax', ['urlAjax'=>'getPersonas', 'columns'=>[
		'PERS_NUMEROIDENTIFICACION',
		'PERS_NOMBREAPELLIDO',
		'PERS_TELEFONO',
		'PERS_DIRECCION',
		'PERS_CORREO',
		'count_mascotas',
		'PERS_CREADOPOR',
	]])	
@endsection
