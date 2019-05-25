@extends('layouts.menu')
@section('title', '/ Dashboard')

@section('page_heading')
	<div class="row">
		<div id="titulo" class="pull-left" style="width: 80%">
			Dashboard
		</div>
		<div id="btns-top" class="text-right" style="width: 0%">
			
		</div>
	</div>
@endsection

@section('section')

	@include('widgets.charts.panelchart', ['idCanvas' => 'chart1', 'title' => 'Usuarios x Rol' ])
	@include('widgets.charts.panelchart', ['idCanvas' => 'chart2', 'title' => 'Publicaciones x Fecha' ])

@endsection

@push('scripts')
	{!! Html::script('js/chart.js/Chart.min.js') !!}
	{!! Html::script('js/momentjs/moment-with-locales.min.js') !!}
	{!! Html::script('js/chart.js/dashboard.js') !!}
	<script type="text/javascript">
		$(function () {
			
			//función newChart para crear gráfico en los panelchart.
			newChart(
				'getDashboardUsuariosPorRol',
				'Usuarios x Rol',
				'Rol',
				'count',
				'chart1',
				'bar'
			);
			newChart(
				'getDashboardPublicacionesPorFecha',
				'Publicaciones x Fecha',
				'fecha',
				'count',
				'chart2',
				'line'
			);
		});
	</script>
@endpush