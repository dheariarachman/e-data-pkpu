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
						<input type="text" class="form-control" id="id_rig" aria-describedby="id_rig_help" placeholder="Masukan ID RIG"
						 name="id_rig" autocomplete="off">
						<small id="id_rig_help" class="form-text text-muted">Setelah Dibuat, ID Tidak bisa diubah.</small>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="name_rig" placeholder="Nama RIG" name="name_rig" autocomplete="off">
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
