<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addModalLabel">Tambah / Edit Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form_status">
					<div class="form-group">
						<select style="width: 100%;" class="form-control" name="id_rig" id="id_rig" autocomplete="off"></select>
						<small id="id_rig_help" class="form-text text-muted">Pilih RIG yang masih memiliki SLOT</small>
					</div>
					<div class="form-group">
						<select style="width: 100%;" class="form-control" name="id_type" id="id_type" autocomplete="off"></select>
					</div>
					<div class="form-group">
						<select style="width: 100%;" class="form-control" name="id_barang" id="id_barang" autocomplete="off"></select>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary" id="save">Simpan</button>
						<button type="button" class="btn btn-warning" id="update" style="display: none;">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
