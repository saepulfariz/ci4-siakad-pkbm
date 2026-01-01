<?= $this->extend('template/index') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">New Material</h1>
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
                                <label for="class_id">Class</label>
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
                                <label for="subject_id">Subject</label>
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
                                <label for="title">Title</label>
                                <input type="text" class="form-control <?= ($error = validation_show_error('title')) ? 'border-danger' : ((old('title')) ? 'border-success' : ''); ?>" id="title" name="title" placeholder="Title" value="<?= old('title'); ?>">
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('title')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>


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