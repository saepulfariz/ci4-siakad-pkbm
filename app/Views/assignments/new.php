<?= $this->extend('template/index') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= temp_lang('app.new'); ?> <?= temp_lang('assignments.assignment'); ?></h1>
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

                            <?php if (auth()->user()->can('assignments.access-all')): ?>

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
                                                <option value="<?= $semester->id; ?>"><?= $semester->name; ?> - <?= $semester->academic_year_name; ?> <?= $active; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                                <?= (old('semester_id')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>


                            <?php endif; ?>

                            <div class="form-group">
                                <label for="class_id"><?= temp_lang('classes.class'); ?></label>
                                <select type="text" class="form-control <?= ($error = validation_show_error('class_id')) ? 'border-danger' : ((old('class_id')) ? 'border-success' : ''); ?> " value="<?= old('class_id'); ?>" id="class_id" name="class_id">
                                    <?php foreach ($classes as $class): ?>
                                        <?php if (old('class_id')): ?>
                                            <?php if (old('class_id') == $class->id): ?>
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
                            <?= (old('class_id')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>


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
                                            <option value="<?= $subject->id; ?>"><?= $subject->name; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('subject_id')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>


                            <div class="form-group">
                                <label for="teacher_id"><?= temp_lang('teachers.teacher'); ?></label>
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
                            <?= (old('teacher_id')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>





                        </div>
                    </div>
                </div>


                <div class="col-12 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title"><?= temp_lang('assignments.title'); ?></label>
                                <input type="text" class="form-control <?= ($error = validation_show_error('title')) ? 'border-danger' : ((old('title')) ? 'border-success' : ''); ?>" id="title" name="title" placeholder="<?= temp_lang('assignments.title'); ?>" value="<?= old('title'); ?>">
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('title')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>


                            <div class="form-group">
                                <label for="description"><?= temp_lang('assignments.description'); ?></label>
                                <textarea class="form-control <?= ($error = validation_show_error('description')) ? 'border-danger' : ((old('description')) ? 'border-success' : ''); ?>" id="description" name="description" placeholder="<?= temp_lang('assignments.description'); ?>"><?= old('description'); ?></textarea>

                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('description')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>



                            <div class="form-group">
                                <label><?= temp_lang('assignments.choose_file_or_link'); ?></label>
                                <select id="mode" class="form-control">
                                    <option value="upload"><?= temp_lang('assignments.upload_file'); ?></option>
                                    <option value="link">Link</option>
                                </select>
                            </div>

                            <div id="upload_field">
                                <div class="form-group">
                                    <label><?= temp_lang('assignments.upload_file'); ?></label>
                                    <input type="file" name="file_upload" class="form-control <?= ($error = validation_show_error('file_upload')) ? 'border-danger' : ((old('file_upload')) ? 'border-success' : ''); ?>"
                                        accept=".pdf,.doc,.docx,.ppt,.pptx,.jpg,.jpeg,.png">
                                </div>
                                <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                                <?= (old('file_upload')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>
                            </div>

                            <div class="d-none" id="link_field">
                                <div class="form-group">
                                    <label>Link File</label>
                                    <input type="text" name="file_link" class="form-control <?= ($error = validation_show_error('file_link')) ? 'border-danger' : ((old('file_link')) ? 'border-success' : ''); ?>">
                                </div>
                                <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                                <?= (old('file_link')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>
                            </div>

                            <div class="form-group">
                                <label for="deadline"><?= temp_lang('assignments.deadline'); ?></label>
                                <input type="datetime-local" class="form-control <?= ($error = validation_show_error('deadline')) ? 'border-danger' : ((old('deadline')) ? 'border-success' : ''); ?>" id="deadline" name="deadline" placeholder="<?= temp_lang('assignments.deadline'); ?>" value="<?= old('deadline'); ?>">
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('deadline')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>


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

<?= $this->section('script') ?>
<script>
    $('#mode').change(function() {
        if ($(this).val() === 'upload') {
            $('#upload_field').removeClass('d-none');
            $('#link_field').addClass('d-none');
        } else {
            $('#upload_field').addClass('d-none');
            $('#link_field').removeClass('d-none');
        }
    });
</script>
<?= $this->endSection('script') ?>