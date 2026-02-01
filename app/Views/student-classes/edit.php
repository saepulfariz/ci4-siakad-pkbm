<?= $this->extend('template/index') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= temp_lang('app.edit'); ?> <?= temp_lang('student_classes.student_class'); ?></h1>
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
        <form action="<?= base_url($link . '/' . esc($student_class->id)); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type='hidden' name='_method' value='PUT' />
            <div class="row">
                <div class="col-12 col-xl-4">
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="semester_id"><?= temp_lang('semesters.semester'); ?></label>
                                <select type="text" class="form-control <?= ($error = validation_show_error('semester_id')) ? 'border-danger' : ((old('semester_id')) ? 'border-success' : ''); ?> " value="<?= old('semester_id'); ?>" id="semester_id" name="semester_id">
                                    <?php foreach ($semesters as $semester): ?>
                                        <?php $active = ($semester->is_active) ? '(' . temp_lang('semesters.active') . ')' : '' ?>
                                        <?php if (old('semester_id')): ?>
                                            <?php if (old('semester_id') == $semester->id): ?>
                                                <option selected value="<?= $semester->id; ?>"><?= $semester->name; ?> - <?= $semester->academic_year_name; ?> <?= $active; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $semester->id; ?>"><?= $semester->name; ?> - <?= $semester->academic_year_name; ?> <?= $active; ?></option>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if ($student_class->semester_id == $semester->id): ?>
                                                <option selected value="<?= $semester->id; ?>"><?= $semester->name; ?> - <?= $semester->academic_year_name; ?> <?= $active; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $semester->id; ?>"><?= $semester->name; ?> - <?= $semester->academic_year_name; ?> <?= $active; ?></option>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('semester_id')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>


                            <div class="form-group">
                                <label for="student_id"><?= temp_lang('students.student'); ?></label>
                                <select type="text" class="form-control <?= ($error = validation_show_error('student_id')) ? 'border-danger' : ((old('student_id')) ? 'border-success' : ''); ?> " value="<?= old('student_id'); ?>" id="student_id" name="student_id">
                                    <?php foreach ($students as $student): ?>
                                        <?php if (old('student_id')): ?>
                                            <?php if (old('student_id') == $student->id): ?>
                                                <option selected value="<?= $student->id; ?>"><?= $student->full_name; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $student->id; ?>"><?= $student->full_name; ?></option>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if (esc($student_class->student_id) == $student->id): ?>
                                                <option selected value="<?= $student->id; ?>"><?= $student->full_name; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $student->id; ?>"><?= $student->full_name; ?></option>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('student_id')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>



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
                                            <?php if (esc($student_class->class_id) == $dt_class->id): ?>
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