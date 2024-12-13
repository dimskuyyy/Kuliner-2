<div class="pull-left">
    <button type="button" class="btn btn-sm btn-flat btn-primary btn-create"><i class="fa fa-plus"></i> Tambah Membership</button>
</div><br><br>
<table id="table-member" class="table table-bordered table-hover table-striped" style="width:100%">
    <thead>
        <tr>
            <th data-priority='1'>Nama User</th>
            <th data-priority='1'>Kode Member</th>
            <th data-priority='1'>Expire Date</th>
            <th data-priority='1'>Status</th>
            <th data-priority='1'>Tgl. Simpan</th>
            <th data-priority='1'>Tgl. Update</th>
            <th data-priority='1'></th>
        </tr>
    </thead>
</table>
<script>
    $('#table-member').on('click', 'tbody tr td .btn-addpayment', function(e)  {
        e.preventDefault();
        var btn = $(this);
        var htm = btn.html();
        var id = btn.attr('data-id');
        setLoadingBtn(btn);
        if (id) {
            setLoadingBtn(btn);
            $.ajax({
                url: base_url + '/membership/add_payment',
                type: 'post',
                data: {
                    id: id
                },
                success: function(res) {
                    if (res.status == false) {
                        errorMsg(res.msg);
                        resetLoadingBtn(btn, htm);
                    } else {
                        resetLoadingBtn(btn, htm);
                        content.html(res);
                    }
                },
                error: function(xhr, status, error) {
                    errorMsg(error);
                    resetLoadingBtn(btn, htm);
                }
            });
        }
    });

    $('#table-member').on('click', 'tbody tr td .btn-edit', function(e) {
        e.preventDefault();
        var btn = $(this);
        var htm = btn.html();
        var id = btn.attr('data-id');
        if (id) {
            setLoadingBtn(btn);
            $.ajax({
                url: base_url + '/membership/form',
                type: 'post',
                data: {
                    id: id
                },
                success: function(res) {
                    if (res.status == false) {
                        errorMsg(res.msg);
                        resetLoadingBtn(btn, htm);
                    } else {
                        resetLoadingBtn(btn, htm);
                        content.html(res);
                    }
                },
                error: function(xhr, status, error) {
                    errorMsg(error);
                    resetLoadingBtn(btn, htm);
                }
            });
        }
    });
    $('#table-member').on('click', 'tbody tr td .btn-delete', function(e) {
        e.preventDefault();
        var btn = $(this);
        var htm = btn.html();
        var id = btn.attr('data-id');
        if (id) {
            if (confirm('Yakin hapus post ?')) {
                setLoadingBtn(btn);
                $.ajax({
                    url: base_url + '/membership/delete',
                    type: 'post',
                    data: {
                        id: id
                    },
                    success: function(res) {
                        if (res.status) {
                            successMsg(res.msg);
                            $('#table-member').DataTable().ajax.reload();
                        } else {
                            errorMsg(res.msg);
                        }
                        resetLoadingBtn(btn, htm);
                    },
                    error: function(xhr, status, error) {
                        let response = JSON.parse(xhr.responseText);
                        let errorMessage = response.msg;
                        errorMsg(errorMessage);
                        resetLoadingBtn(btn, htm);
                    }
                });
            }
        }
    });
    var oTable = $('#table-member').dataTable({
        'bFilter': false,
        'autoWidth': true,
        'pagingType': 'full_numbers',
        'paging': true,
        'processing': true,
        'serverSide': true,
        'searching': true,
        'ordering': true,
        'fixedColumns': true,
        'language': {
            processing: '<i class=\'fa fa-refresh fa-spin fa-3x fa-fw\'></i><span class=\'sr-only\'>Loading...</span>'
        },
        'columns': [{
                data: 'user',
                name: 'user'
            },
            {
                data: 'code',
                name: 'code',
            },
            {
                data: 'tgl_kadaluarsa',
                name: 'tgl_kadaluarsa',
            },
            {
                'data': null,
                'searchable': false,
                render: function(data, type, row) {
                    return data.status == 1 ? '<span class=\'label label-danger\'>Tidak Aktif</label>' : '<span class=\'label label-success\'>Aktif</label>';
                }
            },
            {
                data: 'tgl_simpan',
                name: 'tgl_simpan'
            },
            {
                data: 'tgl_update',
                name: 'tgl_update'
            },
            {
                'data': null,
                'render': function(data, type, row) {
                    return ' <button data-id=\'' + data.id + '\' type=\'submit\' class=\'btn btn-sm btn-warning btn-flat btn-look\' title=\'klik untuk lihat detail\'><i class=\'fa fa-eye\'></i></button> ' +
                        ' <button data-id=\'' + data.id + '\' type=\'submit\' class=\'btn btn-sm btn-primary btn-flat btn-addpayment\' title=\'klik untuk tambah payment\'><i class=\'fa fa-plus\'></i></button>' +
                        ' <button data-id=\'' + data.id + '\' type=\'submit\' class=\'btn btn-sm btn-success btn-flat btn-edit\' title=\'klik untuk edit data\'><i class=\'fa fa-edit\'></i></button>' +
                        ' <button data-id=\'' + data.id + '\' type=\'button\' class=\'btn btn-sm btn-danger btn-flat btn-delete\' title=\'klik untuk hapus post\'><i class=\'fa fa-trash\'></i></button>';
                }
            },
        ],
        'ajax': function(data, callback, setting) {
            $.ajax({
                url: base_url + '/membership/list',
                type: 'post',
                data: {
                    datatables: data
                },
                success: function(r) {
                    callback({
                        recordsTotal: r.recordsTotal,
                        recordsFiltered: r.recordsFiltered,
                        data: r.data
                    });
                },
                error: function(xhr, status, error) {
                    errorMsg(error);
                }
            })
        },
        'responsive': true
    });
    $('#table-member').on('click', '.btn-look', function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        if (id) {
            $.ajax({
                url: base_url + '/membership/info',
                type: 'post',
                data: {
                    id: id
                },
                success: function(res) {
                    if (res.status == false) {
                        errorMsg(res.msg);
                    } else {
                        $('.mymodal').html(res).modal('show');
                        $('#nama').attr('disabled', true);
                        $('#imageInput').remove();
                        $('.btn-submit').remove();
                        $('#myModalLabel').html('Form Show Media');
                    }
                },
                error: function(xhr, status, error) {
                    errorMsg(error);
                }
            });
        }
    })

    $('.btn-create').click(function(e) {
        e.preventDefault();
        var btn = $(this);
        var htm = btn.html();
        setLoadingBtn(btn);
        $.ajax({
            url: base_url + '/membership/form',
            type: 'post',
            success: function(res) {
                resetLoadingBtn(btn, htm);
                content.empty();
                content.html(res);
            },
            error: function(xhr, status, error) {
                errorMsg(error);
                resetLoadingBtn(btn, htm);
            }
        });
    });
</script>