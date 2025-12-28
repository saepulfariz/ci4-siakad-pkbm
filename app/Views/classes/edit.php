<?= $this->extend('template/index') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Class</h1>
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
        <form action="<?= base_url($link . '/' . $class->id); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type='hidden' name='_method' value='PUT' />
            <div class="row">
                <div class="col-12 col-xl-4">
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="parent_id">Parent Class</label>
                                <select type="text" class="form-control <?= ($error = validation_show_error('parent_id')) ? 'border-danger' : ((old('parent_id')) ? 'border-success' : ''); ?> " value="<?= old('parent_id'); ?>" id="parent_id" name="parent_id">
                                    <option value="">== PARENT ==</option>
                                    <?php foreach ($classes as $dt_class): ?>
                                        <?php if (old('parent_id')): ?>
                                            <?php if (old('parent_id') == $dt_class->id): ?>
                                                <option selected value="<?= $dt_class->id; ?>"><?= $dt_class->name; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $dt_class->id; ?>"><?= $dt_class->name; ?></option>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if ($class->parent_id == $dt_class->id): ?>
                                                <option selected value="<?= $dt_class->id; ?>"><?= $dt_class->name; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $dt_class->id; ?>"><?= $dt_class->name; ?></option>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('parent_id')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>



                            <div class="form-group">
                                <label for="name">Name <small class="fw-weight-bold text-danger"><b>*</b></small></label>
                                <input type="text" class="form-control <?= ($error = validation_show_error('name')) ? 'border-danger' : ((old('name')) ? 'border-success' : ''); ?>" id="name" name="name" placeholder="name" value="<?= old('name', $class->name); ?>">
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('name')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>

                            <div class="form-group">
                                <label for="teacher_id">Teacher</label>
                                <select type="text" class="form-control <?= ($error = validation_show_error('teacher_id')) ? 'border-danger' : ((old('teacher_id')) ? 'border-success' : ''); ?> " value="<?= old('teacher_id'); ?>" id="teacher_id" name="teacher_id">
                                    <?php foreach ($teachers as $teacher): ?>
                                        <?php if (old('teacher_id')): ?>
                                            <?php if (old('teacher_id') == $teacher->id): ?>
                                                <option selected value="<?= $teacher->id; ?>"><?= $teacher->full_name; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $teacher->id; ?>"><?= $teacher->full_name; ?></option>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if ($teacher->teacher_id == $teacher->id): ?>
                                                <option selected value="<?= $teacher->id; ?>"><?= $teacher->full_name; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $teacher->id; ?>"><?= $teacher->full_name; ?></option>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('teacher_id')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>


                            <div class="form-group">
                                <label for="education_id">Education</label>
                                <select type="text" class="form-control <?= ($error = validation_show_error('education_id')) ? 'border-danger' : ((old('education_id')) ? 'border-success' : ''); ?> " value="<?= old('education_id'); ?>" id="education_id" name="education_id">
                                    <?php foreach ($educations as $education): ?>
                                        <?php if (old('education_id')): ?>
                                            <?php if (old('education_id') == $education->id): ?>
                                                <option selected value="<?= $education->id; ?>"><?= $education->name; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $education->id; ?>"><?= $education->name; ?></option>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if ($education->education_id == $education->id): ?>
                                                <option selected value="<?= $education->id; ?>"><?= $education->name; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $education->id; ?>"><?= $education->name; ?></option>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('education_id')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>


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