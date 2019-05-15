@extends('layouts.menu')
@section('title', '/ Mascotas')

@section('page_heading')
	<div class="row">
		<div id="titulo" class="col-xs-8 col-md-6 col-lg-6">
			Mascotas
		</div>
		<div id="btns-top" class="col-xs-4 col-md-6 col-lg-6 text-right">
			<a class='btn btn-primary' role='button' href="{{ route('Core.mascotas.create') }}" data-tooltip="tooltip" title="Crear Nuevo" name="create">
				<i class="fas fa-plus" aria-hidden="true"></i>
			</a>
		</div>
	</div>
@endsection

@section('section')

	<table class="table table-striped" id="tabla">
		<thead>
			<tr>
				<th class="col-md-1">ID</th>
				<th class="col-md-4 all">Mascota</th>
				<th class="col-md-1">Edad</th>
				<th class="col-md-4 all">Dueño</th>
				<th class="col-md-1">Creado</th>
				<th class="col-md-1 all notFilter"></th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>

	@include('widgets.modals.modal-delete')
	@include('widgets.datatable.datatable-ajax', ['urlAjax'=>'getMascotas', 'columns'=>[
		'MASC_ID',
		'MASC_NOMBRE',
		'MASC_EDAD',
		'PERS_NOMBREAPELLIDO',
		'MASC_CREADOPOR',
	]])	
@endsection
