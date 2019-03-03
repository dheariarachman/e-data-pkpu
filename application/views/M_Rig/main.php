<style>
    table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
        vertical-align: middle;
    }
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
                    <tr>
                        <th width="2%">No</th>
                        <th width="12%">Nama</th>
                        <th width="15%">Alamat</th>
                        <th width="8%">Kuasa</th>
                        <th width="5%">No. Urut</th>
                        <th width="5%">Total Tagihan</th>
                        <th width="10%">Aksi</th>
                    </tr>
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

        $('#birth_date').datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,            
        });

        $('#amount').number(true);
        $('#amount').ForceNumericOnly();
        $('#phone_number').ForceNumericOnly();

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

        $('#dataTable').DataTable({
            aaSorting: [[4, 'desc']],
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?php echo site_url($class . '/getData') ?>',
                dataSrc: 'data'
            },            
            columns: [
                { data: 'id', 
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    sortable: false,
                    orderable: false,
                },
                { data: 'customer', sortable: true, orderable: true },
                { data: 'c_address', 
                    render: function(data) {
                        return decodeURI(data)
                    }
                },
                { 
                    data: 'power_of_attorney_detail',
                    render: function(data, type, row) {
                        if(data == '') {
                            return '-';
                        } else {
                            return data;
                        }
                    }
                },
                { data: 'numbering' },
                { data: 'amount' ,
                    render: function(data, type, row) {
                        return $.number(data)
                    }
                },
                { data: 'id',
                    render: function (data, type, row) {
                        let button =`
                            <?php if($this->session->userdata('role') == '99'): ?>
                                <button onclick="deleteData('${data}')" class="btn btn-danger btn-circle btn-sm" title="Hapus Data"><i class="fas fa-trash"></i></button>
                            <?php endif; ?>
                            <button onclick="editData('${data}')" class="btn btn-warning btn-circle btn-sm" title="Ubah Data"><i class="fas fa-pen"></i></button>
                            <a target="_blank" href="<?php echo $cetak; ?>/${data}" class="btn btn-primary btn-circle btn-sm" title="Cetak Surat Pengajuan Tagihan"><i class="fas fa-print"></i></a>
                            <a target="_blank" href="<?php echo $cetak_pe; ?>/${data}" class="btn btn-info btn-circle btn-sm" title="Cetak Tanda Terima"><i class="fas fa-print"></i></a>
                            `;
                        return button;
                    }
                }
            ],
        });
    }); 

    $('#update').on('click', function(e) {
        let data = $('#form_status').serialize();
        $.ajax({
            type: 'POST',
            url: '<?php echo $update; ?>',
            data: { id: $('#id').val(), data: data }
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

    $('#addModal').on('hidden.bs.modal', function(e) {
        $('#dataTable').DataTable().ajax.reload();
        $('#form_status').trigger('reset');
        $('#save').css('display', 'block');
        $('#update').css('display', 'none');
    })

    $('#addModal').on('show.bs.modal', function(e) {
        let currentDate = new Date();
        let dateTime    =   currentDate.getDate() + '.' +
                            (currentDate.getMonth() + 1) + '.' +
                            currentDate.getFullYear() + '.' +
                            currentDate.getHours() + '.' +
                            currentDate.getMinutes() + '.' + currentDate.getSeconds();

        $('#id').val(dateTime);
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
            $('#id').val(result.data[0].id);

            // Field Text
            $('#customer').val(result.data[0].customer);
            $('#c_address').text(decodeURI(result.data[0].c_address));
            $('#bilyet_k_detail').text(decodeURI(result.data[0].bilyet_k_detail));
            $('#bilyet_s_count').val(decodeURI(result.data[0].bilyet_s_count));
            $('#bilyet_s_detail').text(decodeURI(result.data[0].bilyet_s_detail));
            $('#ktp_detail').text(decodeURI(result.data[0].ktp_detail));
            $('#bank_evidence_detail').text(decodeURI(result.data[0].bank_evidence_detail));
            $('#family_card_detail').text(decodeURI(result.data[0].family_card_detail));
            $('#receipt_detail').text(decodeURI(result.data[0].receipt_detail));
            $('#passport_detail').text(decodeURI(result.data[0].passport_detail));
            $('#power_of_attorney_detail').text(decodeURI(result.data[0].power_of_attorney_detail));
            $('#letter_bill_detail').text(decodeURI(result.data[0].letter_bill_detail));
            $('#amount').val(result.data[0].amount);
            $('#birth_city').val(result.data[0].birth_city);
            let date      = new Date(result.data[0].birth_date);            
            let newDate = date.getDate() + '-' + (date.getMonth()+1) + '-' + date.getFullYear();
            $('#birth_date').val(newDate);
            $('#id_jamaah').val(result.data[0].id_jamaah);

            $('#phone_number').val(result.data[0].phone_number);
            $('#email').val(result.data[0].email);
            $('#other_document').val(result.data[0].other_document);

            // Checkbox
            $('#bilyet_k').attr('checked', result.data[0].bilyet_k);
            $('#bilyet_s').attr('checked', result.data[0].bilyet_s);
            $('#ktp').attr('checked', result.data[0].ktp);
            $('#bank_evidence').attr('checked', result.data[0].bank_evidence);
            $('#family_card').attr('checked', result.data[0].family_card);
            $('#receipt').attr('checked', result.data[0].receipt);
            $('#passport').attr('checked', result.data[0].passport);
            $("input[name='power_of_attorney'][value='"+result.data[0].power_of_attorney+"']").prop('checked', 1);
            $('#letter_bill').attr('checked', result.data[0].letter_bill);
        })
    }

</script>
