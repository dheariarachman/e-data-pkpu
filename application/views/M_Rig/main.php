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
                        <th width="15%">Nama</th>
                        <th width="25%">Alamat</th>
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

        $('#amount').number(true);
        $('#amount').ForceNumericOnly();

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
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?php echo site_url($class . '/getData') ?>',
                dataSrc: 'data'
            },
            columns: [
                { data: 'numbering'},
                { data: 'customer', },
                { data: 'c_address', },
                { 
                    data: 'amount' ,
                    render: function(data, type, row) {
                        return $.number(data)
                    }
                },
                { data: 'id',
                    render: function (data, type, row) {
                        let button =`
                            <button onclick="deleteData('${data}')" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button>
                            <button onclick="editData('${data}')" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-pen"></i></button>`;
                        return button;
                    }
                }
            ],
        });


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
            console.log(result);
            $('#addModal').modal('toggle');
            $('#save').css('display', 'none');
            $('#update').css('display', 'block');
            $('#id').val(result.data[0].id);
            // $('#id_rig').val(result.data[0].id_rig);
            // $('#name_rig').val(result.data[0].name_rig);
        })
    }

    $('#update').on('click', function(e) {
        $.ajax({
            type: 'POST',
            url: '<?php echo $update; ?>',
            data: { id_rig: $('#id_rig').val(), name_rig: $('#name_rig').val() }
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
        $('#id_rig').removeAttr('disabled');
        $('#id_rig').val('');
        $('#name_rig').val('');
        $('#save').css('display', 'block');
        $('#update').css('display', 'none');
    })

    $('#addModal').on('shown.bs.modal', function(e) {
        let currentDate = new Date();
        let dateTime    =   currentDate.getDate() + '.' +
                            (currentDate.getMonth() + 1) + '.' +
                            currentDate.getFullYear() + '.' +
                            currentDate.getHours() + '.' +
                            currentDate.getMinutes() + '.' + currentDate.getSeconds();

        $('#id').val(dateTime);
        // console.log(dateTime);
    });

</script>
