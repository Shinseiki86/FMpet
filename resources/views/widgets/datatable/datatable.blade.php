@push('head')
	{!! Html::style('css/datatable/datatable/dataTables.bootstrap.min.css') !!}

	{!! Html::style('css/datatable/buttons/buttons.dataTables.min.css') !!}
	{!! Html::style('css/datatable/buttons/buttons.bootstrap4.min.css') !!}

	{!! Html::style('css/datatable/responsive/responsive.bootstrap.min.css') !!}
	{!! Html::style('css/datatable/responsive/responsive.dataTables.min.css') !!}

	{!! Html::style('css/datatable/scroller/scroller.dataTables.min.css') !!}
	{!! Html::style('css/datatable/scroller/scroller.bootstrap.min.css') !!}
@endpush

@push('scripts')
	{!! Html::script('js/datatable/libs_export/jszip.min.js') !!}
	{!! Html::script('js/datatable/libs_export/pdfmake.min.js') !!}
	{!! Html::script('js/datatable/libs_export/vfs_fonts.js') !!}

	{!! Html::script('js/datatable/datatable/jquery.dataTables.min.js') !!}
	{!! Html::script('js/datatable/datatable/dataTables.bootstrap.min.js') !!}

	{!! Html::script('js/datatable/buttons/dataTables.buttons.min.js') !!}
	{!! Html::script('js/datatable/buttons/buttons.html5.min.js') !!}
	{!! Html::script('js/datatable/buttons/buttons.colVis.min.js') !!}
	{!! Html::script('js/datatable/buttons/buttons.print.min.js') !!}
	{!! Html::script('js/datatable/buttons/buttons.flash.min.js') !!}
	{!! Html::script('js/datatable/buttons/buttons.bootstrap4.min.js') !!}

	{!! Html::script('js/datatable/responsive/dataTables.responsive.min.js') !!}
	{!! Html::script('js/datatable/responsive/responsive.bootstrap.min.js') !!}

	{!! Html::script('js/datatable/scroller/dataTables.scroller.min.js') !!}

	{!! Html::script('js/datatable/init.js') !!}

@endpush
