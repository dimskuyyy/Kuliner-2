<?= $this->extend('layout/front_main') ?>
<?= $this->section('content') ?>
<div id="sb-dynamic-content" class="sb-transition-fade">

  <!-- banner -->
  <section class="sb-banner">
    <div class="sb-bg-1">
      <div></div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <!-- main title -->
          <div class="sb-main-title-frame">
            <div class="sb-main-title">
              <span class="sb-suptitle sb-mb-30">Hi, new friend!</span>
              <h1 class="sb-mb-30">Temukan <span>Kuliner</span>, <br>Terbaik <span>mu</span> di <br>Pekanbaru!</h1>
              <p class="sb-text sb-text-lg sb-mb-30">Jelajahi kuliner Pekanbaru bersama <br>Foodpath! Rute Cepat Rasa Tepat</p>
              <!-- button -->
              <a href="<?=base_url('Kuliner')?>" class="sb-btn">
                <span class="sb-icon">
                  <img src="<?= base_url() ?>front/img/ui/icons/menu.svg" alt="icon">
                </span>
                <span>Jelajahi Kuliner</span>
              </a>
              <!-- button end -->
              <!-- button -->
              <a href="<?=base_url('about')?>" class="sb-btn sb-btn-2 sb-btn-gray">
                <span class="sb-icon">
                  <img src="<?= base_url() ?>front/img/ui/icons/arrow.svg" alt="icon">
                </span>
                <span>Tentang Kami</span>
              </a>
              <!-- button end -->
            </div>
          </div>
          <!-- main title end -->
        </div>
        <div class="col-lg-6">
          <div class="sb-illustration-1">
            <img src="<?= base_url() ?>front/img/illustrations/girl.png" alt="girl" class="sb-girl">
            <div class="sb-cirkle-1"></div>
            <div class="sb-cirkle-2"></div>
            <div class="sb-cirkle-3"></div>
            <div class="sb-cirkle-4"></div>
            <div class="sb-cirkle-5"></div>
            <img src="<?= base_url() ?>front/img/illustrations/3.svg" alt="phones" class="sb-pik-1">
            <img src="<?= base_url() ?>front/img/illustrations/1.svg" alt="phones" class="sb-pik-2">
            <img src="<?= base_url() ?>front/img/illustrations/2.svg" alt="phones" class="sb-pik-3">
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- banner end -->

  <!-- features -->
  <section class="sb-p-60-0">
    <div class="container">
      <div class="row flex-md-row-reverse">
        <div class="col-lg-6 align-self-center sb-mb-30">
          <h2 class="sb-mb-60">We are doing more than <br>you expect</h2>
          <ul class="sb-features">
            <li class="sb-features-item sb-mb-60">
              <div class="sb-number">01</div>
              <div class="sb-feature-text">
                <h3 class="sb-mb-15">We are located in the city center</h3>
                <p class="sb-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto nemo sint voluptatum, necessitatibus magni facilis!</p>
              </div>
            </li>
            <li class="sb-features-item sb-mb-60">
              <div class="sb-number">02</div>
              <div class="sb-feature-text">
                <h3 class="sb-mb-15">We are located in the city center</h3>
                <p class="sb-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto nemo sint voluptatum, necessitatibus magni facilis!</p>
              </div>
            </li>
            <li class="sb-features-item sb-mb-60">
              <div class="sb-number">03</div>
              <div class="sb-feature-text">
                <h3 class="sb-mb-15">We are located in the city center</h3>
                <p class="sb-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto nemo sint voluptatum, necessitatibus magni facilis!</p>
              </div>
            </li>
          </ul>
        </div>
        <div class="col-lg-6 align-self-center">
          <div class="sb-illustration-2 sb-mb-90">
            <div class="sb-interior-frame">
              <img src="<?= base_url() ?>front/img/illustrations/interior-3.jpg" alt="interior" class="sb-interior">
            </div>
            <div class="sb-square"></div>
            <div class="sb-cirkle-1"></div>
            <div class="sb-cirkle-2"></div>
            <div class="sb-cirkle-3"></div>
            <div class="sb-cirkle-4"></div>
            <div class="sb-experience">
              <div class="sb-exp-content">
                <p class="sb-h1 sb-mb-10">99+</p>
                <p class="sb-h3">Penjelajahan Kuliner</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- features end -->

  <!-- categories -->
  <section class="sb-p-0-60">
    <div class="container">
      <div class="sb-group-title sb-mb-30">
        <div class="sb-left sb-mb-30">
          <h2 class="sb-mb-30">What do you <span>like today?</span></h2>
          <p class="sb-text">Lorem ipsum dolor sit.<br>eligendi rem adipisci quo modi.</p>
        </div>
        <div class="sb-right sb-mb-30">
          <!-- button -->
          <a href="<?=base_url('kuliner')?>" class="sb-btn sb-m-0">
            <span class="sb-icon">
              <img src="<?= base_url() ?>front/img/ui/icons/arrow.svg" alt="icon">
            </span>
            <span>Jelajahi Kuliner</span>
          </a>
          <!-- button end -->
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <a href="#" class="sb-categorie-card sb-categorie-card-2 sb-mb-30">
            <div class="sb-card-body">
              <div class="sb-category-icon">
                <img src="<?= base_url() ?>front/img/categories/1.png" alt="icon">
              </div>
              <div class="sb-card-descr">
                <h3 class="sb-mb-10">Kepiting Tumpah</h3>
                <p class="sb-text">Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-6">
          <a href="#" class="sb-categorie-card sb-categorie-card-2 sb-mb-30">
            <div class="sb-card-body">
              <div class="sb-category-icon">
                <img src="<?= base_url() ?>front/img/categories/2.png" alt="icon">
              </div>
              <div class="sb-card-descr">
                <h3 class="sb-mb-10">PerSatean</h3>
                <p class="sb-text">Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-6">
          <a href="#" class="sb-categorie-card sb-categorie-card-2 sb-mb-30">
            <div class="sb-card-body">
              <div class="sb-category-icon">
                <img src="<?= base_url() ?>front/img/categories/3.png" alt="icon">
              </div>
              <div class="sb-card-descr">
                <h3 class="sb-mb-10">Martabak</h3>
                <p class="sb-text">Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-6">
          <a href="#" class="sb-categorie-card sb-categorie-card-2 sb-mb-30">
            <div class="sb-card-body">
              <div class="sb-category-icon">
                <img src="<?= base_url() ?>front/img/categories/4.png" alt="icon">
              </div>
              <div class="sb-card-descr">
                <h3 class="sb-mb-10">Kuliner Daerah</h3>
                <p class="sb-text">Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- categories end -->

  <!-- short menu -->
  <section class="sb-short-menu sb-p-0-90">
    <div class="sb-bg-2">
      <div></div>
    </div>
    <div class="container">
      <div class="sb-group-title sb-mb-30">
        <div class="sb-left sb-mb-30">
          <h2 class="sb-mb-30">Most <span>popular</span> Places</h2>
          <p class="sb-text">Consectetur numquam poro nemo veniam<br>eligendi rem adipisci quo modi.</p>
        </div>
        <div class="sb-right sb-mb-30">
          <!-- slider navigation -->
          <div class="sb-slider-nav">
            <div class="sb-prev-btn sb-short-menu-prev"><i class="fas fa-arrow-left"></i></div>
            <div class="sb-next-btn sb-short-menu-next"><i class="fas fa-arrow-right"></i></div>
          </div>
          <!-- slider navigation end -->
          <!-- button -->
          <a href="menu-1.html" class="sb-btn">
            <span class="sb-icon">
              <img src="<?= base_url() ?>front/img/ui/icons/menu.svg" alt="icon">
            </span>
            <span>Full list</span>
          </a>
          <!-- button end -->
        </div>
      </div>
      <div class="swiper-container sb-short-menu-slider-4i">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <a data-fancybox="menu" data-no-swup href="<?= base_url() ?>front/img/menu/3.jpg" class="sb-menu-item">
              <div class="sb-cover-frame">
                <img src="<?= base_url() ?>front/img/illustrations/3.jpg" alt="product">
              </div>
              <div class="sb-card-tp">
                <h4 class="sb-card-title">Sanama Coffee</h4>
                <div class="sb-price"><img src="<?= base_url() ?>front/img/ui/icons/search.svg" alt="icon"></div>
              </div>
              <div class="sb-description">
                <p class="sb-text sb-mb-15"><span>tomatoes</span>, <span>nori</span>, <span>feta cheese</span>, <span>mushrooms</span>, <span>rice noodles</span>, <span>corn</span>, <span>shrimp</span>.</p>
                <ul class="sb-stars">
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                </ul>
              </div>
            </a>
          </div>
          <div class="swiper-slide">
            <a data-fancybox="menu" data-no-swup href="<?= base_url() ?>front/img/menu/3.jpg" class="sb-menu-item">
              <div class="sb-cover-frame">
                <img src="<?= base_url() ?>front/img/illustrations/3.jpg" alt="product">
              </div>
              <div class="sb-card-tp">
                <h4 class="sb-card-title">Sanama Coffee</h4>
                <div class="sb-price"><img src="<?= base_url() ?>front/img/ui/icons/search.svg" alt="icon"></div>
              </div>
              <div class="sb-description">
                <p class="sb-text sb-mb-15"><span>tomatoes</span>, <span>nori</span>, <span>feta cheese</span>, <span>mushrooms</span>, <span>rice noodles</span>, <span>corn</span>, <span>shrimp</span>.</p>
                <ul class="sb-stars">
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                </ul>
              </div>
            </a>
          </div>
          <div class="swiper-slide">
            <a data-fancybox="menu" data-no-swup href="<?= base_url() ?>front/img/menu/3.jpg" class="sb-menu-item">
              <div class="sb-cover-frame">
                <img src="<?= base_url() ?>front/img/illustrations/3.jpg" alt="product">
              </div>
              <div class="sb-card-tp">
                <h4 class="sb-card-title">Sanama Coffee</h4>
                <div class="sb-price"><img src="<?= base_url() ?>front/img/ui/icons/search.svg" alt="icon"></div>
              </div>
              <div class="sb-description">
                <p class="sb-text sb-mb-15"><span>tomatoes</span>, <span>nori</span>, <span>feta cheese</span>, <span>mushrooms</span>, <span>rice noodles</span>, <span>corn</span>, <span>shrimp</span>.</p>
                <ul class="sb-stars">
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                </ul>
              </div>
            </a>
          </div>
          <div class="swiper-slide">
            <a data-fancybox="menu" data-no-swup href="<?= base_url() ?>front/img/menu/3.jpg" class="sb-menu-item">
              <div class="sb-cover-frame">
                <img src="<?= base_url() ?>front/img/illustrations/3.jpg" alt="product">
              </div>
              <div class="sb-card-tp">
                <h4 class="sb-card-title">Sanama Coffee</h4>
                <div class="sb-price"><img src="<?= base_url() ?>front/img/ui/icons/search.svg" alt="icon"></div>
              </div>
              <div class="sb-description">
                <p class="sb-text sb-mb-15"><span>tomatoes</span>, <span>nori</span>, <span>feta cheese</span>, <span>mushrooms</span>, <span>rice noodles</span>, <span>corn</span>, <span>shrimp</span>.</p>
                <ul class="sb-stars">
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                </ul>
              </div>
            </a>
          </div>
          <div class="swiper-slide">
            <a data-fancybox="menu" data-no-swup href="<?= base_url() ?>front/img/menu/3.jpg" class="sb-menu-item">
              <div class="sb-cover-frame">
                <img src="<?= base_url() ?>front/img/illustrations/3.jpg" alt="product">
              </div>
              <div class="sb-card-tp">
                <h4 class="sb-card-title">Sanama Coffee</h4>
                <div class="sb-price"><img src="<?= base_url() ?>front/img/ui/icons/search.svg" alt="icon"></div>
              </div>
              <div class="sb-description">
                <p class="sb-text sb-mb-15"><span>tomatoes</span>, <span>nori</span>, <span>feta cheese</span>, <span>mushrooms</span>, <span>rice noodles</span>, <span>corn</span>, <span>shrimp</span>.</p>
                <ul class="sb-stars">
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                </ul>
              </div>
            </a>
          </div>
          <div class="swiper-slide">
            <a data-fancybox="menu" data-no-swup href="<?= base_url() ?>front/img/menu/3.jpg" class="sb-menu-item">
              <div class="sb-cover-frame">
                <img src="<?= base_url() ?>front/img/illustrations/3.jpg" alt="product">
              </div>
              <div class="sb-card-tp">
                <h4 class="sb-card-title">Sanama Coffee</h4>
                <div class="sb-price"><img src="<?= base_url() ?>front/img/ui/icons/search.svg" alt="icon"></div>
              </div>
              <div class="sb-description">
                <p class="sb-text sb-mb-15"><span>tomatoes</span>, <span>nori</span>, <span>feta cheese</span>, <span>mushrooms</span>, <span>rice noodles</span>, <span>corn</span>, <span>shrimp</span>.</p>
                <ul class="sb-stars">
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                </ul>
              </div>
            </a>
          </div>
          
        </div>
      </div>
    </div>
  </section>
  <!-- short menu end -->

  <!-- team -->
  <section class="sb-p-0-60">
    <div class="container">
      <div class="sb-group-title sb-mb-30">
        <div class="sb-left sb-mb-30">
          <h2 class="sb-mb-30">Top <span>Post</span> </h2>
          <p class="sb-text">Consectetur numquam poro nemo veniam<br>eligendi rem adipisci quo modi.</p>
        </div>
        <div class="sb-right sb-mb-30">
          <!-- button -->
          <a href="about-1.html" class="sb-btn sb-m-0">
            <span class="sb-icon">
              <img src="<?= base_url() ?>front/img/ui/icons/arrow.svg" alt="icon">
            </span>
            <span>Jelajahi Post</span>
          </a>
          <!-- button end -->
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3">
          <div class="sb-team-member sb-mb-30">
            <div class="sb-photo-frame sb-mb-15">
              <img src="<?= base_url() ?>front/img/illustrations/4.jpg" alt="Team member" style="object-fit: cover;">
            </div>
            <div class="sb-member-description">
              <h4 class="sb-mb-10">M. Rizki</h4>
              <p class="sb-text sb-text-sm sb-mb-10">Sanama Coffee</p>
              
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="sb-team-member sb-mb-30">
            <div class="sb-photo-frame sb-mb-15">
              <img src="<?= base_url() ?>front/img/illustrations/4.jpg" alt="Team member" style="object-fit: cover;">
            </div>
            <div class="sb-member-description">
              <h4 class="sb-mb-10">M. Rizki</h4>
              <p class="sb-text sb-text-sm sb-mb-10">Sanama Coffee</p>
              
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="sb-team-member sb-mb-30">
            <div class="sb-photo-frame sb-mb-15">
              <img src="<?= base_url() ?>front/img/illustrations/4.jpg" alt="Team member" style="object-fit: cover;">
            </div>
            <div class="sb-member-description">
              <h4 class="sb-mb-10">M. Rizki</h4>
              <p class="sb-text sb-text-sm sb-mb-10">Sanama Coffee</p>
              
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="sb-team-member sb-mb-30">
            <div class="sb-photo-frame sb-mb-15">
              <img src="<?= base_url() ?>front/img/illustrations/4.jpg" alt="Team member" style="object-fit: cover;">
            </div>
            <div class="sb-member-description">
              <h4 class="sb-mb-10">M. Rizki</h4>
              <p class="sb-text sb-text-sm sb-mb-10">Sanama Coffee</p>   
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- team end -->

  <!-- call to action -->
  <!-- <section class="sb-call-to-action">
    <div class="sb-bg-3"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center">
          <div class="sb-cta-text">
            <h2 class="sb-h1 sb-mb-30">Download our mobile app.</h2>
            <p class="sb-text sb-mb-30">Consectetur numquam poro nemo veniam<br>eligendi rem adipisci quo modi.</p>
            <a href="#." target="_blank" data-no-swup class="sb-download-btn"><img src="<?= base_url() ?>front/img/buttons/1.svg" alt="img"></a>
            <a href="#." target="_blank" data-no-swup class="sb-download-btn"><img src="<?= base_url() ?>front/img/buttons/2.svg" alt="img"></a>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="sb-illustration-3">
            <img src="<?= base_url() ?>front/img/illustrations/phones.png" alt="phones" class="sb-phones">
            <div class="sb-cirkle-1"></div>
            <div class="sb-cirkle-2"></div>
            <div class="sb-cirkle-3"></div>
            <div class="sb-cirkle-4"></div>
            <img src="<?= base_url() ?>front/img/illustrations/1.svg" alt="phones" class="sb-pik-1">
            <img src="<?= base_url() ?>front/img/illustrations/2.svg" alt="phones" class="sb-pik-2">
            <img src="<?= base_url() ?>front/img/illustrations/3.svg" alt="phones" class="sb-pik-3">
          </div>
        </div>
      </div>
    </div>
  </section> -->
</div>
<?= $this->endsection() ?>