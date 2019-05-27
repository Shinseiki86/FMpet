@extends('layouts.menu')
@section('title', '/ Publicaciones')

@section('page_heading')
	<div class="row">
		<div id="titulo" class="pull-left" style="width: 80%">
			Publicaciones
		</div>
		<div id="btns-top" class="text-right" style="width: 0%">
			<a class='btn btn-primary' role='button' href="{{ route('Core.publicaciones.create') }}" data-tooltip="tooltip" title="Crear Nuevo" name="create">
				<i class="fas fa-plus" aria-hidden="true"></i>
			</a>
		</div>
	</div>
@endsection

@section('section')

{{ $publicaciones->links() }}
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	@foreach($publicaciones as $pub)

		@section('pub_'.$pub->PUBL_ID.'_panel_title')
			<a role="button" data-toggle="collapse" data-parent="#accordion" href="#{{'collapse_pub_'.$pub->PUBL_ID}}" aria-expanded="true" aria-controls="{{'pub_'.$pub->PUBL_ID}}">
      			<span class="small">{{datetime($pub->PUBL_FECHACREADO, true)}}</span> {{$pub->PUBL_TITULO}}
				<span class="hidden-xs hidden-sm pull-right">
	      			Comentarios <span class="badge">{{$pub->comentarios->count()}}</span>
	      		</span>
	        </a>
		@endsection

		@section('pub_'.$pub->PUBL_ID.'_panel_body')
			<div class="col-xs-12 col-md-8">
				<p>{{$pub->PUBL_DESCRIPCION}}</p>
			</div>
			<div class="col-xs-12 col-md-4">
				@if($pub->adjuntos->count() > 0)
					@include('widgets.carousel', [
						'name'=>'adjuntos_pub_'.$pub->PUBL_ID,
						'images'=>$pub->adjuntos->pluck('ADJU_PATH')
							->map(function($path) use($pub){
								return asset('adjuntos/'.$pub->PUBL_ID.'/'.$path);
							}),
						'maxHeight'=>'200px'
					])
				@endif
				<br>
			</div>

			@foreach($pub->comentarios as $i=>$comment)
				<div class="col-xs-12 ">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">Comentario {{$i+1}}</h4>
						</div>
						<div class="panel-body">
							<div class="col-xs-12 col-md-8">
								<p>{{$comment->COME_DESCRIPCION}}</p>
							</div>
							<div class="col-xs-12 col-md-4">
								@if($comment->adjuntos->count() > 0)
									@include('widgets.carousel', [
										'name'=>'adjuntos_com_'.$comment->COME_ID,
										'images'=>$comment->adjuntos->pluck('ADJU_PATH')
											->map(function($path) use($pub){
												return asset('adjuntos/'.$pub->PUBL_ID.'/'.$path);
											}),
										'maxHeight'=>'200px'
									])
								@endif
							</div>
						</div>
						<div class="panel-footer"  style="padding-bottom: 25px; padding-top: 3px;">
							<div class=" pull-left">
								{{ $comment->COME_CREADOPOR }}
							</div>
							<div class=" pull-right">
								<!-- Botón Editar (edit) -->
								{{-- Html::link( route('Core.publicaciones.edit', $comment->COME_ID),
									'<i class="fas fa-edit fa-fw" aria-hidden="true"></i>', [
										'class'=>'btn btn-xs btn-info',
										'title'=>'Editar',
										'data-tooltip'=>'tooltip'
									],null,false)
								--}}
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
					<br>
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

		<div class="col-xs-12">
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
