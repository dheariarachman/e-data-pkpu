<style>
    .progress {
        display: block;
        text-align: center;
        width: 0;
        height: 3px;
        background: #4a6fdc;
        transition: width .3s;
    }

    .progress.hide {
        opacity: 0;
        transition: opacity 1.3s;
    }

    .select2-container--default .select2-selection--single {
        height: 36px !important;
        width: 150px;
    }

    table.table-bordered.dataTable th:last-child,
    table.table-bordered.dataTable th:last-child,
    table.table-bordered.dataTable td:last-child,
    table.table-bordered.dataTable td:last-child {
        text-align: center;
        vertical-align: middle;
    }

    table.table-bordered.dataTable th,
    table.table-bordered.dataTable th,
    table.table-bordered.dataTable td,
    table.table-bordered.dataTable td {

        vertical-align: middle;
    }
</style>

<?php if( $id == 1 ): ?>
    <!-- Page Heading -->
<div class="align-items-center justify-content-between">
    <!-- <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> -->
    <div class="row">
        <div class="col-xl-6 col-md-6 mb-4 offset-3">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rekap Per <span id="datePerTodayTotal"></span></div>
                        </div>
                    </div>
                    <hr class="divider">
                    <a href="<?php echo base_url('master-rig/index'); ?>" target="_blank" style="text-decoration: none;">
                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                <div class="text-md font-weight-bold text-primary text-uppercase mb-1"><span id="jamaah"></span> Jamaah</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Total Piutang</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <a class="btn btn-success btn-icon-split" style="margin: 3px;" href="<?php echo $print_excel; ?>" target="_blank">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-file-excel"></i>
                                        </span>
                                        <span class="text">
                                            <font color="white">Export Excel</font>
                                        </span>
                                    </a>

                                    <a class="btn btn-danger btn-icon-split" style="margin: 3px;" href="<?php echo $print_pdf; ?>" target="_blank">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-file-pdf"></i>
                                        </span>
                                        <span class="text">
                                            <font color="white">Export PDF</font>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="col text-right">
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="rupiah"></span></div>
                            </div>
                        </div>
                    </a>
                    <hr class="divider">
                    <a href="<?php echo base_url('master-perusahaan/index'); ?>" target="_blank" style="text-decoration: none;">
                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                <div class="text-md font-weight-bold text-primary text-uppercase mb-1"><span id="jamaahNon"></span> Non Jamaah</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Total Piutang</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <!-- <a class="btn btn-success btn-icon-split" style="margin: 3px;" href="<?php // echo $print_excel; ?>" target="_blank"> -->
                                    <a class="btn btn-success btn-icon-split" style="margin: 3px;" onclick="fnDalamPerbaikan()">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-file-excel"></i>
                                        </span>
                                        <span class="text">
                                            <font color="white">Export Excel</font>
                                        </span>
                                    </a>

                                    <!-- <a class="btn btn-danger btn-icon-split" style="margin: 3px;" href="<?php // echo $print_pdf; ?>" target="_blank"> -->
                                    <a class="btn btn-danger btn-icon-split" style="margin: 3px;" onclick="fnDalamPerbaikan()">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-file-pdf"></i>
                                        </span>
                                        <span class="text">
                                            <font color="white">Export PDF</font>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="col text-right">
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="rupiahNon"></span></div>
                            </div>
                        </div>
                    </a>
                    <hr class="divider">
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Total</div>
                        </div>
                        <div class="col text-right">
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="rupiahNonTotal"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" id="row-sum">
    <!-- Earnings (Monthly) Card Example -->
</div>
<?php else: ?>
<div style="padding: 16px;"></div>
<h1 class="text-center">Pencarian Data Jamaah</h1>
<div style="padding: 16px;"></div>
<div class="container">
    <div class="row">
        <div class="col-lg-8 offset-lg-3">
            <div class="form-inline">
                <div class="form-group mb-2">
                    <select name="col-find" id="col-find"></select>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="sr-only"></label>
                    <input type="text" class="form-control" id="textvalue" placeholder="Keyword" style="width: 350px">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="mytable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">No. Urut</th>
                        <th width="10%">ID Jamaah</th>
                        <th width="20%">Nama</th>
                        <th width="25%">Alamat</th>
                        <th width="10%">No. Handphone</th>
                        <th width="15%">Kuasa</th>
                        <th width="10%">Total Tagihan</th>
                        <th width="5%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- <hr class="divider"> -->

<?php $this->load->view('layouts/modal'); ?>

<script type="text/javascript">

    function fnDalamPerbaikan() {
        $.confirm({
            title: 'Oops!',
            content: 'Fitur masih dalam perbaikan !!',
            buttons: {
                confirm: function () {
                    
                }
            }
        });
    }

    function checkDetail(id) {

        $.ajax({
                url: '<?php echo $checkDetail; ?>',
                dataType: 'json',
                type: 'POST',
                data: {
                    id: id
                }
            })
            .done(function(res) {
                $('#detailModal').modal('toggle');
                $('#customer').val(res.data[0].customer);
                $('#id_jamaah').val(res.data[0].id_jamaah);
                $('#total_tagihan').number(true);
                $('#total_tagihan').val(res.data[0].amount);

                if (res.data[0].power_of_attorney == 2) {
                    $('#badge-kuasa').text('Tidak Dikuasakan');
                } else {
                    $('#badge-kuasa').text('Dikuasakan');
                }

                checkStatus(res.data[0].bilyet_k, '#bilyet_k_t', '#bilyet_k_f');
                checkStatus(res.data[0].bilyet_s, '#bilyet_s_t', '#bilyet_s_f');
                checkStatus(res.data[0].ktp, '#ktp_t', '#ktp_f');
                checkStatus(res.data[0].bank_evidence, '#bank_evidence_t', '#bank_evidence_f');
                checkStatus(res.data[0].family_card, '#family_card_t', '#family_card_f');
                checkStatus(res.data[0].receipt, '#receipt_t', '#receipt_f');
                checkStatus(res.data[0].passport, '#passport_t', '#passport_f');
                checkStatus((res.data[0].power_of_attorney == 3) ? 1 : res.data[0].power_of_attorney, '#power_of_attorney_t', '#power_of_attorney_f');
                checkStatus(res.data[0].letter_bill, '#letter_bill_t', '#letter_bill_f');

                if (
                    (
                        res.data[0].bilyet_k == 1 ||
                        res.data[0].bilyet_s == 1
                    ) &&
                    res.data[0].ktp == 1 &&
                    res.data[0].bank_evidence == 1 &&
                    res.data[0].family_card == 1 &&
                    res.data[0].receipt == 1 &&
                    res.data[0].passport == 1 &&
                    res.data[0].power_of_attorney != 1 &&
                    res.data[0].letter_bill == 1

                ) {
                    $('#status').removeClass('badge-danger');
                    $('#status').addClass('badge-success');
                    $('#status').text('Lengkap');
                } else {
                    $('#status').removeClass('badge-success');
                    $('#status').addClass('badge-danger');
                    $('#status').text('Tidak Lengkap');
                }
            });
    }

    function checkStatus(result, id_t, id_f) {
        $(id_t).empty();
        $(id_f).empty();
        (result == 1) ? $(id_t).html('<center><i class="fas fa-check"></i></center>'): $(id_f).html('<center><i class="fas fa-check"></i></center>');
    }

    $('#textvalue').on('keypress', function(e) {
        if (e.keyCode == 13) {
            callDatatables($('#col-find').val(), $('#textvalue').val());
        }
    })

    $(document).ready(function(e) {
        $('#col-find').select2({
            placeholder: '-- Cari Berdasarkan --',
            width: 'revive',
            data: [{
                    id: 'id_jamaah',
                    text: 'ID Jamaah'
                },
                {
                    id: 'id',
                    text: 'ID System'
                },
                {
                    id: 'numbering',
                    text: 'No. Urut'
                },
                {
                    id: 'customer',
                    text: 'Nama'
                },
                {
                    id: 'power_of_attorney_detail',
                    text: 'Kuasa'
                },
            ]
        });

        $.ajax({
                url: '<?php echo $getSum; ?>',
                dataType: 'json',
                type: 'POST'
            })
            .done(function(result) {
                $.map(result, function(val, idx) {
                    $('#row-sum').append(cardBluePrint(formatDate(new Date(val.GROUPING)), val.customer, formatter.format(val.total)))
                })
            })

        $.ajax({
                url: '<?php echo $getSumPerToday; ?>',
                dataType: 'json',
                type: 'POST'
            })
            .done(function(result) {
                $('#jamaah').text(result[0].customer);
                $('#rupiah').text(formatter.format(result[0].total));
            })

        $.ajax({
                url: '<?php echo $getSumNonNasabahPerToday; ?>',
                dataType: 'json',
                type: 'POST'
            })
            .done(function(result) {
                $('#jamaahNon').text(result[0].customer);
                $('#rupiahNon').text(formatter.format(result[0].total));
            })

        $.ajax({
                url: '<?php echo $getSumTotal; ?>',
                dataType: 'json',
                type: 'POST'
            })
            .done(function(result) {
                $('#datePerTodayTotal').text(formatDate(new Date()));
                $('#rupiahNonTotal').text(formatter.format(result[0].amount));
            })
    });


    function cardBluePrint(date, customer, amount) {
        let card = `<div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${date}</div>
                            <div class="text-lg font-weight-bold text-gray-800 mb-1">${customer} Jamaah</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">- ${amount}</div>                            
                        </div>
                        <div class="col-auto">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
        return card;
    }

    function callDatatables(col, val) {
        $("#mytable").dataTable().fnDestroy()
        loadDatatablesProperty();

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
                "url": "<?php echo $getJson; ?>" + "/" + col + "/" + val,
                "type": "POST"
            },
            columns: [{
                    "data": "numbering"
                },
                {
                    "data": "id_jamaah"
                },
                {
                    "data": "customer"
                },
                {
                    "data": "c_address"
                },
                {
                    "data": "phone_number"
                },
                {
                    "data": "power_of_attorney_detail",
                    render: function(data, type, row, meta) {
                        if (data == '') {
                            return '-';
                        } else {
                            return data;
                        }
                    }
                },
                {
                    "data": "amount",
                    render: $.fn.dataTable.render.number(',', '.', '')
                },
                {
                    "data": "id",
                    render: function(data, type, row) {
                        let button = `
                        <button onclick="checkDetail('${data}')" class="btn btn-warning btn-circle btn-sm" title="Cek Kelengkapan Dokumen"><i class="fas fa-question"></i></button>
                        `;
                        return button;
                    }
                }
            ],
            order: [
                [1, 'asc']
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                $('td:eq(0)', row).html();
            }
        });
    }
</script>