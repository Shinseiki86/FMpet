@extends('layouts.menu')
@section('title', '/ Parametros Generales')
@include('widgets.datatable.datatable-export')


@section('page_heading')
	<div class="row">
		<div id="titulo" class="pull-left" style="width: 80%">
			Parametros Generales
		</div>
		<div id="btns-top" class="text-right" style="width: 0%">
			<a class='btn btn-primary' role='button' href="{{ route('app.parametersglobal.create') }}" data-tooltip="tooltip" title="Crear Nuevo" name="create">
				<i class="fas fa-plus" aria-hidden="true"></i>
			</a>
		</div>
	</div>
@endsection

@section('section')

	<table class="table table-striped" id="tabla">
		<thead>
			<tr>
				<th class="col-md-4">Descripción</th>
				<th class="col-md-4">Valor</th>
				<th class="col-md-6">Observaciones</th>
				<th class="col-md-1">Creado</th>
				<th class="col-md-1 all notFilter"></th>
			</tr>
		</thead>

		<tbody>
			@foreach($parametersglobal as $parameterglobal)
			<tr>
				<td>{{ $parameterglobal -> PGLO_DESCRIPCION }}</td>
				<td>{{ $parameterglobal -> PGLO_VALOR }}</td>
				<td>{{ $parameterglobal -> PGLO_OBSERVACIONES }}</td>
				<td>{{ $parameterglobal -> PGLO_CREADOPOR }}</td>
				<td>
					<!-- Botón Editar (edit) -->
					<a class="btn btn-small btn-info btn-xs" href="{{ route('app.parametersglobal.edit', [ 'PGLO_ID' => $parameterglobal->PGLO_ID ] ) }}" data-tooltip="tooltip" title="Editar">
						<i class="fas fa-edit" aria-hidden="true"></i>
					</a>

					<!-- carga botón de borrar -->
					{{ Form::button('<i class="fas fa-trash" aria-hidden="true"></i>',[
						'class'=>'btn btn-xs btn-danger btn-delete',
						'data-toggle'=>'modal',
						'data-id'=> $parameterglobal->PGLO_ID,
						'data-modelo'=> str_upperspace(class_basename($parameterglobal)),
						'data-descripcion'=> $parameterglobal->PGLO_DESCRIPCION,
						'data-action'=>'parametersglobal/'. $parameterglobal->PGLO_ID,
						'data-target'=>'#pregModalDelete',
						'data-tooltip'=>'tooltip',
						'title'=>'Borrar',
					])}}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	@include('widgets.modals.modal-delete')
@endsection