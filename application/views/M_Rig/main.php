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
            <table class="table table-bordered" id="mytable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">No. Urut</th>
                        <th width="5%">ID Jamaah</th>
                        <th width="10%">Nama</th>
                        <th width="10%">Alamat</th>
                        <th width="5%">No. Handphone</th>
                        <th width="10%">Kuasa</th>
                        <th width="8%">Total Tagihan</th>
                        <th width="8%">Aksi</th>
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
    $(document).ready(function(){
        // Setup datatables
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
        {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };
        
        var table = $("#mytable").dataTable({
            initComplete: function() {
                var api = this.api();
                $('#mytable_filter input')
                    .off('.DT')
                    .on('input.DT', function() {
                        api.search(this.value).draw();
                });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            ajax: {
                "url": "<?php echo $getJson; ?>", 
                "type": "POST"
            },
            columns: [
                {"data": "numbering"},
                {"data": "id_jamaah"},
                {"data": "customer"},
                {"data": "c_address"},
                {"data": "phone_number"},
                {
                    "data": "power_of_attorney_detail",
                    render: function(data, type, row, meta) {
                        if(data == '') {
                            return '-';
                        } else {
                            return data;
                        }
                    }
                },
                {"data": "amount", 
                    render: $.fn.dataTable.render.number(',', '.', '00')},
                {
                    "data": "id",
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
            order: [[1, 'asc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                $('td:eq(0)', row).html();
            }
        });
 
    });
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

        $('#bilyet_k_detail').text('');
        $('#bilyet_s_detail').text('');
        $('#ktp_detail').text('');
        $('#bank_evidence_detail').text('');
        $('#family_card_detail').text('');
        $('#receipt_detail').text('');
        $('#passport_detail').text('');
        $('#power_of_attorney_detail').text('');
        $('#letter_bill_detail').text('');
        $('#other_document').text('');
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

            // Radio Button
            $("input[name='bilyet_k'][value='"+result.data[0].bilyet_k+"']").prop('checked', 1);
            $("input[name='bilyet_s'][value='"+result.data[0].bilyet_s+"']").prop('checked', 1);
            $("input[name='ktp'][value='"+result.data[0].ktp+"']").prop('checked', 1);
            $("input[name='bank_evidence'][value='"+result.data[0].bank_evidence+"']").prop('checked', 1);
            $("input[name='family_card'][value='"+result.data[0].family_card+"']").prop('checked', 1);
            $("input[name='receipt'][value='"+result.data[0].receipt+"']").prop('checked', 1);
            $("input[name='passport'][value='"+result.data[0].passport+"']").prop('checked', 1);
            $("input[name='letter_bill'][value='"+result.data[0].letter_bill+"']").prop('checked', 1);
            $("input[name='power_of_attorney'][value='"+result.data[0].power_of_attorney+"']").prop('checked', 1);
        })
    }

</script>