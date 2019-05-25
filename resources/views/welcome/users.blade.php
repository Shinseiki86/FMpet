@extends('layouts.menu')
@section('title', '/ Home')

@section('page_heading')
	<div class="row">
		<div id="titulo" class="pull-left" style="width: 80%">
			Bienvenido {{Entrust::user()->name}}
		</div>
		<div id="btns-top" class="text-right" style="width: 0%">
		</div>
	</div>
@endsection

@section('section')

@endsection
