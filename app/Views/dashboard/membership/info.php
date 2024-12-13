<?php
helper(['form']);
?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Form Tambah Media</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for='tahun'>Member Kode</label>
                <input type="text" class="form-control" value="<?= isset($data) ? $data['member_code'] : '' ?>" id="tahun" readonly>
            </div>
            <div class="form-group">
                <label for='expire'>Expired Date</label>
                <input type="text" class="form-control" value="<?= isset($data) ? $data['expired_date'] : '' ?>" id="expire" readonly>
            </div>
            <div class="form-group">
                <label for='status'>Member Status</label>
                <input type="text" class="form-control" value="<?= isset($data) ? $data['expired_date'] : '' ?>" id="status" readonly>
            </div>
            <div class="form-group">
                <label for="image">Last Payment</label>
                <div id="imagePreview">
                    <?php if (!empty($payment)) {
                        if (stripos($payment['media_type'], 'image') !== false) {
                    ?>
                            <img id="preview" src="<?= base_url('media/' . $payment['media_slug']) ?>" alt="Preview" class="img-thumbnail preview">
                        <?php } ?>
                    <?php } else { ?>
                        <img id="preview" src="#" alt="Preview" class="img-thumbnail preview hidden">
                    <?php } ?>
                </div>
                <?php if (!empty($payment)) {
                    $filename = explode('/', $payment['media_path']); ?>
                    <h4 style="text-align: center;"><?= $filename[1] ?></h4>
                <?php }else{ ?>
                    <h4 style="text-align: center;">Belum Melakukan Payment</h4>
                <?php } ?>
            </div>


        </div>
        <div class="modal-footer">
            <div class="col col-sm-12">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script>
    $("#imageInput").change(function() {
        let file = $(this)[0].files;
        let type = $(this)[0].files[0].type;
        let filename = file[0].name;
        if (checkType(type, 'image') !== -1) {
            readURL(this);
        }
    });

    function checkType(haystack, needle) {
        return haystack.toLowerCase().indexOf(needle.toLowerCase());
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').removeClass('hidden');
                $('#preview').css('width', '100%');
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function alternativeView(file) {
        $('#preview').removeClass('hidden');
        $('#preview').css('width', '200px');
        $('#preview').attr('src', `${root_url}/img/${file}`);
    }
</script>