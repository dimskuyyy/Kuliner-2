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
                            <h1 class="sb-mb-30">Temukan tempat makan terbaik di Pekanbaru</h1>
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

    <!-- menu section 1 -->
    <section class="sb-menu-section sb-p-90-60">
        <div class="sb-bg-1">
            <div></div>
        </div>
        <div class="container">
            <!-- filter -->
            <div class="sb-filter mb-30">
                <?php foreach (\App\Enums\TipeKuliner::cases() as $tipe): ?>
                    <a href="<?= route_to('kuliner.kategori', $tipe->value) ?>" class="sb-filter-link <?= $tipe != \App\Enums\TipeKuliner::tryFrom($kategori) ?: 'sb-active' ?>"><?= $tipe->label() ?></a>
                    <!-- <a href="#." class="sb-filter-link">Starters</a>
                    <a href="#." class="sb-filter-link">Main dishes</a>
                    <a href="#." class="sb-filter-link">Drinks</a>
                    <a href="#." class="sb-filter-link">Dessert</a> -->
                <?php endforeach; ?>
            </div>
            <!-- filter end -->
            <div class="text-center sb-mb-60">
                <!-- <h2 class="sb-mb-30">Kuliner</h2> -->
                <!-- <p class="sb-text">Consectetur numquam poro nemo veniam<br>eligendi rem adipisci quo modi.</p> -->
            </div>
            <div class="row">
                <?php foreach ($dataKuliner->getResult() as $kuliner): ?>
                    <div class="col-lg-4">
                        <a data-no-swup href="#" class="sb-menu-item sb-mb-30">
                            <div class="sb-cover-frame">
                                <img src="<?= route_to('media', $kuliner->media_slug) ?>" alt="<?= $kuliner->media_nama ?>">
                                <div class="sb-badge sb-vegan"><?= $kuliner->tipe_kuliner ?></div>
                            </div>
                            <div class="sb-card-tp">
                                <h4 class="sb-card-title"><?= $kuliner->nama_kuliner ?></h4>
                                <div class="sb-price"></div>
                            </div>
                            <div class="sb-description">
                                <p class="sb-text sb-mb-15"><?= $kuliner->alamat ?></p>
                                <p><strong><?= $kuliner->user_nama ?></strong></p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- menu section 1 end -->
</div>
<?= $this->endsection() ?>