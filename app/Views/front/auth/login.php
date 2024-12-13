<?php $this->extend('layout/front_auth'); ?>

<?php $this->section('styles'); ?>
<style>
    /* Full viewport height */
    body,
    html {
        height: 100%;
        margin: 0;
    }

    /* Main container fills the full height */
    .register-container {
        height: 100%;
        display: flex;
    }

    /* Left column with image */
    .register-left {
        position: relative;
        width: 50%;
        height: 100%;
    }

    .register-left img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(70%);
        /* Dims the image slightly */
    }

    /* Overlay content (title and list) */
    .overlay-content {
        position: absolute;
        top: 20px;
        left: 20px;
        color: white;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.8);
    }

    .overlay-content h2 {
        margin-bottom: 10px;
        font-size: 28px;
        font-weight: bold;
    }

    .overlay-content ul {
        list-style-type: disc;
        padding-left: 20px;
    }

    .overlay-content ul li {
        font-size: 16px;
        line-height: 1.5;
    }

    /* Right column with form */
    .register-right {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px;
        background-color: white;
        width: 50%;
    }

    /* Form styling */
    .login-form {
        width: 100%;
        max-width: 400px;
    }

    .form-label {
        font-weight: bold;
    }

    .btn-login {
        width: 100%;
    }
</style>
<?php $this->endsection(); ?>

<?php $this->section('content'); ?>
<div class="register-container">
    <!-- Left Column (Image) -->
    <div class="register-left">
        <img src="<?= base_url('front/img/auth/background.png') ?>" alt="Placeholder Image">
        <!-- Overlay Content -->
        <div class="overlay-content">
            <h2><em>Puaskan Selera Anda</em></h2>
            <ul>
                <li>Jelajahi baragam kuliner lezat</li>
                <li>Temukan hidangan lezat cepat</li>
                <li>Terhubung dengan kuliner makanan ternama di Pekanbaru</li>
            </ul>
        </div>
    </div>

    <!-- Right Column (Form) -->
    <div class="register-right">
        <form id="login-form" class="login-form">
            <h2 class="mb-3">Masuk dengan akun anda</h2>
            <p class="mb-4">Apakah anda tidak memiliki akun? <a href="<?= route_to('front.auth.register') ?>"><strong style="text-decoration: underline;">Daftar</strong></a></p>
            <!-- Email Field -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control py-4" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <!-- Password Field -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control py-4" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <!-- Register Button -->
            <button type="submit" class="btn btn-primary btn-login">Masuk</button>
        </form>
    </div>
</div>
<?php $this->endsection(); ?>
<?php $this->section('scripts'); ?>
<script>
    $(function () {
        $('#login-form').on('submit', function (event) {
            event.preventDefault();
            var form = $(this);
            var btn = form.find('.btn-login');
            var htm = btn.html();
            setLoadingBtn(btn);
            $.ajax({
                url: '<?= route_to('front.auth.storeAuth'); ?>',
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