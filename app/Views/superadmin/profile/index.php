<?= $this->extend('template/index') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Profile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div>
            <!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <form method="post" action="<?= base_url('profile'); ?>">
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <?php if (session()->getFlashdata('success')) : ?>
                                <div class="alert alert-success">
                                    <?= session()->getFlashdata('success') ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if (session()->getFlashdata('error')) : ?>
                                <div class="alert alert-danger">
                                    <?= session()->getFlashdata('error') ?>
                                </div>
                            <?php endif; ?>

                            <?= csrf_field(); ?>
                            <input type='hidden' name='_method' value='PUT' />
                            
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control <?= ($error = validation_show_error('name')) ? 'is-invalid' : ((old('name')) ? 'is-valid' : ''); ?>" id="name" name="name" type="text" placeholder="Enter your name" value="<?= old('name', $profile->name ?? '') ?>">
                                <?= ($error) ? '<div class="error text-danger mb-2">' . $error . '</div>' : ''; ?>
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input class="form-control <?= ($error = validation_show_error('email')) ? 'is-invalid' : ((old('email')) ? 'is-valid' : ''); ?>" id="email" name="email" type="email" placeholder="Enter your email" value="<?= old('email', $profile->email ?? '') ?>">
                                <?= ($error) ? '<div class="error text-danger mb-2">' . $error . '</div>' : ''; ?>
                            </div>

                            <div class="mt-3">
                                <button class="btn btn-primary" type="submit">Update Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<?= $this->endSection('content') ?>
