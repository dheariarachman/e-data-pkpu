<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
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
						<input type="text" class="form-control" id="id" aria-describedby="id_help" name="id" autocomplete="off" disabled>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="customer" placeholder="Nama Customer" name="customer" autocomplete="off">
					</div>

					<div class="form-group">
						<textarea class="form-control" id="c_address" name="c_address" placeholder="Alamat"></textarea>
					</div>

					<!-- Bilyet K -->

					<div class="form-group row">
					    <div class="col-sm-3">BILYET K</div>
					    <div class="col-sm-9">
					      <div class="form-check">
					        <input class="form-check-input" type="checkbox" id="bilyet_k" name="bilyet_k" value="1">
					        <label class="form-check-label" for="gridCheck1">
					          Available
					        </label>
					      </div>
					    </div>
					  </div>

				  	<div class="form-group row">
					    <label for="Bilyet_K" class="col-sm-3 col-form-label"></label>					    
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="bilyet_k_detail" name="bilyet_k_detail" placeholder="Blyet K Detail">
					    </div>
				  	</div>

				  	<!-- BILYET 5 -->

				  	<div class="form-group row">
					    <div class="col-sm-3">BILYET S</div>
					    <div class="col-sm-9">
					      <div class="form-check">
					        <input class="form-check-input" type="checkbox" id="bilyet_s" name="bilyet_s" value="1">
					        <label class="form-check-label" for="gridCheck1">
					          Available
					        </label>
					      </div>
					    </div>
					  </div>

				  	<div class="form-group row">
					    <label for="Bilyet_K" class="col-sm-3 col-form-label"></label>					    
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="bilyet_s_detail" name="bilyet_s_detail" placeholder="Bilyet S Detail">
					    </div>
				  	</div>

				  	<!-- KTP -->

				  	<div class="form-group row">
					    <div class="col-sm-3">KTP</div>
					    <div class="col-sm-9">
					      <div class="form-check">
					        <input class="form-check-input" type="checkbox" id="ktp" name="ktp">
					        <label class="form-check-label" for="gridCheck1">
					          Available
					        </label>
					      </div>
					    </div>
					  </div>

				  	<div class="form-group row">
					    <label for="Bilyet_K" class="col-sm-3 col-form-label"></label>					    
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="ktp_detail" name="ktp_detail" placeholder="No. KTP">
					    </div>
				  	</div>

				  	<!-- Bank Evidence -->

				  	<div class="form-group row">
					    <div class="col-sm-3">Bukti Setor Bank</div>
					    <div class="col-sm-9">
					      <div class="form-check">
					        <input class="form-check-input" type="checkbox" id="bank_evidence" name="bank_evidence">
					        <label class="form-check-label" for="gridCheck1">
					          Available
					        </label>
					      </div>
					    </div>
					  </div>

				  	<div class="form-group row">
					    <label for="Bilyet_K" class="col-sm-3 col-form-label"></label>					    
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="bank_evidence_detail" name="bank_evidence_detail" placeholder="No. Bukti Setor Bank">
					    </div>
				  	</div>

				  	<!-- family card -->

				  	<div class="form-group row">
					    <div class="col-sm-3">Kartu Keluarga</div>
					    <div class="col-sm-9">
					      <div class="form-check">
					        <input class="form-check-input" type="checkbox" id="famili_card" name="famili_card">
					        <label class="form-check-label" for="gridCheck1">
					          Available
					        </label>
					      </div>
					    </div>
					  </div>

				  	<div class="form-group row">
					    <label for="Bilyet_K" class="col-sm-3 col-form-label"></label>					    
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="famili_card_detail" name="famili_card_detail" placeholder="No. Kartu Keluarga ( Jika Perlu )">
					    </div>
				  	</div>

				  	<!-- receipt -->

				  	<div class="form-group row">
					    <div class="col-sm-3">Kwitansi Pembayaran</div>
					    <div class="col-sm-9">
					      <div class="form-check">
					        <input class="form-check-input" type="checkbox" id="receipt" name="receipt">
					        <label class="form-check-label" for="gridCheck1">
					          Available
					        </label>
					      </div>
					    </div>
					  </div>

				  	<div class="form-group row">
					    <label for="Bilyet_K" class="col-sm-3 col-form-label"></label>					    
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="receipt_detail" name="receipt_detail" placeholder="No. Kwitansi Pembayaran">
					    </div>
				  	</div>

				  	<!-- Passport -->

				  	<div class="form-group row">
					    <div class="col-sm-3">Passport</div>
					    <div class="col-sm-9">
					      <div class="form-check">
					        <input class="form-check-input" type="checkbox" id="passport" name="passport">
					        <label class="form-check-label" for="gridCheck1">
					          Available
					        </label>
					      </div>
					    </div>
					  </div>

				  	<div class="form-group row">
					    <label for="Bilyet_K" class="col-sm-3 col-form-label"></label>					    
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="passport_detail" name="passport_detail" placeholder="Detail Passport">
					    </div>
				  	</div>

				  	<!-- Power of attonary -->

				  	<div class="form-group row">
					    <div class="col-sm-3">Surat Kuasa</div>
					    <div class="col-sm-9">
					      <div class="form-check">
					        <input class="form-check-input" type="checkbox" id="power_of_attorney" name="power_of_attorney">
					        <label class="form-check-label" for="gridCheck1">
					          Available
					        </label>
					      </div>
					    </div>
					  </div>

				  	<div class="form-group row">
					    <label for="Bilyet_K" class="col-sm-3 col-form-label"></label>					    
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="power_of_attorney_detail" name="power_of_attorney_detail" placeholder="Nama Yang Diberi Kuasa">
					    </div>
				  	</div>

				  	<!-- letter bill -->

				  	<div class="form-group row">
					    <div class="col-sm-3">Surat Pengajuan Tagihan</div>
					    <div class="col-sm-9">
					      <div class="form-check">
					        <input class="form-check-input" type="checkbox" id="letter_bill" name="letter_bill">
					        <label class="form-check-label" for="gridCheck1">
					          Available
					        </label>
					      </div>
					    </div>
					  </div>

				  	<div class="form-group row">
					    <label for="Bilyet_K" class="col-sm-3 col-form-label"></label>					    
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="letter_bill_detail" name="letter_bill_detail" placeholder="Detail Surat Pengajuan Tagihan">
					    </div>
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
