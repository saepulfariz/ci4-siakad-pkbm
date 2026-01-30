<?= $this->extend('template/auth') ?>


<?= $this->section('title') ?><?= lang('Auth.login') ?> <?= $this->endSection() ?>


<?= $this->section('head') ?>
<style>
    body {
        height: 100vh;
    }

    .login-container {
        height: 100vh;
    }

    .left-side {
        background: url('<?= asset_url(); ?>assets/images/pkbm.webp') center center no-repeat;
        background-size: cover;
    }

    .brand {
        display: flex;
        align-items: center;
        margin-bottom: 30px;
    }

    .brand img {
        width: 70px;
        margin-right: 10px;
    }

    .brand-text h1 {
        margin: 0;
        font-size: 36px;
        font-weight: bold;
    }

    .brand-text small {
        font-size: 14px;
        color: #666;
    }
</style>

<style>
    /* Toggle Switch */
    .switch {
        position: relative;
        display: inline-block;
        width: 46px;
        height: 24px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 24px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked+.slider {
        background-color: #007bff;
    }

    input:checked+.slider:before {
        transform: translateX(22px);
    }
</style>
<?= $this->endSection('head') ?>

<?= $this->section('content') ?>

<body class="">
    <div class="container-fluid login-container">
        <div class="row h-100">

            <!-- KIRI (FOTO) -->
            <div class="col-md-8 left-side d-none d-md-block">
            </div>

            <!-- KANAN (FORM LOGIN) -->
            <div class="col-md-4 d-flex align-items-center justify-content-center">
                <div class="w-75">

                    <!-- LOGO + SIPENA -->
                    <div class="brand">
                        <img src="<?= asset_url(); ?>assets/images/logo.png" alt="Logo SIPENA">
                        <div class="brand-text">
                            <h1>SIPENA</h1>
                            <p class="m-0 p-0">Belajar Tertata, Nilai Terdata</p>
                        </div>
                    </div>

                    <h4 class="mb-4" style="font-weight: 600;">Selamat Datang</h4>

                    <!-- FORM LOGIN -->
                    <form action="<?= base_url('login'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email'); ?>">
                        </div>
                        <div class="mb-3 text-danger"><?= validation_show_error('email'); ?></div>

                        <div class="form-group">
                            <label for="password"><?= lang('Auth.password') ?></label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control" placeholder="<?= lang('Auth.password') ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                        👁
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 text-danger"><?= validation_show_error('password'); ?></div>

                        <div class="form-group d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <label class="switch mb-0">
                                    <input type="checkbox" <?php if (old('remember')): ?> checked<?php endif ?> name="remember" id="remember">
                                    <span class="slider"></span>
                                </label>
                                <span class="ml-2"> <?= lang('Auth.rememberMe') ?></span>
                            </div>

                            <a href="#" class="text-sm">Lupa Kata Sandi?</a>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">
                            <?= lang('Auth.login') ?>
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
    <?= $this->endSection('content') ?>

    <?= $this->section('script') ?>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            this.textContent = type === 'password' ? '👁' : '🙈';
        });
    </script>
    <?= $this->endSection('script') ?>