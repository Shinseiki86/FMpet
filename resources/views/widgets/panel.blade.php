<div class="panel panel-{{{ isset($class) ? $class : 'default' }}}">
	@if( isset($header) )  
		<div class="panel-heading" role="tab" id='{{$as}}' style="padding-bottom: 25px;">
			<h3 class="panel-title">@yield ($as . '_panel_title')
				@if( isset($controls) )  
				<div class="panel-control pull-right">
					<a class="panelButton"><i class="fas fa-refresh"></i></a>
					<a class="panelButton"><i class="fas fa-minus"></i></a>
					<a class="panelButton"><i class="fas fa-remove"></i></a>
				</div>
				@endif
			</h3>
		</div>
	@endif

	@if( isset($collapse))
	<div id="collapse_{{$as}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="{{$as}}">
	@endif
		<div class="panel-body">
			@yield ($as . '_panel_body')
		</div>
		@if( isset($footer))
			<div class="panel-footer">@yield ($as . '_panel_footer')</div>
		@endif
	@if( isset($collapse))
	</div>
	@endif
</div>

