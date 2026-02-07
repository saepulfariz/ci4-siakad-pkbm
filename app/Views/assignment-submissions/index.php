<?= $this->extend('template/index') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data <?= $title; ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                    <li class="breadcrumb-item">Data <?= $title; ?></li>
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
        <div class="row">
            <div class="col-12">
                <?php

                $can_create = auth()->user()->can('assignment-submissions.create');
                $can_edit = auth()->user()->can('assignment-submissions.edit');
                $can_delete = auth()->user()->can('assignment-submissions.delete');

                ?>
                <?php if ($can_create): ?>
                    <a href="<?= base_url($link . '/new'); ?>" class="btn btn-primary btn-sm mb-2"><?= temp_lang('app.new'); ?></a>
                <?php endif; ?>
                <div class="card">
                    <div class="card-body">
                        <table class="table" id="table2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= temp_lang('assignments.assignment'); ?></th>
                                    <th><?= temp_lang('students.student'); ?></th>
                                    <th><?= temp_lang('assignment_submissions.description'); ?></th>
                                    <th><?= temp_lang('assignment_submissions.file'); ?></th>
                                    <th><?= temp_lang('assignment_submissions.status'); ?></th>
                                    <th><?= temp_lang('assignment_submissions.score'); ?></th>
                                    <th><?= temp_lang('assignment_submissions.feedback'); ?></th>
                                    <th><?= temp_lang('app.action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a = 1;
                                foreach ($assignment_submissions as $submission): ?>
                                    <tr>
                                        <td><?= $a++; ?></td>
                                        <td><?= esc($submission->assignment_title); ?></td>
                                        <td><?= esc($submission->student_name); ?></td>
                                        <td><?= esc($submission->description); ?></td>
                                        <td>
                                            <?php if (esc($submission->file)): ?>

                                                <?php if (filter_var($submission->file, FILTER_VALIDATE_URL)): ?>
                                                    <a href="<?= esc($submission->file); ?>" target="_blank">Download</a>
                                                <?php else: ?>
                                                    <a href="<?= asset_url(); ?>uploads/assignment_submissions/<?= esc($submission->file); ?>" target="_blank">Download</a>
                                                <?php endif; ?>


                                            <?php endif; ?>
                                        </td>
                                        <td><?= temp_lang('assignment_submissions.status_' . strtolower(esc($submission->status))); ?></td>
                                        <td><?= esc($submission->score); ?></td>
                                        <td><?= esc($submission->feedback); ?></td>
                                        <td>
                                            <?php if ($can_edit): ?>
                                                <a class="btn btn-warning btn-sm mb-2" href="<?= base_url($link . '/' . esc($submission->id) . '/edit'); ?>"><i class="fas fa-edit"></i></a>
                                            <?php endif; ?>
                                            <?php if ($can_delete): ?>
                                                <form class="d-inline" action='<?= base_url($link . '/' . esc($submission->id)); ?>' method='post' enctype='multipart/form-data'>
                                                    <?= csrf_field(); ?>
                                                    <input type='hidden' name='_method' value='DELETE' />
                                                    <!-- GET, POST, PUT, PATCH, DELETE-->
                                                    <button type='button' data-ket="<?= temp_lang('assignment_submissions.delete_confirm'); ?>" onclick='confirmDelete(this)' class='btn btn-sm mb-2 btn-danger'><i class="fas fa-trash"></i></button>
                                                </form>
                                            <?php endif; ?>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>
<?= $this->endSection('content') ?>