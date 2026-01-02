<?= $this->extend('template/index') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Show Notification</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                    <li class="breadcrumb-item">Data <?= $title; ?></li>
                    <li class="breadcrumb-item active">Show</li>
                </ol>
            </div>
            <!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 ">

                <!-- Notification Detail -->
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-bell"></i>
                            Show Notifikasi
                        </h3>
                    </div>

                    <div class="card-body">
                        <h4 class="mb-2">
                            <?= esc($notification->title) ?>
                        </h4>

                        <p class="text-muted mb-3">
                            <i class="far fa-clock"></i>
                            <?= date('d M Y H:i', strtotime($notification->created_at)) ?>
                        </p>

                        <hr>

                        <div class="notification-message">
                            <?= nl2br(esc($notification->message)) ?>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <a href="<?= base_url($link) ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<?= $this->endSection('content') ?>