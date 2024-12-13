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
                            <div class="sb-suptitle sb-mb-30">Kuliner</div>
                            <h1 class="sb-mb-30"><?= $detailKuliner->nama_kuliner ?></h1>
                            <ul class="sb-breadcrumbs">
                                <li><a href="<?= route_to('front.kuliner.kategori', $detailKuliner->tipe_kuliner) ?>"><?= \App\Enums\TipeKuliner::tryFrom($detailKuliner->tipe_kuliner)->label() ?></a></li>
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
                                    <img src="<?= base_url('/front/img/faces/1.jpg') ?>" alt="<?= $detailKuliner->user_nama ?>">
                                </div>
                                <h4><?= $detailKuliner->user_nama ?></h4>
                            </div>
                            <div class="sb-suptitle"><span><?= \CodeIgniter\I18n\Time::parse($detailKuliner->kuliner_created_at)->humanize() ?></div>
                        </div>

                        <div class="sb-post-cover sb-mb-30"><img src="<?= route_to('media', $detailKuliner->media_slug) ?>" alt="<?= $detailKuliner->media_nama ?>"></div>

                        <p class="sb-text sb-mb-30"><?= $detailKuliner->deskripsi ?></p>

                        <h3 class="sb-mb-15">Lokasi:</h3>
                        <p class="sb-text sb-mb-15"><?= $detailKuliner->alamat ?></p>
                        <div id="map" class="sb-post-cover sb-mb-30"></div>
                        <!-- <p class="sb-text sb-mb-30">Temporibus minus expedita molestiae</p> -->
                        <!-- <div class="row">
                            <div class="col-sm-4">
                                <div class="sb-post-cover sb-post-cover-vert sb-mb-30">
                                    <img src="img/blog/post-1.jpg" alt="Method of cooking">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="sb-post-cover sb-post-cover-vert sb-mb-30">
                                    <img src="img/blog/post-2.jpg" alt="Method of cooking">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="sb-post-cover sb-post-cover-vert sb-mb-30">
                                    <img src="img/blog/post-3.jpg" alt="Method of cooking">
                                </div>
                            </div>
                        </div> -->
                        <!-- <p class="sb-text sb-mb-30">Atque nulla vel ipsam doloremque illo rem eveniet nemo, quod error quasi voluptatibus, cum quo odit molestiae repellendus, repudiandae consequatur natus consequuntur! Voluptates cumque, laborum
                            blanditiis at qui. Ut suscipit reprehenderit eveniet, facere commodi sequi soluta eligendi fugiat, enim quasi error, rerum ullam voluptatem asperiores quaerat, alias facilis! Autem, nihil quidem amet distinctio deleniti iste maiores
                            aut culpa itaque harum provident mollitia magnam, nemo at expedita.</p> -->
                        <!-- <p class="sb-text sb-mb-30">Facere commodi sequi blanditiis at qui. Ut suscipit reprehenderit eveniet, facere soluta eligendi fugiat, enim quasi temporibus minus expedita molestiae</p> -->
                        <!-- <div class="row">
                            <div class="col-sm-4">
                                <div class="sb-post-cover sb-post-cover-vert sb-mb-30">
                                    <img src="img/blog/post-4.jpg" alt="Method of cooking">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="sb-post-cover sb-post-cover-vert sb-mb-30">
                                    <img src="img/blog/post-5.jpg" alt="Method of cooking">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="sb-post-cover sb-post-cover-vert sb-mb-30">
                                    <img src="img/blog/post-6.jpg" alt="Method of cooking">
                                </div>
                            </div>
                        </div> -->
                        <!-- <p class="sb-text sb-mb-15">Consectetur adipisicing elit. Eaque neque hic, quis unde quasi deserunt! Illo nostrum laboriosam voluptates id voluptatum rem voluptatem. Id ducimus, neque ipsam sit in assumenda!Atque nulla vel ipsam
                            doloremque illo rem eveniet nemo, quod error quasi voluptatibus, cum quo odit molestiae repellendus, repudiandae consequatur natus consequuntur! Voluptates cumque, laborum
                            blanditiis at qui. Ut suscipit reprehenderit eveniet, facere commodi sequi soluta eligendi fugiat, enim quasi error, rerum ullam voluptatem asperiores quaerat, alias facilis! Autem, nihil quidem amet distinctio deleniti iste maiores
                            aut culpa itaque harum provident mollitia magnam, nemo at expedita.</p> -->
                        <!-- <p class="sb-text">Bon appetit!</p> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Detail Kuliner End -->

        <?php if ($dataPostKuliner->getNumRows() > 0): ?>
            <!-- post start -->
            <section class="sb-popular sb-p-60-30">
                <div class="sb-bg-3">
                </div>
                <div class="container">
                    <div class="sb-group-title sb-mb-30">
                        <div class="sb-left sb-mb-30">
                            <h2 class="sb-mb-30">Postingan mengenai kuliner ini</h2>

                            <?php if (!isGuest()): ?>
                                <!-- button -->
                                <a href="<?= route_to('front.kuliner.new-post', $detailKuliner->slug_kuliner) ?>" target="_blank" class="sb-btn sb-m-0">
                                    <span class="sb-icon">
                                        <img src="<?= base_url('front/img/ui/icons/arrow.svg') ?>" alt="icon">
                                    </span>
                                    <span>Buat Post</span>
                                </a>
                                <!-- button end -->
                            <?php endif; ?>

                            <!-- <p class="sb-text">Consectetur numquam poro nemo veniam<br>eligendi rem adipisci quo modi.</p> -->
                        </div>
                        <div class="sb-right sb-mb-30">
                            <!-- slider navigation -->
                            <div class="sb-slider-nav">
                                <div class="sb-prev-btn sb-blog-prev"><i class="fas fa-arrow-left"></i></div>
                                <div class="sb-next-btn sb-blog-next"><i class="fas fa-arrow-right"></i></div>
                            </div>
                            <!-- slider navigation end -->
                        </div>
                    </div>
                    <div class="swiper-container sb-blog-slider-3i">
                        <div class="swiper-wrapper">
                            <?php foreach ($dataPostKuliner->getResult() as $post): ?>
                                <div class="swiper-slide">
                                    <a href="<?= route_to('front.post.detail', $post->slug_post) ?>" class="sb-blog-card sb-mb-30">
                                        <div class="sb-cover-frame sb-mb-30">
                                            <img src="<?= route_to('media', $post->media_slug) ?>" alt="<?= $post->media_nama ?>">
                                            <!-- <div class="sb-badge">Popular</div> -->
                                        </div>
                                        <div class="sb-blog-card-descr">
                                            <h3 class="sb-mb-10"><?= $post->judul ?></h3>
                                            <div class="sb-suptitle sb-mb-15">
                                                <span><?= $post->post_created_at ? \CodeIgniter\I18n\Time::parse($post->post_created_at)->humanize() : '' ?></span>
                                                <span> <?= $post->user_nama ?></span>
                                            </div>
                                            <p class="sb-text"><?= $post->excerpt . '...' ?></p>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
            <!-- post end -->
        <?php endif; ?>
    </section>
    <!-- publication end -->
</div>
<?= $this->endsection() ?>
<?= $this->section('scripts') ?>
<script>
    $(function() {
        // Initialize the map and set its view to the specified latitude and longitude
        // const map = L.map('map').setView([0.7893, 113.9213], 5); // Example: Centered on Indonesia
        const map = L.map('map').setView([<?= $detailKuliner->latitude ?>, <?= $detailKuliner->longitude ?>], 15); // Example: Centered on Indonesia

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add a marker at a specific latitude and longitude
        const latitude = <?= $detailKuliner->latitude ?>; // Replace with your latitude
        const longitude = <?= $detailKuliner->longitude ?>; // Replace with your longitude
        L.marker([latitude, longitude]).addTo(map)
            .bindPopup('<?= $detailKuliner->nama_kuliner ?>') // Add a popup to the marker
            .openPopup();
    });
</script>
<?= $this->endSection() ?>