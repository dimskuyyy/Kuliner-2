<?php

use Config\Services;

helper(['form']);
$encrypter = Services::encrypter();
?>
<div class="box box-widget">
    <div class="box-body">
        <div class="pull-left">
            <button class="btn btn-sm btn-flat btn-primary btn-list"><i class="fa fa-list"></i> Membership</button>
        </div><br><br>
        <?php echo form_open('#', ['class' => 'form-post']);
        if (isset($data)) {
            echo form_hidden('id', $data['member_id']);
        }
        ?>
        <div class="modal-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" <?= isset($data) ? 'hidden' : ''?>>
                        <label for='email'>Email User</label><br>
                        <select name="email" class="form-control select-mod select2"  <?= isset($data) ? 'disabled=disabled' : ''?>>
                            <?php foreach ($user as $row) : ?>
                                <?php if (isset($data) && $data['user_id'] == $row['user_id']) : ?>
                                    <option value="<?= $row['user_id'] ?>" selected><?= $row['user_email'] ?></option>
                                <?php else : ?>
                                    <option value="<?= $row['user_id'] ?>"><?= $row['user_email'] ?></option>
                                <?php endif; ?>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group" <?= isset($data) ? '' : 'hidden'?>>
                        <label for='email'>Email</label><br>
                        <input type="text" name="email" class="form-control" <?= isset($data) ? 'readonly' : 'disabled=disabled'?> style="position: absolute;left:-9999px" value="<?= isset($data) ? $data['user_id'] : '' ?>" required>
                        <input type="text" name="#" class="form-control" <?= isset($data) ? 'readonly' : 'disabled=disabled'?> value="<?= isset($data) ? $data['user_email'] : '' ?>" required>
                    </div>
                    <div class="form-group">
                        <label for='kode'>Kode Member</label><br>
                        <input type="text" name="kode" class="form-control" value="<?= isset($data) ? $data['member_code'] : '' ?>" required>
                    </div>
                    <div class="form-group">
                        <label for='expire'>Kadaluarsa</label><br>
                        <input type="date" name="expire" class="form-control" value="<?= isset($data) ? date('Y-m-d', strtotime($data['expired_date'])) : '' ?>" required>
                    </div>
                    <div class="form-group" id="form-level">
                        <label for='type'>Member Status</label><br>
                        <label><input type="radio" class="type" name="status" value="1" <?= isset($data) ? ($data['member_status'] == 1 ? 'checked' : '') : '' ?> required> Tidak Aktif</label>
                        <label><input type="radio" class="type" name="status" value="2" <?= isset($data) ? ($data['member_status'] == 2 ? 'checked' : '') : '' ?> required> Aktif</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-close-form" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
                <button type="submit" class="btn btn-primary btn-submit"><i class="fa fa-save"></i> Simpan</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script src="<?php echo base_url() ?>back/js/wbpanel.js"></script>
<script>
    let placeholder = "<?= base_url('img/front/placeholder/180x180.png') ?>";
</script>
<script>
    $(document).ready(function() {
        $('.form-post').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var btn = form.find('.btn-submit');
            var htm = btn.html();
            setLoadingBtn(btn);
            var formData = new FormData(form[0]);
            $.ajax({
                url: base_url + '/membership/save',
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
                url: base_url + '/membership/media',
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
    });
</script>