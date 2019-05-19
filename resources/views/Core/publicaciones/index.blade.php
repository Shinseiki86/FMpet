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

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	{{ $publicaciones->links() }}
	@foreach($publicaciones as $pub)

		@section('pub_'.$pub->PUBL_ID.'_panel_title')
			<a role="button" data-toggle="collapse" data-parent="#accordion" href="#{{'collapse_pub_'.$pub->PUBL_ID}}" aria-expanded="true" aria-controls="{{'pub_'.$pub->PUBL_ID}}">
				<div class=" pull-left">
	      			<span class="small">{{datetime($pub->PUBL_FECHACREADO, true)}}</span> {{$pub->PUBL_TITULO}}
	      		</div>
				<div class=" pull-right">
	      			Comentarios <span class="badge">{{$pub->comentarios->count()}}</span>
	      		</div>
	        </a>
		@endsection

		@section('pub_'.$pub->PUBL_ID.'_panel_body')
			<p>{{$pub->PUBL_DESCRIPCION}}</p>
			@foreach($pub->comentarios as $comment)
				<div class="col-xs-12 ">
					<div class="panel panel-default">
						<div class="panel-body">
							{{$comment->COME_DESCRIPCION}}
						</div>
						<div class="panel-footer"  style="padding-bottom: 25px; padding-top: 3px;">
							<div class=" pull-left">
								{{ $comment->COME_CREADOPOR }}
							</div>
							<div class=" pull-right">
								<!-- Botón Editar (edit) -->
								{{ Html::link( route('Core.publicaciones.edit', $comment->COME_ID),
									'<i class="fas fa-edit fa-fw" aria-hidden="true"></i>', [
										'class'=>'btn btn-xs btn-info',
										'title'=>'Editar',
										'data-tooltip'=>'tooltip'
									],null,false)
								}}
								<!-- carga botón de borrar -->
								{{ Form::button('<i class="fas fa-trash" aria-hidden="true"></i>',[
									'class'=>'btn btn-xs btn-danger btn-delete',
									'data-toggle'=>'modal',
									'name'=>'delete',
									'data-id'=>$comment->COME_ID,
									'data-modelo'=> 'Comentario',
									'data-descripcion'=> $comment->COME_ID,
									'data-action'=>'comentarios/'.$comment->COME_ID,
									'data-target'=>'#pregModalDelete',
									'data-tooltip'=>'tooltip',
									'title'=>'Borrar',
								])}}
							</div>
						</div>
					</div>
				</div>
			@endforeach
		@endsection

		@section('pub_'.$pub->PUBL_ID.'_panel_footer')
			<div class="form-group" style="margin-bottom: 20px;">
				<div class=" pull-left">
					LongLat({{$pub->PUBL_LATITUD.','.$pub->PUBL_LONGITUD }})
				</div>
				<div class=" pull-right">
					<!-- Botón Editar (edit) -->
					{{ Html::link( route('Core.publicaciones.edit', $pub->PUBL_ID),
						'<i class="fas fa-edit fa-fw" aria-hidden="true"></i>', [
							'class'=>'btn btn-xs btn-info',
							'title'=>'Editar',
							'data-tooltip'=>'tooltip'
						],null,false)
					}}
				</div>
			</div>
		@endsection

		<div class="col-xs-12 col-md-6 col-lg-4">
			@include('widgets.panel', [
				'as'=>'pub_'.$pub->PUBL_ID,
				'class'=>$pub->publicacionTipo->PUTI_CLASS,
				'collapse'=>true,
				'header'=>true,
				'footer'=>true
			])
		</div>

	@endforeach
</div>
	@include('widgets.modals.modal-delete')
@endsection
