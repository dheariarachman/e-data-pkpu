<style>
	/* table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
		vertical-align: middle;
	} */
	table.dataTable tbody td {
		vertical-align: top;
	}

	/* .select2-container--default .select2-selection--single {
		width: 100pt;
	} */
</style>

<div id="tab-alert"></div>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">
		<?php echo $title; ?>
	</h1>
</div>

<button class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#addModal">
	<span class="icon text-white-50">
		<i class="fas fa-plus"></i>
	</span>
	<span class="text">Tambah Data</span>
</button>
<hr class="divider">

<div class="card shadow mb-4">
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
                    <th width="5%">No</th>
					<th width="22%">Nama Barang</th>
                    <th width="15%">Serial Number</th>
                    <th width="15%">Tipe Barang</th>
					<th width="15%">Tanggal Masuk</th>
					<th width="8%">RIG</th>
					<th width="10%">Status</th>
                    <th width="10%">Aksi</th>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php $this->load->view($form, array('action' => $action)); ?>

<script type="text/javascript">
	$(document).ready(function () {

		// Select2 Pemilihan Barang
		$('#id_status_barang').select2({
			width: 'resolve', 
			placeholder: '- Pilih Status Barang -',
			dropdownParent: $('#addModal'),
			ajax: {
				url: '<?php echo $statusSource; ?>',
				dataType: 'json',
				type: 'GET',
				data: function(params) {
					return {
						q: params.term
					}
				},
				processResults: function(data) {
					return {
						results: $.map(data.data, function(item) {
							return {
								text: item.name_status_barang,
								id: item.id_status_barang
							}
						})
					};
				}
			}
		});

		// Select2 Pemilihan Barang
		$('#id_type').select2({ 
			dropdownParent: $('#addModal'),
			width: 'resolve',
			placeholder: '- Pilih Tipe Barang -',
			ajax: {
				url: '<?php echo $typeSource; ?>',
				dataType: 'json',
				type: 'GET',
				data: function(params) {
					return {
						q: params.term
					}
				},
				processResults: function(data) {
					return {
						results: $.map(data.data, function(item) {
							return {
								text: item.name_type,
								id: item.id_type
							}
						})
					};
				}
			}
		});

		// Select2 Pemilihan RIG
		$('#id_rig').select2({
			dropdownParent: $('#addModal'),
			width: 'resolve',
			placeholder: '- Pilih Lokasi RIG -',
			ajax: {
				url: '<?php echo $typeSource; ?>',
				dataType: 'json',
				type: 'GET',
				data: function(params) {
					return {
						q: params.term
					}
				},
				processResults: function(data) {
					return {
						results: $.map(data.data, function(item) {
							return {
								text: item.name_rig,
								id: item.id_rig
							}
						})
					};
				}
			}
		})

		// Datepicker Tanggal masuk barang
		$('#stock_in').datepicker({
			dateFormat: 'dd-mm-yy'
		});

		// Form
		$('#form_status').on('submit', function(e) {
			e.preventDefault();			
			$.ajax({
				type: 'POST',
				url: '<?php echo $action; ?>',
				data: $(this).serialize(),
			})
			.done(function(result) {
				$('#addModal').modal('toggle');
				
				if(!result.error) {
					$('#tab-alert').append(`
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong>${result.data} </strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>`);
				} else {
					$('#tab-alert').append(`
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>${result.data} </strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>`);
				}
				setTimeout(() => {
					$('.alert').alert('close');
				}, 1500);
			})
		});

		// Datatables
		$('#dataTable').DataTable({
			processing: true,
			serverSide: true,
			ajax: {
				url: '<?php echo site_url($class . '/getData') ?>',
				dataSrc: 'data'
			},
			columns: [
				{ 
					data: 'id_barang',
					render: function( data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					}
				},
				{ data: 'name_barang' },
				{ data: 'serial_num' },
                { data: 'id_type' },
				{ data: 'stock_in' },
				{ data: 'id_rig' },
				{ data: 'id_status_barang' },
				{ data: 'id_barang',
					render: function (data, type, row) {
						let button =`
							<button onclick="deleteData(${data})" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button>
							<button onclick="editData(${data})" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-pen"></i></button>`;
						return button;
					}
				}
			],
		});

		// Modal Function when hidden
		$('#addModal').on('hidden.bs.modal', function(e) {
			$('#dataTable').DataTable().ajax.reload();
			$('#form_status').trigger('reset');
			$("#id_type").val(null).trigger("change");
			$("#id_status_barang").val(null).trigger("change");
			$('#save').css('display', 'block');
			$('#update').css('display', 'none');
		})
	});	

	function deleteData(data) {
		$.confirm({
			title: 'Confirm!',
			content: 'Yakin Akan Menghapus Data ini ?!',
			buttons: {
				confirm: function () {
					$.alert('Confirmed!');
					$.ajax({
						type: 'POST',
						url: '<?php echo $delete?>',
						data: { id: data },
					})
					.done(function(result) {
						$('#dataTable').DataTable().ajax.reload();

						if(!result.error) {
							$('#tab-alert').append(`
								<div class="alert alert-success alert-dismissible fade show" role="alert">
									<strong>${result.data} </strong>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>`);
						} else {
							$('#tab-alert').append(`
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									<strong>${result.data} </strong>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>`);
						}
						setTimeout(() => {
							$('.alert').alert('close');
						}, 1500);
					})
				},
				cancel: function () {
					$.alert('Canceled!');
				},
			}
		});
	}

	function editData(data) {
		$.ajax({
			type: 'POST',
			url: '<?php echo $edit; ?>',
			data: { id: data },
		})
		.done(function(result) {
			$('#addModal').modal('toggle');
			$('#save').css('display', 'none');
			$('#update').css('display', 'block');
            // Field
            $('#id_barang').val(result.data[0].id_barang);
			$('#id_type').val(result.data[0].id_type);
			$('#name_barang').val(result.data[0].name_barang);
            $('#s_n').val(result.data[0].s_n);
            $('#stock_in').val(result.data[0].stock_in);
		})
	}

	$('#update').on('click', function(e) {
		$.ajax({
			type: 'POST',
			url: '<?php echo $update; ?>',
			data: { 
                id: $('#id_barang').val(), 
                name_barang: $('#name_barang').val(),
                s_n: $('#s_n').val(),
                id_type: $('#id_type').val(),
                stock_in: $('#stock_in')
            }
		})
		.done(function(result) {
			$('#addModal').modal('toggle');
			if(!result.error) {
				$('#tab-alert').append(`
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>${result.data} </strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>`);
			} else {
				$('#tab-alert').append(`
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>${result.data} </strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>`);
			}
			setTimeout(() => {
				$('.alert').alert('close');
			}, 1500);
		});
	})

</script>
