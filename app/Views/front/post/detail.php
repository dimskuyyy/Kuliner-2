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
                            <div class="sb-suptitle sb-mb-30">Post</div>
                            <h1 class="sb-mb-30"><?= $detailPost->judul ?></h1>
                            <ul class="sb-breadcrumbs">
                                <li><a href="<?= route_to('front.kuliner.detail', $detailPost->slug_kuliner) ?>"><?= $detailPost->nama_kuliner ?></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- main title end -->
                </div>
            </div>
        </div>
    </section>
    <!-- banner end -->

    <!-- publication -->
    <section class="sb-publication sb-p-90-0">
        <!-- Detail Kuliner -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="sb-mb-90">
                        <div class="sb-author-panel">
                            <div class="sb-author-frame">
                                <div class="sb-avatar-frame">
                                    <img src="<?= base_url('/front/img/faces/1.jpg') ?>" alt="<?= $detailPost->user_nama ?>">
                                </div>
                                <h4><?= $detailPost->user_nama ?></h4>
                            </div>
                            <div class="sb-suptitle"><span><?= \CodeIgniter\I18n\Time::parse($detailPost->post_created_at ?? '')->humanize() ?></div>
                        </div>

                        <div class="sb-post-cover sb-mb-30"><img src="<?= route_to('media', $detailPost->media_slug) ?>" alt="<?= $detailPost->media_nama ?>"></div>

                        <p class="sb-text sb-mb-30"><?= $detailPost->konten ?></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Detail Kuliner End -->

        <!-- Komentar -->
        <div class="container">
            <?php if (!isGuest()): ?>
                <!-- add komen -->
                <section class="sb-p-90-90">
                    <div class="container" data-sticky-container>
                        <div class="row">
                            <div class="col">
                                <form class="sb-checkout-form" id="form-comment">
                                    <div class="sb-mb-30">
                                        <h3>Berikan Komentar</h3>
                                    </div>
                                    <div class="sb-group-input">
                                        <textarea name="comment" required></textarea>
                                        <span class="sb-bar"></span>
                                        <label>Komentar</label>
                                    </div>
                                    <!-- button -->
                                    <button type="submit" id="submit-btn" class="sb-btn sb-m-0">
                                        <span class="sb-icon">
                                            <img src="<?= base_url('front/img/ui/icons/arrow.svg') ?>" alt="icon">
                                        </span>
                                        <span>Submit</span>
                                    </button>
                                    <!-- button end -->
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- add komen end -->
            <?php endif; ?>
            <?php if ($dataKomentarPost->getNumRows() > 0): ?>
            <div class="sb-masonry-grid" style="position: relative; height: 1075.8px;">
                <div class="sb-grid-sizer"></div>
                    <?php foreach ($dataKomentarPost->getResult() as $komentar): ?>
                        <div class="sb-grid-item">
                            <div class="sb-review-card sb-mb-60">
                                <div class="sb-author-frame sb-mb-15">
                                    <div class="sb-avatar-frame">
                                        <img src="<?= base_url('front/img/faces/1.jpg') ?>" alt="<?= $komentar->user_nama ?>">
                                    </div>
                                    <h4><?= $komentar->user_nama ?></h4>
                                </div>
                                <p class="sb-text"><?= $komentar->komentar_konten ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        <!-- Komentar end -->
    </section>
    <!-- publication end -->
</div>
<?= $this->endsection() ?>
<?php $this->section('scripts'); ?>
<script>
    $(function () {
        $('#form-comment').on('submit', function (event) {
            event.preventDefault();
            var form = $(this);
            var btn = form.find('#submit-btn');
            var htm = btn.html();
            setLoadingBtn(btn);
            $.ajax({
                url: '<?= route_to('front.post.comment', $detailPost->slug_post); ?>',
                type: 'post',
                dataType: 'json',
                data: form.serialize(),
                success: function(result) {
                    if (result.status) {
                        successMsg(result.msg);
                        location.reload();
                    } else {
                        errorMsg(result.msg);
                        resetLoadingBtn(btn, htm);
                    }
                },
                error: function(xhr, status, error) {
                    errorMsg(error);
                    resetLoadingBtn(btn, htm);
                }
            });
        });
    });
</script>
<?php $this->endSection(); ?>