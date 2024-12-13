<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- color of address bar in mobile browser -->
    <meta name="theme-color" content="#F5C332">
    <!-- favicon  -->
    <link rel="shortcut icon" href="<?= base_url() ?>front/img/logo-foodpath.png" type="image/x-icon">
    <!-- font awesome css -->
    <link rel="stylesheet" href="<?= base_url() ?>front/css/plugins/font-awesome.min.css">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="<?= base_url() ?>front/css/plugins/bootstrap.min.css">
    <!-- swiper css -->
    <link rel="stylesheet" href="<?= base_url() ?>front/css/plugins/swiper.min.css">
    <!-- datepicker css -->
    <link rel="stylesheet" href="<?= base_url() ?>front/css/plugins/datepicker.css">
    <!-- mapbox css -->
    <link href="<?= base_url() ?>front/css/plugins/mapbox-style.css" rel='stylesheet'>
    <!-- fancybox css -->
    <link rel="stylesheet" href="<?= base_url() ?>front/css/plugins/fancybox.min.css">
    <!-- starbelly css -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin="" />
    <link rel="stylesheet" href="<?= base_url() ?>front/css/style.css">
    <!-- Toastr css -->
    <link rel="stylesheet" href="<?php echo base_url() ?>back/plugins/toastr/toastr.min.css">
    <?= $this->renderSection('styles') ?>
    <!-- page title -->
    <title>FoodPath.PKU</title>
</head>

<body>
    <div class="sb-app">
        <!-- preloader -->
        <div class="sb-preloader">
            <div class="sb-preloader-bg"></div>
            <div class="sb-preloader-body">
                <div class="sb-loading">
                    <div class="sb-percent"><span class="sb-preloader-number" data-count="101">00</span><span>%</span></div>
                </div>
                <div class="sb-loading-bar">
                    <div class="sb-bar"></div>
                </div>
            </div>
        </div>
        <!-- preloader end -->
        <!-- click effect -->
        <div class="sb-click-effect"></div>
        <!-- loader -->
        <div class="sb-load"></div>
        <!-- top bar -->
        <?= $this->include('layout/front_header') ?>
        <?= $this->renderSection('content') ?>

        <footer>
            <div class="container">
                <div class="sb-footer-frame">
                    <a href="home-1.html" class="sb-logo-frame">
                        <!-- logo img -->
                        <img src="<?= base_url() ?>front/img/ui/logo.png" alt="Starbelly">
                    </a>
                    <ul class="sb-social">
                        <li><a href="#."><i class="far fa-circle"></i></a></li>
                        <li><a href="#."><i class="far fa-circle"></i></a></li>
                        <li><a href="#."><i class="far fa-circle"></i></a></li>
                        <li><a href="#."><i class="far fa-circle"></i></a></li>
                    </ul>
                    <div class="sb-copy">&copy; 2024 FoodPathPKU. All Rights Reserved.</div>
                </div>
            </div>
        </footer>
    </div>


    <!-- jquery js -->
    <script src="<?= base_url() ?>front/js/plugins/jquery.min.js"></script>
    <!-- smooth scroll js -->
    <script src="<?= base_url() ?>front/js/plugins/smooth-scroll.js"></script>
    <!-- swup js -->
    <script src="<?= base_url() ?>front/js/plugins/swup.min.js"></script>
    <!-- swiper js -->
    <script src="<?= base_url() ?>front/js/plugins/swiper.min.js"></script>
    <!-- datepicker js -->
    <script src="<?= base_url() ?>front/js/plugins/datepicker.js"></script>
    <!-- isotope js -->
    <script src="<?= base_url() ?>front/js/plugins/isotope.js"></script>
    <!-- sticky -->
    <script src="<?= base_url() ?>front/js/plugins/sticky.js"></script>
    <!-- mapbox js -->
    <script src="<?= base_url() ?>front/js/plugins/mapbox.min.js"></script>
    <!-- fancybox js -->
    <script src="<?= base_url() ?>front/js/plugins/fancybox.min.js"></script>
    <!-- Toastr js -->
    <script src="<?php echo base_url() ?>back/plugins/toastr/toastr.min.js"></script>
    <!-- starbelly js -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
    <script src="<?= base_url() ?>front/js/main.js"></script>

    <script src="<?php echo base_url() ?>back/js/base.js"></script>
    <script>
        var base_url = '<?php echo base_url(); ?>';
    </script>
    <?= $this->renderSection('scripts') ?>
</body>