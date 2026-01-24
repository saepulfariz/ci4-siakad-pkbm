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

                $can_create = auth()->user()->can('students.create');
                $can_edit = auth()->user()->can('students.edit');
                $can_delete = auth()->user()->can('students.delete');

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
                                    <th><?= temp_lang('students.user'); ?></th>
                                    <th><?= temp_lang('students.nis'); ?></th>
                                    <th><?= temp_lang('students.nisn'); ?></th>
                                    <th><?= temp_lang('students.full_name'); ?></th>
                                    <th><?= temp_lang('students.gender'); ?></th>
                                    <th><?= temp_lang('students.birth_place'); ?></th>
                                    <th><?= temp_lang('students.birth_date'); ?></th>
                                    <th><?= temp_lang('students.address'); ?></th>
                                    <th><?= temp_lang('students.phone'); ?></th>
                                    <th><?= temp_lang('students.parent_father'); ?></th>
                                    <th><?= temp_lang('students.parent_mother'); ?></th>
                                    <th><?= temp_lang('students.photo'); ?></th>
                                    <th><?= temp_lang('app.action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a = 1;
                                foreach ($students as $student): ?>
                                    <tr>
                                        <td><?= $a++; ?></td>
                                        <td><?= esc($student->user_name); ?></td>
                                        <td><?= esc($student->nis); ?></td>
                                        <td><?= esc($student->nisn); ?></td>
                                        <td><?= esc($student->full_name); ?></td>
                                        <td><?= esc($student->gender); ?></td>
                                        <td><?= esc($student->birth_place); ?></td>
                                        <td><?= esc($student->birth_date); ?></td>
                                        <td><?= esc($student->address); ?></td>
                                        <td><?= esc($student->phone); ?></td>
                                        <td><?= esc($student->parent_father); ?></td>
                                        <td><?= esc($student->parent_mother); ?></td>
                                        <td>
                                            <img width="100px" src="<?= asset_url(); ?>uploads/students/<?= esc($student->photo); ?>" alt="" srcset="">
                                        </td>
                                        <td>
                                            <?php if ($can_edit): ?>
                                                <a class="btn btn-warning btn-sm mb-2" href="<?= base_url($link . '/' . esc($student->id) . '/edit'); ?>"><i class="fas fa-edit"></i></a>
                                            <?php endif; ?>
                                            <?php if ($can_delete): ?>
                                                <form class="d-inline" action='<?= base_url($link . '/' . esc($student->id)); ?>' method='post' enctype='multipart/form-data'>
                                                    <?= csrf_field(); ?>
                                                    <input type='hidden' name='_method' value='DELETE' />
                                                    <!-- GET, POST, PUT, PATCH, DELETE-->
                                                    <button type='button' data-ket="<?= temp_lang('students.delete_confirm'); ?>" onclick='confirmDelete(this)' class='btn btn-sm mb-2 btn-danger'><i class="fas fa-trash"></i></button>
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