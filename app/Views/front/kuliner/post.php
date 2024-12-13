<?= $this->extend('layout/front_main') ?>
<?= $this->section('content') ?>
<div id="sb-dynamic-content" class="sb-transition-fade">
    <!-- banner -->
    <section class="sb-banner sb-banner-sm sb-banner-color">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- main title -->
                    <div class="sb-main-title-frame">
                        <div class="sb-main-title text-center">
                            <!-- <span class="sb-suptitle sb-mb-30">Menu</span> -->
                            <h1 class="sb-mb-30"><?= $detailKuliner->nama_kuliner ?></h1>
                            <!-- <p class="sb-text sb-text-lg sb-mb-30">Consectetur numquam poro nemo veniam<br>eligendi rem adipisci quo modi.</p> -->
                            <!-- <ul class="sb-breadcrumbs">
                                <li><a href="home-1.html">Home</a></li>
                                <li><a href="menu-1.html">Menu</a></li>
                            </ul> -->
                        </div>
                    </div>
                    <!-- main title end -->
                </div>
            </div>
        </div>
    </section>
    <!-- banner end -->

    <!-- Post form -->
    <section class="sb-p-90-90">
        <div class="container">
            <div class="row">
                <div class="col">
                    <form class="sb-checkout-form" id="post-form" enctype="multipart/form-data">
                        <div class="sb-post-cover sb-mb-30" id="preview"><img id="previewImg" src="<?= base_url('front/img/blog/4.jpg') ?>" alt="Preview"></div>
                        <button type="button" class="sb-btn sb-mb-30 justify-content-center w-100" id="mediaBtn">
                            <!-- <span class="sb-icon">
                                <img src="">
                            </span> -->
                            <span>Tambah Gambar</span>
                        </button>
                        <input type="file" name="media" id="media" class="d-none" required>
                        <div class="sb-group-input">
                            <input type="text" name="judul" required>
                            <span class="sb-bar"></span>
                            <label>Judul Post</label>
                        </div>
                        <div class="sb-group-input">
                            <textarea name="konten" required=""></textarea>
                            <span class="sb-bar"></span>
                            <label>Konten Post</label>
                        </div>
                        <button type="submit" class="sb-btn sb-mb-30 justify-content-center w-100" id="submitBtn">
                            <!-- <span class="sb-icon">
                                <img src="">
                            </span> -->
                            <span>Submit Post</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Post form end-->
</div>
<?= $this->endsection() ?>
<?= $this->section('scripts') ?>
<script>
    $(function () {
        // Hide media preview
        $('#preview').hide('fast');

        $('#mediaBtn').on('click', function () {
            $('#media').trigger('click');
        });

        $('#media').on('change', function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    // $('#preview').removeClass('hidden');
                    // $('#preview').css('width','100%');
                    console.log(e.target.result);
                    $('#previewImg').attr('src', e.target.result);
                    $('#preview').show('fast');
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        $('#post-form').on('submit', function (e) {
            e.preventDefault();
            let form = $(this);
            let formData = new FormData(this);
            let btn = form.find('#submitBtn');
            let htm = btn.html();
            setLoadingBtn(btn);
            $.ajax({
                url: '<?= route_to('front.kuliner.store-post', $slug) ?>',
                type: 'post',
                dataType: 'json',
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                success: function(res) {
                    if (res.message.status) {
                        successMsg(res.message.msg);
                        window.location.replace('<?= base_url('post') ?>/' + res.data.slug_post);
                    } else {
                        errorMsg(res.message.msg);
                    }
                    resetLoadingBtn(btn, htm);
                },
                error: function(xhr, status, error) {
                    resetLoadingBtn(btn, htm);
                    let response = JSON.parse(xhr.responseText);
                    let errorMessage = response.msg;
                    errorMsg(errorMessage);
                }
            })
        });
    });
</script>
<?= $this->endSection() ?>