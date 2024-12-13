<?php

use App\Models\MGaleri;

helper(['form']);
?>
<?= $this->extend('dashboard/layout/back_main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-4">
        <div class="box box-widget">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
                <h3 class="box-title"><b>Form Tambah/Edit Menu Kuliner</b></h3>
            </div>
            <div class="box-body">
                <?php
                echo form_open('#', ['class' => 'form-galeri']);
                if (isset($kuliner)) {
                    echo form_hidden('kuliner_id', $kuliner['kuliner_id']);
                }
                ?>
                <input type="hidden" name="id" />
                <div class="form-group">
                    <label for='nama'>Nama Menu</label>
                    <input type="text" name="nama" class="form-control" value="" required>
                </div>
                <div class="form-group">
                    <label for='harga'>Harga Menu</label>
                    <input type="text" name="harga" class="form-control" value="" required>
                </div>
                <div class="form-group">
                    <label for='deskripsi'>Deskripsi Menu</label>
                    <textarea id="deskripsi" class="form-control" style=" width: 100%;" name="deskripsi" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for='media'>Media</label><br>
                    <div class="choose-media">
                        <a href="#" class="btn btn-sm btn-flat btn-primary btn-media" data-backdrop="static"><i class="fa fa-plus"></i> Unggah Foto Menu <span id="text-optional"></span></a>
                        <button type="button" class="btn btn-default btn-flat btn-sm btn-reset-media"><i class="fa fa-recycle" aria-hidden="true"></i></button>
                    </div>
                    <input type="hidden" name="media" id="media-id">
                    <div class="source-media" style="height: 500px;">
                        <img id="media-source" class="no-source">
                        <p class="note-media <?= isset($data) ? 'active' : '' ?>">Tidak Ada Media</p>
                    </div>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-flat btn-sm btn-default btn-reset"><i class="fa fa-recycle"></i> Reset</button>
                    <button type="submit" class="btn btn-flat btn-sm btn-primary btn-submit"><i class="fa fa-save"></i> Simpan</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="box box-widget">
            <div class="box-header" style="cursor: move;">
                <h3 class="box-title"><b>List Menu</b></h3>
            </div>
            <div class="box-body">
                <div class="dd" id="nestable">
                    <ol class="dd-list">
                        <?php
                        if (isset($menu) > 0) {
                            foreach ($menu as $dt) { ?>
                                <li class="dd-item dd3-item" data-id="<?php echo $dt['menu_id']; ?>" style="border:0px solid red;">
                                    <div class=" dd3-content" style="flex-direction: row; justify-content: flex-start; height: max-content; overflow: hidden; gap:1rem">
                                        <img src="<?= base_url('media/') . $dt['media_slug'] ?>" alt="<?= $dt['nama_menu'] ?>" style="width:80px; height:80px; object-fit:cover;" class="dd-handle dd3-handle">
                                        <div style="width: 100%;padding:4px 6px;display:flex;justify-content:space-between;align-items: center;">
                                            <?php
                                            $formatHarga = "Rp. " . number_format($dt['harga_menu'], 0, ',', '.');
                                            ?>
                                            <div>
                                                <p style="margin-bottom: 5px;"><?= $dt['nama_menu'] ?> ( <?= $formatHarga ?> )</p>
                                                <p style="font-weight: 400;margin-bottom: 5px;" class="clamped-text"><?= $dt['deskripsi_menu'] ?></p>
                                            </div>
                                            <div class="pull-right btn-list" style="min-width: 60px; height: fit-content;">
                                                <button type="button" data-id="<?php echo $dt['menu_id']; ?>" class="btn btn-flat btn-xs btn-primary btn-edit" title="klik untuk edit galeri">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" data-id="<?php echo $dt['menu_id']; ?>" class="btn btn-flat btn-xs btn-danger btn-delete" title="klik untuk hapus galeri">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                            <div class="collapse" id="form-galeri<?php echo $dt['menu_id'] ?>">
                                                <div class="well">
                                                    FORM
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php }
                        } else {
                            ?>
                            <li class="dd-item dd3-item">
                                <div class="dd-handle dd3-handle dd3-content">Foto tidak tersedia</div>
                            </li>
                        <?php
                        }
                        ?>
                    </ol>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection() ?>

<?= $this->section('css') ?>
<style type="text/css">
    .clamped-text {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .dd-list {
        display: grid;
        grid-template-columns: auto;
    }

    .dd3-content {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80px;
        width: 100%;
        margin: 5px;
        /*padding: 5px 10px 5px 40px; */
        color: #333;
        text-decoration: none;
        font-weight: bold;
        border: 1px solid #ccc;
        background: #fafafa;
        background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
        background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
        background: linear-gradient(top, #fafafa 0%, #eee 100%);
        -webkit-border-radius: 3px;
        border-radius: 3px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    @media (max-width:1400px) {
        .dd3-content {
            width: 280px;
        }
    }

    @media (max-width:1180px) {
        .dd3-content {
            width: 350px;
        }

        .dd-list {
            grid-template-columns: auto;
        }
    }

    .dd-handle {
        margin: 0px;
        padding: 0px;
    }

    .dd3-content:hover {
        color: #2ea8e5;
        background: #fff;
    }

    .dd-dragel>.dd3-item>.dd3-content {
        margin: 0;
    }

    .dd3-item>button {
        margin-left: 30px;
    }
</style>
<?= $this->endsection() ?>

<?= $this->section('js') ?>
<script src="<?php echo base_url() ?>back/js/wbpanel.js"></script>
<script>
    const content = $('.box-body');
    const media = $('.mymodal #media-list');

    const viewList = debounce((page, keyword) => {
        loadMedia(page, keyword)
    }, 800, $('.mymodal #media-list'));

    $(document).on('click', '.mymodal .pagination a', function(e) {
        let keyword = $('.mymodal #keyword').val();
        if ($(this).attr('href')) {
            e.preventDefault();
            let page = $(this).attr('href');
            page = page.split('=');
            loadMedia(page[1], keyword);
        }
    });

    function loadMedia(page, keyword = null) {
        $.ajax({
            url: base_url + '/media/list',
            type: 'post',
            data: {
                page: page,
                keyword: keyword,
                type: 2,
                perPage: 6
            },
            success: function(data) {
                resetLoadingBtn($('.mymodal #media-list'));
                $('.mymodal #media-list').html(data);
            },
            error: function(xhr, status, error) {
                errorMsg(error);
                resetLoadingBtn($('.mymodal #media-list'));
            }
        });
    }

    function checkType(haystack, needle) {
        return haystack.toLowerCase().indexOf(needle.toLowerCase());
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#media-source').removeClass('no-source');
                $('#media-source').css('width', '100%');
                $('#media-source').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function alternativeView(file) {
        $('#media-source').removeClass('no-source');
        $('#media-source').css('background-color', 'white')
        $('#media-source').css('object-fit', 'contain');
        $('#media-source').attr('src', `${root_url}/img/${file}`);
    }

    function callMedia(id, btn, htm, callback = () => {}) {
        if (id) {
            setLoadingBtn(btn);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='X-CSRF-TOKEN']").attr('content')
                }
            });
            $.ajax({
                url: base_url + '/menu/detail',
                type: 'post',
                data: {
                    id: id
                },
                success: function(res) {
                    $('#media-id').val(res.data.media_id);
                    $('#media-source').removeClass('no-source');
                    let type = res.data.media_type;
                    $('.source-media').css('width', '100%');
                    $('.source-media').css('background-color', 'rgb(225, 225, 225)')
                    $('#media-source').css('object-fit', 'cover');
                    $('#media-source').attr('src', root_url + 'media/' + res.data.media_slug);
                    $('.note-media').addClass('active');

                    resetLoadingBtn(btn, htm);
                    $('.mymodal').modal('hide');
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

    function submitMedia(form, formData, btn, htm, callback = () => {}) {
        $.ajax({
            url: base_url + '/media/save',
            type: 'post',
            dataType: 'json',
            processData: false,
            contentType: false,
            cache: false,
            data: formData,
            success: function(res) {
                if (res.message.status) {
                    successMsg(res.message.msg);

                    $('#media-id').val(res.id);
                    $('#media-source').removeClass('no-source');
                    let type = res.data.media_type;
                    if (checkType(type, 'image') !== -1) {
                        $('.source-media').css('width', '100%');
                        $('.source-media').css('background-color', 'rgb(225, 225, 225)')
                        $('#media-source').css('object-fit', 'cover');
                        $('#media-source').attr('src', root_url + 'media/' + res.data.media_slug);
                    } else if (checkType(type, 'pdf') !== -1) {
                        alternativeView('pdf_icon.png');
                    } else if (checkType(type, 'word') !== -1) {
                        alternativeView('docx_icon.png');
                    } else if (checkType(type, 'powerpoint') !== -1 || checkType(type, 'presentation') !== -1) {
                        alternativeView('pptx_icon.png');
                    } else if (checkType(type, 'excel') !== -1 || checkType(type, 'spreadsheet') !== -1) {
                        alternativeView('xlsx_icon.png');
                    }
                    $('.note-media').addClass('active');
                    $('.mymodal').modal('hide');
                } else {
                    resetLoadingBtn(btn, htm);
                    errorMsg(res.message.msg);
                }
                resetLoadingBtn(btn, htm);
                form[0].reset();
            },
            error: function(xhr, status, error) {
                resetLoadingBtn(btn, htm);
                errorMsg(error);
            }
        })
    }
</script>
<script>
    $(document).ready(function() {

        function setform(data) {
            resetForm();
            var form = $('.form-galeri');
            form.find('input[name=\'kuliner_id\']').val(data.kuliner);
            form.find('input[name=\'id\']').val(data.id);
            form.find('input[name=\'nama\']').val(data.menu);
            form.find('input[name=\'harga\']').val(data.harga);
            form.find('textarea[name=\'deskripsi\']').val(data.deskripsi);
            form.find('input[name=\'media\']').val(data.media);
            $('#media-source').removeClass('no-source');
            $('#media-source').css('object-fit', 'cover');
            $('#media-source').attr('src', root_url + 'media/' + data.slug);
            $('.note-media').addClass('active');
        }

        function resetForm() {
            var form = $('.form-galeri');
            form[0].reset();
            form.find('input[type=\'hidden\']').val('');
        }

        $('.btn-reset-media').on('click', function(e) {
            let mediaId = $('#media-id').val();
            let mediaSrc = $('#media-source');
            let mediaNote = $('.note-media');
            if (mediaId.length != 0) {
                $('#media-id').val('');
            }
            mediaSrc.addClass('no-source');
            mediaSrc.removeAttr('src');
            mediaNote.removeClass('active');
        });

        $('.btn-reset').click(function(e) {
            e.preventDefault();
            resetForm();
        });

        $('.form-galeri').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var btn = form.find('.btn-submit');
            var htm = btn.html();
            setLoadingBtn(btn);
            $.ajax({
                url: base_url + '/menu/save',
                type: 'post',
                dataType: 'json',
                data: form.serialize(),
                success: function(res) {
                    if (res.status) {
                        successMsg(res.msg);
                        setTimeout(function() {
                            location.reload();
                        }, 800);
                    } else {
                        errorMsg(res.msg);
                    }
                    resetLoadingBtn(btn, htm);
                },
                error: function(xhr, status, error) {
                    resetLoadingBtn(btn, htm);
                    errorMsg(error);
                }
            });
        });

        $('.btn-media').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var htm = btn.html();
            setLoadingBtn(btn);
            $.ajax({
                url: base_url + '/menu/media',
                data: {
                    key: 'cover'
                },
                type: 'post',
                success: function(res) {
                    resetLoadingBtn(btn, htm);
                    $('.mymodal').html(res).modal('show');
                    setLoadingBtn($('.mymodal #media-list'));
                    viewList(1, null);
                },
                error: function(xhr, status, error) {
                    errorMsg(error);
                    resetLoadingBtn(btn, htm);
                },
            });
        });

        $(document).on('click', '.modal-content .modal-body .tab-content #media-list .row .media', function(e) {
            e.preventDefault();
            e.stopPropagation();
            let btn = $(this).find('#insert-media');
            let htm = btn.html();
            let id = $(this).data('id');
            callMedia(id, btn, htm);
        });

        $(document).on('input', '.mymodal #keyword', function() {
            const UpdatedKey = $(this).val();
            viewList(1, UpdatedKey);
        });

        $('.mymodal').submit('.form-media', function(e) {
            e.preventDefault();
            e.stopPropagation();
            let form = $('.mymodal .form-media');
            let formData = new FormData($('.mymodal .form-media')[0]);
            let btn = form.find('.btn-submit');
            let htm = btn.html();
            setLoadingBtn(btn);
            submitMedia(form, formData, btn, htm);

        });

        $('#nestable .dd-list .dd3-item .dd3-content').on('click', '.btn-edit', function(e) {
            e.stopPropagation();
            e.preventDefault();
            var btn = $(this);
            var htm = btn.html();
            var id = btn.attr('data-id');
            if (id) {
                setLoadingBtn(btn);
                $.ajax({
                    url: base_url + '/menu/edit',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(res) {
                        if (res.status) {
                            successMsg(res.msg);
                            setform(res.data);
                        } else {
                            errorMsg(res.msg);
                        }
                        resetLoadingBtn(btn, htm);
                    },
                    error: function(xhr, status, error) {
                        resetLoadingBtn(btn, htm);
                        errorMsg(error);
                    }
                });
            }
        });

        $('#nestable .dd-list .dd3-item .dd3-content').on('click', '.btn-delete', function(e) {
            e.stopPropagation();
            e.preventDefault();
            var btn = $(this);
            var htm = btn.html();
            var id = btn.attr('data-id');
            if (id) {
                if (confirm('Yakin hapus galeri ?')) {
                    setLoadingBtn(btn);
                    $.ajax({
                        url: base_url + '/menu/delete',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                        success: function(res) {
                            if (res.status) {
                                successMsg(res.msg);
                                setTimeout(function() {
                                    location.reload();
                                }, 800);
                            } else {
                                errorMsg(res.msg);
                            }
                            resetLoadingBtn(btn, htm);
                        },
                        error: function(xhr, status, error) {
                            resetLoadingBtn(btn, htm);
                            errorMsg(error);
                        }
                    });
                }
            }
        });
    });
</script>
<?= $this->endsection() ?>

<?= $this->section('plugin_css') ?>
<?php nestableCss() ?>
<?= $this->endsection() ?>

<?= $this->section('plugin_js') ?>
<?php nestableJs() ?>
<?= $this->endsection() ?>