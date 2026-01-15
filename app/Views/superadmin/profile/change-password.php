<?= $this->extend('template/index') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Change Password</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                    <li class="breadcrumb-item">Data <?= $title; ?></li>
                    <li class="breadcrumb-item active">Change Password</li>
                </ol>
            </div>
            <!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <form method="post" action="<?= base_url('change-password'); ?>">
            <div class="row">
                <div class="col-md-5">
                    <div class="card ">
                        <div class="card-body">
                            <?= csrf_field(); ?>
                            <input type='hidden' name='_method' value='PUT' />
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input class="form-control <?= ($error = validation_show_error('current_password')) ? 'is-invalid' : ((old('current_password')) ? 'is-valid' : ''); ?>" id="current_password" name="current_password" type="password" placeholder="Enter your current password">
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('current_password') && !$error) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>

                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input class="form-control <?= ($error = validation_show_error('new_password')) ? 'is-invalid' : ((old('new_password')) ? 'is-valid' : ''); ?>" id="new_password" name="new_password" type="password" placeholder="Enter your new password">
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('new_password') && !$error) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>

                            <div class="form-group">
                                <label for="new_password_confirm">New Password Confirmation</label>
                                <input class="form-control <?= ($error = validation_show_error('new_password_confirm')) ? 'is-invalid' : ((old('new_password_confirm')) ? 'is-valid' : ''); ?>" id="new_password_confirm" name="new_password_confirm" type="password" placeholder="Enter your new password">
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('new_password_confirm') && !$error) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>

                            <div class="mt-3">
                                <button class="btn btn-primary" type="submit">Change</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<?= $this->endSection('content') ?>