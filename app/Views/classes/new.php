<?= $this->extend('template/index') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= temp_lang('app.new'); ?> <?= temp_lang('classes.class'); ?></h1>
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
                                <label for="parent_id"><?= temp_lang('classes.parent_ids'); ?></label>
                                <select type="text" class="form-control <?= ($error = validation_show_error('parent_id')) ? 'border-danger' : ((old('parent_id')) ? 'border-success' : ''); ?> " value="<?= old('parent_id'); ?>" id="parent_id" name="parent_id">
                                    <option value="">== <?= temp_lang('classes.parent_ids'); ?> == </option>
                                    <?php foreach ($classes as $class): ?>
                                        <?php if (old('parent_id')): ?>
                                            <?php if (old('parent_id') == $class->id): ?>
                                                <option selected value="<?= $class->id; ?>"><?= $class->name; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $class->id; ?>"><?= $class->name; ?></option>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <option value="<?= $class->id; ?>"><?= $class->name; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('parent_id') && !$error) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>


                            <div class="form-group">
                                <label for="name"><?= temp_lang('classes.name'); ?> <small class="fw-weight-bold text-danger"><b>*</b></small></label>
                                <input type="text" class="form-control <?= ($error = validation_show_error('name')) ? 'border-danger' : ((old('name')) ? 'border-success' : ''); ?>" id="name" name="name" placeholder="X" value="<?= old('name'); ?>">
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('name') && !$error) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>

                            <div class="form-group">
                                <label for="teacher_id"><?= temp_lang('classes.teacher_id'); ?></label>
                                <select type="text" class="form-control <?= ($error = validation_show_error('teacher_id')) ? 'border-danger' : ((old('teacher_id')) ? 'border-success' : ''); ?> " value="<?= old('teacher_id'); ?>" id="teacher_id" name="teacher_id">
                                    <?php foreach ($teachers as $teacher): ?>
                                        <?php if (old('teacher_id')): ?>
                                            <?php if (old('teacher_id') == $teacher->id): ?>
                                                <option selected value="<?= $teacher->id; ?>"><?= $teacher->full_name; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $teacher->id; ?>"><?= $teacher->full_name; ?></option>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <option value="<?= $teacher->id; ?>"><?= $teacher->full_name; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('teacher_id') && !$error) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>

                            <div class="form-group">
                                <label for="education_id"><?= temp_lang('educations.education'); ?></label>
                                <select type="text" class="form-control <?= ($error = validation_show_error('education_id')) ? 'border-danger' : ((old('education_id')) ? 'border-success' : ''); ?> " value="<?= old('education_id'); ?>" id="education_id" name="education_id">
                                    <?php foreach ($educations as $education): ?>
                                        <?php if (old('education_id')): ?>
                                            <?php if (old('education_id') == $education->id): ?>
                                                <option selected value="<?= $education->id; ?>"><?= $education->name; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $education->id; ?>"><?= $education->name; ?></option>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <option value="<?= $education->id; ?>"><?= $education->name; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('education_id') && !$error) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>


                            <button type="submit" class="btn btn-primary"><?= temp_lang('app.save'); ?></button>
                            <a href="<?= base_url($link); ?>" class="btn btn-secondary"><?= temp_lang('app.cancel'); ?></a>

                        </div>
                    </div>
                </div>

            </div>
        </form>


    </div>
</section>
<?= $this->endSection('content') ?>