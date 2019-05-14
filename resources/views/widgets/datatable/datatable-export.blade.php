@rinclude('datatable')

@push('scripts')
@rinclude('datatable-footer')
<script type="text/javascript">
	$(function () {
		var tbIndex = $('#tabla').DataTable();
		@rinclude('datatable-filters')
	});
</script>
@endpush
