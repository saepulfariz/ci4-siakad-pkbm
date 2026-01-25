<?= $this->extend('template/index') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= temp_lang('app.edit'); ?> <?= temp_lang('assignment_submissions.assignment_submission'); ?></h1>
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
        <?php

        $check_teacher = auth()->user()->inGroup('teacher');
        $check_superadmin = auth()->user()->inGroup('superadmin');

        ?>
        <!-- Small boxes (Stat box) -->
        <form action="<?= base_url($link . '/' . esc($assignment_submission->id)); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type='hidden' name='_method' value='PUT' />
            <div class="row">
                <div class="col-12 col-xl-4">
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="assignment_id"><?= temp_lang('assignments.assignment'); ?></label>
                                <select type="text" class="form-control <?= ($error = validation_show_error('assignment_id')) ? 'border-danger' : ((old('assignment_id')) ? 'border-success' : ''); ?> " value="<?= old('assignment_id'); ?>" id="assignment_id" name="assignment_id">
                                    <?php foreach ($assignments as $assignment): ?>
                                        <?php if (old('assignment_id')): ?>
                                            <?php if (old('assignment_id') == $assignment->id): ?>
                                                <option selected value="<?= $assignment->id; ?>"><?= $assignment->title; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $assignment->id; ?>"><?= $assignment->title; ?></option>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if (esc($assignment_submission->assignment_id) == $assignment->id): ?>
                                                <option selected value="<?= $assignment->id; ?>"><?= $assignment->title; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $assignment->id; ?>"><?= $assignment->title; ?></option>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('assignment_id')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>

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
                                            <?php if (esc($assignment_submission->student_id) == $student->id): ?>
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




                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-4">
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="description"><?= temp_lang('assignment_submissions.description'); ?></label>
                                <textarea class="form-control <?= ($error = validation_show_error('description')) ? 'border-danger' : ((old('description')) ? 'border-success' : ''); ?>" id="description" name="description" placeholder="<?= temp_lang('assignment_submissions.description'); ?>"><?= old('description', esc($assignment_submission->description)); ?></textarea>

                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('description')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>



                            <div class="alert alert-info">
                                <?= temp_lang('assignment_submissions.file_current'); ?>
                                <?php if (filter_var($assignment->file, FILTER_VALIDATE_URL)): ?>
                                    <a href="<?= $assignment->file ?>" target="_blank">Link</a>
                                <?php else: ?>
                                    <a href="<?= asset_url(); ?>uploads/assignment_submissions/<?= $assignment->file ?>" target="_blank">File</a>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label><?= temp_lang('assignment_submissions.change_file_optional'); ?></label>
                                <input type="file" name="file_upload" class="form-control"
                                    accept=".pdf,.doc,.docx,.ppt,.pptx,.jpg,.jpeg,.png">
                            </div>

                            <div class="form-group">
                                <label><?= temp_lang('assignment_submissions.change_link_optional'); ?></label>
                                <input type="text" name="file_link" class="form-control">
                            </div>



                            <?php if ($check_teacher || $check_superadmin): ?>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select type="text" class="form-control <?= ($error = validation_show_error('status')) ? 'border-danger' : ((old('status')) ? 'border-success' : ''); ?> " value="<?= old('status'); ?>" id="status" name="status">
                                        <?php foreach ($status as $st): ?>
                                            <?php if (old('status')): ?>
                                                <?php if (old('status') == $st['id']): ?>
                                                    <option selected value="<?= $st['id']; ?>"><?= temp_lang('assignment_submissions.status_' . strtolower($st['name'])); ?></option>
                                                <?php else: ?>
                                                    <option value="<?= $st['id']; ?>"><?= temp_lang('assignment_submissions.status_' . strtolower($st['name'])); ?></option>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php if (esc($assignment_submission->status) == $st['id']): ?>
                                                    <option selected value="<?= $st['id']; ?>"><?= temp_lang('assignment_submissions.status_' . strtolower($st['name'])); ?></option>
                                                <?php else: ?>
                                                    <option value="<?= $st['id']; ?>"><?= temp_lang('assignment_submissions.status_' . strtolower($st['name'])); ?></option>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                                <?= (old('status')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>

                                <div class="form-group">
                                    <label for="score"><?= temp_lang('assignment_submissions.score'); ?></label>
                                    <input type="text" class="form-control <?= ($error = validation_show_error('score')) ? 'border-danger' : ((old('score')) ? 'border-success' : ''); ?>" id="score" name="score" placeholder="<?= temp_lang('assignment_submissions.score'); ?>" value="<?= old('score', esc($assignment_submission->score)); ?>">
                                </div>
                                <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                                <?= (old('score')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>


                                <div class="form-group">
                                    <label for="feedback"><?= temp_lang('assignment_submissions.feedback'); ?></label>
                                    <textarea class="form-control <?= ($error = validation_show_error('feedback')) ? 'border-danger' : ((old('feedback')) ? 'border-success' : ''); ?>" id="feedback" name="feedback" placeholder="<?= temp_lang('assignment_submissions.feedback'); ?>"><?= old('feedback', esc($assignment_submission->feedback)); ?></textarea>

                                </div>
                                <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                                <?= (old('feedback')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>


                            <?php endif; ?>



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