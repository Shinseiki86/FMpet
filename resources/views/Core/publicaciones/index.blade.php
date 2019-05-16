@extends('layouts.menu')
@section('title', '/ Publicaciones')

@section('page_heading')
	<div class="row">
		<div id="titulo" class="col-xs-8 col-md-6 col-lg-6">
			Publicaciones
		</div>
		<div id="btns-top" class="col-xs-4 col-md-6 col-lg-6 text-right">
			<a class='btn btn-primary' role='button' href="{{ route('Core.publicaciones.create') }}" data-tooltip="tooltip" title="Crear Nuevo" name="create">
				<i class="fas fa-plus" aria-hidden="true"></i>
			</a>
		</div>
	</div>
@endsection

@section('section')

	<table class="table table-striped" id="tabla">
		<thead>
			<tr>
				<th class="col-md-4 all">Título</th>
				{{-- <th class="col-md-4">Descripción</th> --}}
				<th class="col-md-4">Nombre publicador</th>
				<th class="col-md-1 all">Latitud</th>
				<th class="col-md-1 all">longitud</th>
				<th class="col-md-1">Creado</th>
				<th class="col-md-1 all notFilter"></th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>

	@include('widgets.modals.modal-delete')
	@include('widgets.datatable.datatable-ajax', ['urlAjax'=>'getPublicaciones', 'columns'=>[
		'PUBL_TITULO',
		//'PUBL_DESCRIPCION',
		'PERS_NOMBREAPELLIDO',
		'PUBL_LATITUD',
		'PUBL_LONGITUD',
		'PUBL_CREADOPOR',
	]])	
@endsection
