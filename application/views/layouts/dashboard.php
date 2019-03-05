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

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-8 offset-lg-3">
            <div class="form-inline">
                <div class="form-group mb-2">
                    <select name="col-find" id="col-find"></select>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="sr-only">Password</label>
                    <input type="text" class="form-control" id="textvalue" placeholder="Keyword" style="width: 350px">
                </div>
            </div>
        </div>
    </div>
</div>

<hr class="divider">

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

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h1 align="center"><span class="badge badge-secondary" id="status"></span></h1>
                <hr class="divider">
                <div>
                    <!-- ID Jamaah -->
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">ID Jamaah</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail">
                        </div>
                    </div>
                    <!-- Nama -->
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail">
                        </div>
                    </div>

                    <!-- Total Tagihan -->
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Total Tagihan</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail">
                        </div>
                    </div>
                </div>
                <hr class="divider">
                <table border="1" style="border-collapse: collapse;" width="100%">
                <thead>
                    <tr>
                        <td width="5%" align="center" rowspan="2">No.</td>
                        <td width="35%" align="center" rowspan="2">Dokumen</td>
                        <td width="20%" align="center" colspan="2">Checklist</td>
                        <td width="40" align="center" rowspan="2">Keterangan</td>
                    </tr>
                    <tr>
                        <td width="10%" align="center">Ada</td>
                        <td width="10%" align="center">Tidak Ada</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Bilyet K</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Bilyet K</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Bilyet K</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Bilyet K</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Bilyet K</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Bilyet K</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Bilyet K</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Bilyet K</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Bilyet K</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
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
                console.log(res);
            });
        $('#status').text('Complete');
    }

    $('#textvalue').on('keypress', function(e) {
        if (e.keyCode == 13) {

            // callDatatables($('#col-find').val(), $('#textvalue').val());
            callDatatables($('#col-find').val(), '12');
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
    });

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