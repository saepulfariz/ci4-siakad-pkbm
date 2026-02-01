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

                $can_create = auth()->user()->can('teacher-subjects.create');
                $can_edit = auth()->user()->can('teacher-subjects.edit');
                $can_delete = auth()->user()->can('teacher-subjects.delete');

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
                                    <th><?= temp_lang('teachers.teacher'); ?></th>
                                    <th><?= temp_lang('subjects.subject'); ?></th>
                                    <th><?= temp_lang('semesters.semester'); ?></th>
                                    <th><?= temp_lang('academic_years.academic_year'); ?></th>
                                    <th><?= temp_lang('app.action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a = 1;
                                foreach ($teacher_subjects as $subject): ?>
                                    <tr>
                                        <td><?= $a++; ?></td>
                                        <td><?= esc($subject->teacher_name); ?></td>
                                        <td><?= esc($subject->subject_name); ?></td>
                                        <td><?= esc($subject->semester_name); ?></td>
                                        <td><?= esc($subject->academic_year_name); ?></td>
                                        <td>
                                            <?php if ($can_edit): ?>

                                                <a class="btn btn-warning btn-sm mb-2" href="<?= base_url($link . '/' . esc($subject->id) . '/edit'); ?>"><i class="fas fa-edit"></i></a>


                                            <?php endif; ?>
                                            <?php if ($can_delete): ?>

                                                <form class="d-inline" action='<?= base_url($link . '/' . esc($subject->id)); ?>' method='post' enctype='multipart/form-data'>
                                                    <?= csrf_field(); ?>
                                                    <input type='hidden' name='_method' value='DELETE' />
                                                    <!-- GET, POST, PUT, PATCH, DELETE-->
                                                    <button type='button' data-ket="<?= temp_lang('teacher_subjects.delete_confirm'); ?>" onclick='confirmDelete(this)' class='btn btn-sm mb-2 btn-danger'><i class="fas fa-trash"></i></button>
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