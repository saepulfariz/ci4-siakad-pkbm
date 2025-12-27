<?= $this->extend('template/index') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Semester</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                    <li class="breadcrumb-item">Data <?= $title; ?></li>
                    <li class="breadcrumb-item active">Edit</li>
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
        <form action="<?= base_url($link . '/' . $semester->id); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type='hidden' name='_method' value='PUT' />
            <div class="row">
                <div class="col-12 col-xl-4">
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="academic_year_id">Academic</label>
                                <select type="text" class="form-control <?= ($error = validation_show_error('academic_year_id')) ? 'border-danger' : ((old('academic_year_id')) ? 'border-success' : ''); ?> " value="<?= old('academic_year_id'); ?>" id="academic_year_id" name="academic_year_id">
                                    <?php foreach ($academic_years as $academic): ?>
                                        <?php if (old('academic_year_id')): ?>
                                            <?php if (old('academic_year_id') == $academic->id): ?>
                                                <option selected value="<?= $academic->id; ?>"><?= $academic->name; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $academic->id; ?>"><?= $academic->name; ?></option>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if ($semester->academic_year_id == $academic->id): ?>
                                                <option selected value="<?= $academic->id; ?>"><?= $academic->name; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $academic->id; ?>"><?= $academic->name; ?></option>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('academic_year_id')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>



                            <div class="form-group">
                                <label for="name">Name <small class="fw-weight-bold text-danger"><b>*</b></small></label>
                                <input type="text" class="form-control <?= ($error = validation_show_error('name')) ? 'border-danger' : ((old('name')) ? 'border-success' : ''); ?>" id="name" name="name" placeholder="name" value="<?= old('name', $semester->name); ?>">
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('name')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>

                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" class="form-control <?= ($error = validation_show_error('start_date')) ? 'border-danger' : ((old('start_date')) ? 'border-success' : ''); ?>" id="start_date" name="start_date" placeholder="<?= date('Y'); ?>" value="<?= old('start_date', $semester->start_date); ?>">
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('start_date')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>

                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" class="form-control <?= ($error = validation_show_error('end_date')) ? 'border-danger' : ((old('end_date')) ? 'border-success' : ''); ?>" id="end_date" name="end_date" placeholder="<?= date('Y'); ?>" value="<?= old('end_date', $semester->end_date); ?>">
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('end_date')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>


                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?= base_url($link); ?>" class="btn btn-secondary">Cancel</a>

                        </div>
                    </div>
                </div>

            </div>
        </form>


    </div>
</section>
<?= $this->endSection('content') ?>