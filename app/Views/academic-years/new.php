<?= $this->extend('template/index') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= temp_lang('app.new'); ?> <?= temp_lang('academic_years.academic_year'); ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                    <li class="breadcrumb-item">Data <?= $title; ?></li>
                    <li class="breadcrumb-item active"><?= temp_lang('app.new'); ?></li>
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
        <!-- Small boxes (Stat box) -->
        <form action="<?= base_url($link); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="row">
                <div class="col-12 col-xl-4">
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="name"><?= temp_lang('academic_years.name'); ?> <small class="fw-weight-bold text-danger"><b>*</b></small></label>
                                <input type="text" class="form-control <?= ($error = validation_show_error('name')) ? 'border-danger' : ((old('name')) ? 'border-success' : ''); ?>" id="name" name="name" placeholder="<?= date('Y'); ?>/<?= date('Y', strtotime('+1 Years')); ?>" value="<?= old('name'); ?>">
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('name')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>

                            <div class="form-group">
                                <label for="start_year"><?= temp_lang('academic_years.start_year'); ?></label>
                                <input type="number" class="form-control <?= ($error = validation_show_error('start_year')) ? 'border-danger' : ((old('start_year')) ? 'border-success' : ''); ?>" id="start_year" name="start_year" placeholder="<?= date('Y'); ?>" value="<?= old('start_year'); ?>">
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('start_year')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>

                            <div class="form-group">
                                <label for="end_year"><?= temp_lang('academic_years.end_year'); ?></label>
                                <input type="number" class="form-control <?= ($error = validation_show_error('end_year')) ? 'border-danger' : ((old('end_year')) ? 'border-success' : ''); ?>" id="end_year" name="end_year" placeholder="<?= date('Y', strtotime('+1 Years')); ?>" value="<?= old('end_year'); ?>">
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('end_year')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>


                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?= base_url($link); ?>" class="btn btn-secondary"><?= temp_lang('app.cancel'); ?></a>


                        </div>
                    </div>
                </div>

            </div>
        </form>


    </div>
</section>
<?= $this->endSection('content') ?>