@extends('layouts.plane')

@section('body')
	<!--div id="pageLoading">Cargando...</div-->

	@include('layouts.menu.menu-top')

	<div id="wrapper">

		@include('layouts.menu.menu-left')

		<div id="page-wrapper">

			<div class="row" style="position: fixed;width: 100%;z-index: 10;background: white;top: 50px;">
				<div class="col-lg-12">
					<h1 class="page-header" style="margin-bottom: 0px;">@yield('page_heading', 'Bienvenido!')</h1>
				</div>
			</div>

			<div class="row" style="padding-top: 80px;">
				@yield('section', '')
			</div>
			
		</div><!-- /#page-wrapper -->

	</div><!-- /.wrapper -->

@endsection