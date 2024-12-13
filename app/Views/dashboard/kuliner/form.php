<?= $this->extend('dashboard/layout/back_main') ?>
<?= $this->section('title') ?>
Kuliner
<?= $this->endsection() ?>

<?= $this->section('header') ?>
<section class="content-header">
    <h1>
        Kuliner
    </h1>
</section>
<?= $this->endsection() ?>

<?= $this->section('content') ?>
<?php

use Config\Services;

helper(['form']);
$encrypter = Services::encrypter();
?>
<div class="box box-widget">
    <div class="box-body">
        <?php echo form_open('#', ['class' => 'form-post']);
        if (isset($data)) {
            echo form_hidden('id', $data['kuliner_id']);
            echo form_hidden('oldSlug', $data['slug_kuliner']);
        }
        ?>
        <div class="modal-body">

            <div class="row">
                <div class="col-md-6">'
                    <div class="form-group">
                        <label for='nama'>Nama Kuliner</label><br>
                        <input type="text" name="nama" class="form-control" value="<?= isset($data) ? $data['nama_kuliner'] : '' ?>" required>
                    </div>
                    <div class="form-group">
                        <label for='tipe'>Tipe Kuliner</label><br>
                        <select name="tipe" class="form-control select-mod select2">
                            <?php if (isset($data)) { ?>
                                <option value="cafe" <?= $data['tipe_kuliner'] == 'cafe' ? 'selected' : '' ?>>Cafe</option>
                                <option value="street food" <?= $data['tipe_kuliner'] == 'street food' ? 'selected' : '' ?>>Street Food</option>
                                <option value="kantin" <?= $data['tipe_kuliner'] == 'kantin' ? 'selected' : '' ?>>Kantin</option>
                                <option value="rumah makan" <?= $data['tipe_kuliner'] == 'rumah makan' ? 'selected' : '' ?>>Rumah Makan</option>
                                <option value="restoran" <?= $data['tipe_kuliner'] == 'restoran' ? 'selected' : '' ?>>Restoran</option>
                            <?php } else { ?>
                                <option value="cafe">Cafe</option>
                                <option value="street food">Street Food</option>
                                <option value="kantin">Kantin</option>
                                <option value="rumah makan">Rumah Makan</option>
                                <option value="restoran">Restoran</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for='deskripsi'>Deskripsi</label><br>
                        <textarea id="deskripsi" style=" width: 100%;" name="deskripsi" rows="5"><?= isset($data) ? $data['deskripsi'] : ''; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for='alamat'>Alamat</label><br>
                        <input type="text" name="alamat" class="form-control" value="<?= isset($data) ? $data['alamat'] : '' ?>" required>
                        <input id="latitude" type="text" style="position: absolute; left:-9999px" name="latitude" class="form-control" value="<?= isset($data) ? $data['latitude'] : '' ?>" required>
                        <input id="longitude" type="text" style="position: absolute; left:-9999px" name="longitude" class="form-control" value="<?= isset($data) ? $data['longitude'] : '' ?>" required>
                    </div>

                    <div class="form-group">
                        <div id="map" style="width: 100%;height:500px"></div>
                    </div>
                    <div class="form-group">
                        <label for='media'>Media</label><br>
                        <div class="choose-media">
                            <a href="#" class="btn btn-sm btn-flat btn-primary btn-media" data-backdrop="static"><i class="fa fa-plus"></i> Unggah Foto Utama Kuliner <span id="text-optional"></span></a>
                            <button type="button" class="btn btn-default btn-flat btn-sm btn-reset-media"><i class="fa fa-recycle" aria-hidden="true"></i></button>
                        </div>
                        <input type="hidden" name="media" id="media-id" value="<?= isset($data) ? $data['media_id']: '' ?>">
                        <div class="source-media" style="height: 500px;">
                            <?php if (isset($data)) {
                                if (stripos($data['media_type'], 'image') !== false) {
                            ?>
                                    <img id="media-source" src="<?= base_url('media/' . $data['media_slug']) ?>" style="height: 100%;" alt="Preview">
                                <?php }
                            } else { ?>
                                <img id="media-source" class="no-source">
                            <?php } ?>
                            <p class="note-media <?= isset($data) ? 'active' : '' ?>">Tidak Ada Media</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">=
                <button type="submit" class="btn btn-primary btn-submit"><i class="fa fa-save"></i> Simpan</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<?= $this->endsection() ?>
<?= $this->section('js') ?>
<script src="<?php echo base_url() ?>back/js/wbpanel.js"></script>
<script>
    let placeholder = "<?= base_url('img/front/placeholder/180x180.png') ?>";
    const content = $('.box-body');
    const media = $('.mymodal #media-list');

    const viewList = debounce((page, keyword) => {
        loadMedia(page, keyword)
    }, 800, $('.mymodal #media-list'));

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
                url: base_url + '/kuliner/detail',
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
        // Inisialisasi peta
        let map = L.map('map').setView([0.5415986391558214, 101.43155925047677], 11); // Koordinat default Pekanbaru

        // Tambahkan tile layer (peta dasar)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Tambahkan marker di posisi awal
        <?php if (isset($data)) { ?>
            var lat = <?=$data['latitude']?>;
            var lng = <?=$data['longitude']?>;
            var marker = L.marker([lat,lng]).addTo(map);
        <?php } else { ?>
            var marker;
        <?php } ?>

        // Update input latitude dan longitude saat marker dipindahkan
        map.on('click', function(event) {
            console.log(event.latlng)

            if (marker) {
                marker.setLatLng(event.latlng);
            } else {
                // Jika marker belum ada, buat marker baru
                marker = L.marker(event.latlng).addTo(map);
            }

            let latitude = event.latlng.lat;
            let longitude = event.latlng.lng;

            document.getElementById('latitude').value = latitude;
            document.getElementById('longitude').value = longitude;
        });

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

        $('.form-post').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var btn = form.find('.btn-submit');
            var htm = btn.html();
            setLoadingBtn(btn);
            var formData = new FormData(form[0]);
            $.ajax({
                url: base_url + '/kuliner/save',
                type: 'post',
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res.status) {
                        successMsg(res.msg);
                        form[0].reset();
                        loadData();
                    } else {
                        errorMsg(res.msg);
                    }
                    resetLoadingBtn(btn, htm);
                },
                error: function(xhr, status, error) {
                    resetLoadingBtn(btn, htm);
                    errorMsg(error);
                }
            })
        });

        // Select 2
        $('.btn-list,.btn-close-form').click(function(e) {
            e.preventDefault();
            loadData();
        });

        $('.select-mod').select2({
            language: 'id'
        });


        $('.btn-media').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var htm = btn.html();
            setLoadingBtn(btn);
            $.ajax({
                url: base_url + '/kuliner/media',
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
    });
</script>
<?= $this->endsection() ?>

<?= $this->section('plugin_css') ?>
<?php
select2Css();
leafletCss();
?>
<?= $this->endsection() ?>

<?= $this->section('plugin_js') ?>
<?php
select2Js();
leafletJs();
?>
<?= $this->endsection() ?>