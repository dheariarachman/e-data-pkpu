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
						<input type="text" class="form-control" id="id_status" aria-describedby="id_status_help" placeholder="Masukan ID Status"
						 name="id_status">
						<small id="id_status_help" class="form-text text-muted">Setelah Dibuat, ID Tidak bisa diubah.</small>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="name_status" placeholder="Nama Status" name="name_status">
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
