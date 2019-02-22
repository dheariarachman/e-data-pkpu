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
						<input type="hidden" class="form-control" id="id_barang" name="id_barang">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="name_barang" placeholder="Nama Barang" name="name_barang"  autocomplete="off">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="serial_num" placeholder="Serial Number" name="serial_num" autocomplete="off">
                    </div>
                    <div class="form-group">
						<select style="width: 100%" class="form-control" name="id_type" id="id_type" autocomplete="off"></select>
                    </div>
                    <div class="form-group">
						<input type="text" class="form-control" id="stock_in" placeholder="Tanggal Masuk" name="stock_in" autocomplete="off">
					</div>
					<div class="form-group">
						<select style="width: 100%;" class="form-control" name="id_rig" id="id_rig" autocomplete="off"></select>
                    </div>
                    <div class="form-group">
						<select style="width: 100%;" class="form-control" name="id_status_barang" id="id_status_barang" autocomplete="off"></select>
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