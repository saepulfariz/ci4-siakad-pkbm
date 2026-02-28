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

                $can_create = auth()->user()->can('attendances.create');
                $can_edit = auth()->user()->can('attendances.edit');
                $can_delete = auth()->user()->can('attendances.delete');
				
				$can_access_all = auth()->user()->can('attendances.access-all');

                $can_action = ($can_edit || $can_delete) ? true : false;

                $checkTheDay = false;
                if (!auth()->user()->can('attendances.access-all')) {
                    $checkTheDay  = checkTheDay();
                }
                ?>
                <?php if ($can_create): ?>

                    <?php if ($checkTheDay || $can_access_all): ?>

                        <a href="<?= base_url($link . '/new'); ?>" class="btn btn-primary btn-sm mb-2"><?= temp_lang('app.new'); ?></a>

                    <?php endif; ?>

                <?php endif; ?>
                <div class="card">
                    <div class="card-body">
                        <table class="table w-100" id="table2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= temp_lang('attendances.name'); ?></th>
                                    <th><?= temp_lang('attendances.type'); ?></th>
                                    <th><?= temp_lang('attendances.status'); ?></th>
                                    <th><?= temp_lang('attendances.date'); ?></th>
                                    <th><?= temp_lang('attendances.description'); ?></th>
                                    <th><?= temp_lang('attendances.datetime'); ?></th>
                                    <?php if ($can_action): ?>
                                        <th><?= temp_lang('app.action'); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a = 1;
                                foreach ($attendances as $attendance): ?>
                                    <tr>
                                        <td><?= $a++; ?></td>
                                        <td><?= esc($attendance->full_name); ?></td>
                                        <?php if ($attendance->type == 'student'): ?>

                                            <td><?= temp_lang('students.' . esc($attendance->type)); ?></td>
                                        <?php else: ?>
                                            <td><?= temp_lang('teachers.' . esc($attendance->type)); ?></td>

                                        <?php endif; ?>
                                        <td><?= temp_lang('attendances.' . esc($attendance->status)); ?></td>
                                        <td><?= esc($attendance->date); ?></td>
                                        <td><?= esc($attendance->description); ?></td>
                                        <td><?= esc($attendance->created_at); ?></td>
                                        <?php if ($can_action): ?>


                                            <td>
                                                <?php if ($can_edit): ?>

                                                    <a class="btn btn-warning btn-sm mb-2" href="<?= base_url($link . '/' . esc($attendance->id) . '/edit'); ?>"><i class="fas fa-edit"></i></a>
                                                <?php endif; ?>
                                                <?php if ($can_delete): ?>

                                                    <form class="d-inline" action='<?= base_url($link . '/' . esc($attendance->id)); ?>' method='post' enctype='multipart/form-data'>
                                                        <?= csrf_field(); ?>
                                                        <input type='hidden' name='_method' value='DELETE' />
                                                        <!-- GET, POST, PUT, PATCH, DELETE-->
                                                        <button type='button' data-ket="<?= temp_lang('attendances.delete_confirm'); ?>" onclick='confirmDelete(this)' class='btn btn-sm mb-2 btn-danger'><i class="fas fa-trash"></i></button>
                                                    </form>
                                                <?php endif; ?>

                                            </td>
                                        <?php endif; ?>
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