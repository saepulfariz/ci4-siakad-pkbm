<?= $this->extend('template/index') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">New Assignment Submission</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                    <li class="breadcrumb-item">Data <?= $title; ?></li>
                    <li class="breadcrumb-item active">New</li>
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
                                <label for="assignment_id">Assignment</label>
                                <select type="text" class="form-control <?= ($error = validation_show_error('assignment_id')) ? 'border-danger' : ((old('assignment_id')) ? 'border-success' : ''); ?> " value="<?= old('assignment_id'); ?>" id="assignment_id" name="assignment_id">
                                    <?php foreach ($assignments as $assignment): ?>
                                        <?php if (old('assignment_id')): ?>
                                            <?php if (old('assignment_id') == $assignment->id): ?>
                                                <option selected value="<?= $assignment->id; ?>"><?= $assignment->title; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $assignment->id; ?>"><?= $assignment->title; ?></option>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <option value="<?= $assignment->id; ?>"><?= $assignment->title; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('assignment_id')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>


                            <div class="form-group">
                                <label for="student_id">Student</label>
                                <select type="text" class="form-control <?= ($error = validation_show_error('student_id')) ? 'border-danger' : ((old('student_id')) ? 'border-success' : ''); ?> " value="<?= old('student_id'); ?>" id="student_id" name="student_id">
                                    <?php foreach ($students as $student): ?>
                                        <?php if (old('student_id')): ?>
                                            <?php if (old('student_id') == $student->id): ?>
                                                <option selected value="<?= $student->id; ?>"><?= $student->full_name; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $student->id; ?>"><?= $student->full_name; ?></option>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <option value="<?= $student->id; ?>"><?= $student->full_name; ?></option>
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
                                <label for="description">Description</label>
                                <textarea class="form-control <?= ($error = validation_show_error('description')) ? 'border-danger' : ((old('description')) ? 'border-success' : ''); ?>" id="description" name="description" placeholder="Description"><?= old('description'); ?></textarea>

                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('description')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>



                            <div class="form-group">
                                <label for="file">File</label>
                                <input type="text" class="form-control <?= ($error = validation_show_error('file')) ? 'border-danger' : ((old('file')) ? 'border-success' : ''); ?>" id="file" name="file" placeholder="file" value="<?= old('file'); ?>">
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('file')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>



                            <div class="form-group">
                                <label for="score">Score</label>
                                <input type="number" step="0.01" class="form-control <?= ($error = validation_show_error('score')) ? 'border-danger' : ((old('score')) ? 'border-success' : ''); ?>" id="score" name="score" placeholder="score" value="<?= old('score'); ?>">
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('score')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>

                            <div class="form-group">
                                <label for="feedback">Feedback</label>
                                <textarea class="form-control <?= ($error = validation_show_error('feedback')) ? 'border-danger' : ((old('feedback')) ? 'border-success' : ''); ?>" id="feedback" name="feedback" placeholder="Feedback"><?= old('feedback'); ?></textarea>

                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('feedback')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>


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