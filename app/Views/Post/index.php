<?= $this->extend('layout/front_main') ?>
<?= $this->section('content') ?>
<div id="sb-dynamic-content" class="sb-transition-fade">

    <!-- banner -->
    <section class="sb-banner sb-banner-xs sb-banner-color">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- main title -->
                    <div class="sb-main-title-frame">
                        <div class="sb-main-title">
                            <h1 class="sb-h2">User Post</h1>
                            <ul class="sb-breadcrumbs">
                                <li><a href="home-1.html">Home</a></li>
                                <li><a href="#.">Post</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- main title end -->
                </div>
            </div>
        </div>
    </section>
    <!-- banner end -->

    <!-- blog list -->
    <section class="sb-blog-list sb-p-90-90">
        <div class="sb-bg-1">
            <div></div>
        </div>
        <div class="container" data-sticky-container>
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sb-mb-60">
                                <h2 class="sb-cate-title sb-mb-30">Latest <span>publications</span></h2>
                                <p class="sb-text">Consectetur numquam poro nemo veniam<br>eligendi rem adipisci quo modi.</p>
                            </div>
                        </div>
                    </div>
                    <div class="sb-masonry-grid">
                        <div class="sb-grid-sizer"></div>
                        <div class="sb-grid-item sb-item-50">
                            <a href="<?=base_url('post/slug')?>" class="sb-blog-card sb-mb-30">
                                <div class="sb-cover-frame sb-cover-vert sb-mb-30">
                                    <img src="<?=base_url()?>front/img/blog/3.jpg" alt="cover">
                                    <div class="sb-badge">New</div>
                                </div>
                                <div class="sb-blog-card-descr">
                                    <h3 class="sb-mb-10">Incredible Vegan Mac and Cheese</h3>
                                    <div class="sb-suptitle sb-mb-15"><span>17 Jul</span> <span>14:32</span> <span>Emma T.</span></div>
                                    <p class="sb-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero optio, sed expedita.</p>
                                </div>
                            </a>
                        </div>
                        <div class="sb-grid-item sb-item-50">
                            <a href="<?=base_url('post/slug')?>" class="sb-blog-card sb-mb-30">
                                <div class="sb-cover-frame sb-mb-30">
                                    <img src="<?=base_url()?>front/img/blog/2.jpg" alt="cover">
                                </div>
                                <div class="sb-blog-card-descr">
                                    <h3 class="sb-mb-10">Beet and Burrata Salad with Fried Bread</h3>
                                    <div class="sb-suptitle sb-mb-15"><span>17 Jul</span> <span>14:32</span> <span>Emma T.</span></div>
                                    <p class="sb-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero optio, sed expedita.</p>
                                </div>
                            </a>
                        </div>
                        <div class="sb-grid-item sb-item-50">
                            <a href="<?=base_url('post/slug')?>" class="sb-blog-card sb-mb-30">
                                <div class="sb-cover-frame sb-cover-vert sb-mb-30">
                                    <img src="<?=base_url()?>front/img/blog/1.jpg" alt="cover">
                                    <div class="sb-badge">Popular</div>
                                </div>
                                <div class="sb-blog-card-descr">
                                    <h3 class="sb-mb-10">Creamy Kale Pasta</h3>
                                    <div class="sb-suptitle sb-mb-15"><span>17 Jul</span> <span>14:32</span> <span>Emma T.</span></div>
                                    <p class="sb-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero optio, sed expedita.</p>
                                </div>
                            </a>
                        </div>
                        <div class="sb-grid-item sb-item-50">
                            <a href="<?=base_url('post/slug')?>" class="sb-blog-card sb-mb-30">
                                <div class="sb-cover-frame sb-mb-30">
                                    <img src="<?=base_url()?>front/img/blog/4.jpg" alt="cover">
                                    <div class="sb-badge">Popular</div>
                                </div>
                                <div class="sb-blog-card-descr">
                                    <h3 class="sb-mb-10">Join Us For Plant-Powered January!</h3>
                                    <div class="sb-suptitle sb-mb-15"><span>17 Jul</span> <span>14:32</span> <span>Emma T.</span></div>
                                    <p class="sb-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero optio, sed expedita.</p>
                                </div>
                            </a>
                        </div>
                        <div class="sb-grid-item sb-item-50">
                            <a href="<?=base_url('post/slug')?>" class="sb-blog-card sb-mb-30">
                                <div class="sb-cover-frame sb-mb-30">
                                    <img src="<?=base_url()?>front/img/blog/5.jpg" alt="cover">
                                </div>
                                <div class="sb-blog-card-descr">
                                    <h3 class="sb-mb-10">The Best Chicken Tinga Tacos</h3>
                                    <div class="sb-suptitle sb-mb-15"><span>17 Jul</span> <span>14:32</span> <span>Emma T.</span></div>
                                    <p class="sb-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero optio, sed expedita.</p>
                                </div>
                            </a>
                        </div>
                        <div class="sb-grid-item sb-item-50">
                            <a href="<?=base_url('post/slug')?>" class="sb-blog-card sb-mb-30">
                                <div class="sb-cover-frame sb-cover-vert sb-mb-30">
                                    <img src="<?=base_url()?>front/img/blog/6.jpg" alt="cover">
                                </div>
                                <div class="sb-blog-card-descr">
                                    <h3 class="sb-mb-10">Incredible Vegan Mac and Cheese</h3>
                                    <div class="sb-suptitle sb-mb-15"><span>17 Jul</span> <span>14:32</span> <span>Emma T.</span></div>
                                    <p class="sb-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero optio, sed expedita.</p>
                                </div>
                            </a>
                        </div>
                        <div class="sb-grid-item sb-item-50">
                            <a href="<?=base_url('post/slug')?>" class="sb-blog-card sb-mb-30">
                                <div class="sb-cover-frame sb-cover-vert sb-mb-30">
                                    <img src="<?=base_url()?>front/img/blog/3.jpg" alt="cover">
                                    <div class="sb-badge">Popular</div>
                                </div>
                                <div class="sb-blog-card-descr">
                                    <h3 class="sb-mb-10">Creamy Kale Pasta</h3>
                                    <div class="sb-suptitle sb-mb-15"><span>17 Jul</span> <span>14:32</span> <span>Emma T.</span></div>
                                    <p class="sb-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero optio, sed expedita.</p>
                                </div>
                            </a>
                        </div>
                        <div class="sb-grid-item sb-item-50">
                            <a href="<?=base_url('post/slug')?>" class="sb-blog-card sb-mb-30">
                                <div class="sb-cover-frame sb-mb-30">
                                    <img src="<?=base_url()?>front/img/blog/2.jpg" alt="cover">
                                </div>
                                <div class="sb-blog-card-descr">
                                    <h3 class="sb-mb-10">The Best Chicken Tinga Tacos</h3>
                                    <div class="sb-suptitle sb-mb-15"><span>17 Jul</span> <span>14:32</span> <span>Emma T.</span></div>
                                    <p class="sb-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero optio, sed expedita.</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sb-sidebar-frame sb-pad-type-1 sb-sticky" data-margin-top="120">
                        <div class="sb-sidebar">
                            <div class="sb-ib-title-frame sb-mb-30">
                                <h4>Search</h4><i class="fas fa-arrow-down"></i>
                            </div>
                            <form>
                                <div class="sb-group-input sb-group-with-btn">
                                    <input type="text" required>
                                    <span class="sb-bar"></span>
                                    <label>What you search?</label>
                                    <button type="submit"><img src="<?=base_url()?>front/img/ui/icons/search.svg" alt="search"></button>
                                </div>
                            </form>
                            <div class="sb-ib-title-frame sb-mb-30">
                                <h4>Categories</h4><i class="fas fa-arrow-down"></i>
                            </div>
                            <ul class="sb-list sb-mb-30">
                                <li><b><a href="#.">Sushi</a></b><span class="sb-number">12</span></li>
                                <li><b><a href="#.">Cafe</a></b><span class="sb-number">17</span></li>
                                <li><b><a href="#.">Martabak</a></b><span class="sb-number">33</span></li>
                                <li><b><a href="#.">Lainnya</a></b><span class="sb-number">99+</span></li>
                            </ul>
                            <div class="sb-ib-title-frame sb-mb-30">
                                <h4>Keywords</h4><i class="fas fa-arrow-down"></i>
                            </div>
                            <ul class="sb-keywords">
                                <li><a href="#.">Food</a></li>
                                <li><a href="#.">Drink</a></li>
                                <li><a href="#.">Restaurant</a></li>
                                <li><a href="#.">Eat</a></li>
                                <li><a href="#.">Rest</a></li>
                                <li><a href="#.">Caffe</a></li>
                                <li><a href="#.">Fast food</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <ul class="sb-pagination">
                    <li class="sb-active"><a href="#.">1</a></li>
                    <li><a href="#.">2</a></li>
                    <li><a href="#.">3</a></li>
                    <li><a href="#.">4</a></li>
                    <li><a href="#.">...</a></li>
                </ul>
            </div>
        </div>
    </section>
    <!-- blog list end -->

    <!-- popular -->
    <section class="sb-popular sb-sticky-stop sb-p-60-30">
        <div class="sb-bg-3">
        </div>
        <div class="container">
            <div class="sb-group-title sb-mb-30">
                <div class="sb-left sb-mb-30">
                    <h2 class="sb-mb-30">Most <span>popular</span> Publication</h2>
                    <p class="sb-text">Consectetur numquam poro nemo veniam<br>eligendi rem adipisci quo modi.</p>
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
                    <div class="swiper-slide">
                        <a href="<?=base_url('post/slug')?>" class="sb-blog-card sb-mb-30">
                            <div class="sb-cover-frame sb-mb-30">
                                <img src="<?=base_url()?>front/img/blog/1.jpg" alt="cover">
                                <div class="sb-badge">Popular</div>
                            </div>
                            <div class="sb-blog-card-descr">
                                <h3 class="sb-mb-10">Simple Homemade Tomato Soup</h3>
                                <div class="sb-suptitle sb-mb-15"><span>17 Jul</span> <span>14:32</span> <span>Emma T.</span></div>
                                <p class="sb-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero optio, sed expedita.</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="<?=base_url('post/slug')?>" class="sb-blog-card sb-mb-30">
                            <div class="sb-cover-frame sb-mb-30">
                                <img src="<?=base_url()?>front/img/blog/4.jpg" alt="cover">
                                <div class="sb-badge">Popular</div>
                            </div>
                            <div class="sb-blog-card-descr">
                                <h3 class="sb-mb-10">Thai Coconut Soup with Tofu and Rice</h3>
                                <div class="sb-suptitle sb-mb-15"><span>17 Jul</span> <span>14:32</span> <span>Emma T.</span></div>
                                <p class="sb-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero optio, sed expedita.</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="<?=base_url('post/slug')?>" class="sb-blog-card sb-mb-30">
                            <div class="sb-cover-frame sb-mb-30">
                                <img src="<?=base_url()?>front/img/blog/5.jpg" alt="cover">
                                <div class="sb-badge">Popular</div>
                            </div>
                            <div class="sb-blog-card-descr">
                                <h3 class="sb-mb-10">21 Things You Should Absolutely Be Buying at ALDI</h3>
                                <div class="sb-suptitle sb-mb-15"><span>17 Jul</span> <span>14:32</span> <span>Emma T.</span></div>
                                <p class="sb-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero optio, sed expedita.</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="<?=base_url('post/slug')?>" class="sb-blog-card sb-mb-30">
                            <div class="sb-cover-frame sb-mb-30">
                                <img src="<?=base_url()?>front/img/blog/6.jpg" alt="cover">
                                <div class="sb-badge">Popular</div>
                            </div>
                            <div class="sb-blog-card-descr">
                                <h3 class="sb-mb-10">Quinoa Sweet Potato Salad</h3>
                                <div class="sb-suptitle sb-mb-15"><span>17 Jul</span> <span>14:32</span> <span>Emma T.</span></div>
                                <p class="sb-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero optio, sed expedita.</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- popular end -->

</div>
<?= $this->endsection() ?>