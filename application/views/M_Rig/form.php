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
				<form id="form_status" enctype="multipart/form-data" method="POST">
					<div class="form-group">
						<input type="text" class="form-control" id="id" aria-describedby="id_help" name="id" autocomplete="off" readonly>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="customer" placeholder="Nama Jamaah" name="customer" autocomplete="off">
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
							<!-- <input type="text" class="form-control" id="bilyet_k_detail" name="bilyet_k_detail" placeholder="Blyet K Detail"> -->
							<textarea name="bilyet_k_detail" id="bilyet_k_detail" cols="30" rows="3" class="form-control" placeholder="Bilyet K Detail"></textarea>
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
							<!-- <input type="text" class="form-control" id="bilyet_s_detail" name="bilyet_s_detail" placeholder="Bilyet S Detail"> -->
							<textarea name="bilyet_s_detail" id="bilyet_s_detail" cols="30" rows="3" class="form-control" placeholder="Bilyet S Detail"></textarea>
						</div>
					</div>

					<!-- KTP -->

					<div class="form-group row">
						<div class="col-sm-3">KTP</div>
						<div class="col-sm-9">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="ktp" name="ktp" value="1">
								<label class="form-check-label" for="gridCheck1">
									Available
								</label>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<label for="Bilyet_K" class="col-sm-3 col-form-label"></label>
						<div class="col-sm-9">
							<!-- <input type="text" class="form-control" id="ktp_detail" name="ktp_detail" placeholder="No. KTP"> -->
							<textarea name="ktp_detail" id="ktp_detail" cols="30" rows="3" class="form-control" placeholder="KTP Detail"></textarea>
						</div>
					</div>

					<!-- Bank Evidence -->

					<div class="form-group row">
						<div class="col-sm-3">Bukti Setor Bank</div>
						<div class="col-sm-9">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="bank_evidence" name="bank_evidence" value="1">
								<label class="form-check-label" for="gridCheck1">
									Available
								</label>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<label for="Bilyet_K" class="col-sm-3 col-form-label"></label>
						<div class="col-sm-9">
							<!-- <input type="text" class="form-control" id="bank_evidence_detail" name="bank_evidence_detail" placeholder="No. Bukti Setor Bank"> -->
							<textarea name="bank_evidence_detail" id="bank_evidence_detail" cols="30" rows="3" class="form-control"
							 placeholder="Bukti Setor Bank Detail"></textarea>
						</div>
					</div>

					<!-- family card -->

					<div class="form-group row">
						<div class="col-sm-3">Kartu Keluarga</div>
						<div class="col-sm-9">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="family_card" name="family_card" value="1">
								<label class="form-check-label" for="gridCheck1">
									Available
								</label>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<label for="Bilyet_K" class="col-sm-3 col-form-label"></label>
						<div class="col-sm-9">
							<!-- <input type="text" class="form-control" id="family_card_detail" name="family_card_detail" placeholder="No. Kartu Keluarga ( Jika Perlu )"> -->
							<textarea name="family_card_detail" id="family_card_detail" cols="30" rows="3" class="form-control" placeholder="Kartu Keluarga Detail"></textarea>
						</div>
					</div>

					<!-- receipt -->

					<div class="form-group row">
						<div class="col-sm-3">Kwitansi Pembayaran</div>
						<div class="col-sm-9">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="receipt" name="receipt" value="1">
								<label class="form-check-label" for="gridCheck1">
									Available
								</label>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<label for="Bilyet_K" class="col-sm-3 col-form-label"></label>
						<div class="col-sm-9">
							<!-- <input type="text" class="form-control" id="receipt_detail" name="receipt_detail" placeholder="No. Kwitansi Pembayaran"> -->
							<textarea name="receipt_detail" id="receipt_detail" cols="30" rows="3" class="form-control" placeholder="Kwitansi Pembayaran Detail"></textarea>
						</div>
					</div>

					<!-- Passport -->

					<div class="form-group row">
						<div class="col-sm-3">Passport</div>
						<div class="col-sm-9">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="passport" name="passport" value="1">
								<label class="form-check-label" for="gridCheck1">
									Available
								</label>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<label for="Bilyet_K" class="col-sm-3 col-form-label"></label>
						<div class="col-sm-9">
							<!-- <input type="text" class="form-control" id="passport_detail" name="passport_detail" placeholder="Detail Passport"> -->
							<textarea name="passport_detail" id="passport_detail" cols="30" rows="3" class="form-control" placeholder="Passport Detail"></textarea>
						</div>
					</div>

					<!-- Power of attonary -->

					<div class="form-group row">
						<div class="col-sm-3">Surat Kuasa</div>
						<div class="col-sm-9">
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="power_of_attorney2" name="power_of_attorney" class="custom-control-input" value="1">
								<label class="custom-control-label" for="power_of_attorney2">Require</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="power_of_attorney3" name="power_of_attorney" class="custom-control-input" value="2">
								<label class="custom-control-label" for="power_of_attorney3">Principle</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="power_of_attorney4" name="power_of_attorney" class="custom-control-input" value="3">
								<label class="custom-control-label" for="power_of_attorney4">Available</label>
							</div>

							<!-- <div class="form-check">
					        <input class="form-check-input" type="checkbox" id="power_of_attorney" name="power_of_attorney" value="1">
					        <label class="form-check-label" for="gridCheck1">
					          Available
					        </label>
								</div>
								
								<div class="form-check">
					        <input class="form-check-input" type="checkbox" id="power_of_attorney" name="power_of_attorney" value="2">
					        <label class="form-check-label" for="gridCheck1">
					          Require
					        </label>
								</div>
								
								<div class="form-check">
					        <input class="form-check-input" type="checkbox" id="power_of_attorney" name="power_of_attorney" value="3">
					        <label class="form-check-label" for="gridCheck1">
					          Principle
					        </label>
					      </div> -->
						</div>
					</div>

					<div class="form-group row">
						<label for="Bilyet_K" class="col-sm-3 col-form-label"></label>
						<div class="col-sm-9">
							<!-- <input type="text" class="form-control" id="power_of_attorney_detail" name="power_of_attorney_detail" placeholder="Nama Yang Diberi Kuasa"> -->
							<textarea name="power_of_attorney_detail" id="power_of_attorney_detail" cols="30" rows="3" class="form-control"
							 placeholder="Nama Yang DIberi Kuasa"></textarea>
						</div>
					</div>

					<!-- letter bill -->

					<div class="form-group row">
						<div class="col-sm-3">
							<font size="2">Surat Pengajuan Tagihan</font>
						</div>
						<div class="col-sm-9">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="letter_bill" name="letter_bill" value="1">
								<label class="form-check-label" for="gridCheck1">
									Available
								</label>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<label for="Bilyet_K" class="col-sm-3 col-form-label"></label>
						<div class="col-sm-9">
							<!-- <input type="text" class="form-control" id="letter_bill_detail" name="letter_bill_detail" placeholder="Detail Surat Pengajuan Tagihan"> -->
							<textarea name="letter_bill_detail" id="letter_bill_detail" cols="30" rows="3" class="form-control" placeholder="Surat Pengajuan Tagihan Detail"></textarea>
						</div>
					</div>

					<!-- Amount -->
					<div class="form-group row">
						<div class="col-sm-3">
							<font size="3">Total Tagihan</font>
						</div>
						<div class="col-sm-4">
							<input class="form-control" type="text" id="amount" name="amount" placeholder="x.xxx.xxx">
						</div>
					</div>

					<!-- Dokumen Tambahan / other_document -->
					<div class="form-group row">
						<div class="col-sm-3">
							<font size="2">Dokumen Tambahan</font>
						</div>
						<div class="col-sm-9">
							<textarea name="other_document" id="other_document" cols="30" rows="3" class="form-control" placeholder="Dokumen Tambahan"></textarea>
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
