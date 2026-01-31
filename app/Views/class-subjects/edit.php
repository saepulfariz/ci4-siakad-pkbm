<?= $this->extend('template/index') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= temp_lang('app.edit'); ?> <?= temp_lang('class_subjects.class_subject'); ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                    <li class="breadcrumb-item">Data <?= $title; ?></li>
                    <li class="breadcrumb-item active"><?= temp_lang('app.edit'); ?></li>
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
        <form action="<?= base_url($link . '/' . esc($class_subject->id)); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type='hidden' name='_method' value='PUT' />
            <div class="row">
                <div class="col-12 col-xl-4">
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="class_id"><?= temp_lang('classes.class'); ?></label>
                                <select type="text" class="form-control <?= ($error = validation_show_error('class_id')) ? 'border-danger' : ((old('class_id')) ? 'border-success' : ''); ?> " value="<?= old('class_id'); ?>" id="class_id" name="class_id">
                                    <?php foreach ($classes as $dt_class): ?>
                                        <?php if (old('class_id')): ?>
                                            <?php if (old('class_id') == $dt_class->id): ?>
                                                <option selected value="<?= $dt_class->id; ?>"><?= $dt_class->name; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $dt_class->id; ?>"><?= $dt_class->name; ?></option>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if (esc($class_subject->class_id) == $dt_class->id): ?>
                                                <option selected value="<?= $dt_class->id; ?>"><?= $dt_class->name; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $dt_class->id; ?>"><?= $dt_class->name; ?></option>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('class_id')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>
                            s


                            <div class="form-group">
                                <label for="subject_id"><?= temp_lang('subjects.subject'); ?></label>
                                <select type="text" class="form-control <?= ($error = validation_show_error('subject_id')) ? 'border-danger' : ((old('subject_id')) ? 'border-success' : ''); ?> " value="<?= old('subject_id'); ?>" id="subject_id" name="subject_id">
                                    <?php foreach ($subjects as $subject): ?>
                                        <?php if (old('subject_id')): ?>
                                            <?php if (old('subject_id') == $subject->id): ?>
                                                <option selected value="<?= $subject->id; ?>"><?= $subject->name; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $subject->id; ?>"><?= $subject->name; ?></option>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if (esc($class_subject->subject_id) == $subject->id): ?>
                                                <option selected value="<?= $subject->id; ?>"><?= $subject->name; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $subject->id; ?>"><?= $subject->name; ?></option>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('subject_id')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>


                            <button type="submit" class="btn btn-primary"><?= temp_lang('app.update'); ?></button>
                            <a href="<?= base_url($link); ?>" class="btn btn-secondary"><?= temp_lang('app.cancel'); ?></a>

                        </div>
                    </div>
                </div>

            </div>
        </form>


    </div>
</section>
<?= $this->endSection('content') ?>