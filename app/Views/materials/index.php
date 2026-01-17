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

                $can_create = auth()->user()->can('materials.create');
                $can_edit = auth()->user()->can('materials.edit');
                $can_delete = auth()->user()->can('materials.delete');

                ?>
                <?php if ($can_create): ?>
                    <a href="<?= base_url($link . '/new'); ?>" class="btn btn-primary btn-sm mb-2">New</a>
                <?php endif; ?>
                <div class="card">
                    <div class="card-body">
                        <table class="table" id="table2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Class</th>
                                    <th>Subject</th>
                                    <th>Teacher</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a = 1;
                                foreach ($materials as $material): ?>
                                    <tr>
                                        <td><?= $a++; ?></td>
                                        <td><?= esc($material->class_name); ?></td>
                                        <td><?= esc($material->subject_name); ?></td>
                                        <td><?= esc($material->teacher_name); ?></td>
                                        <td><?= esc($material->title); ?></td>
                                        <td><?= esc($material->description); ?></td>
                                        <td>
                                            <?php if (esc($material->file)): ?>

                                                <a href="<?= esc($material->file); ?>" target="_blank">Download</a>

                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($can_edit): ?>

                                                <a class="btn btn-warning btn-sm mb-2" href="<?= base_url($link . '/' . esc($material->id) . '/edit'); ?>"><i class="fas fa-edit"></i></a>

                                            <?php endif; ?>
                                            <?php if ($can_delete): ?>


                                                <form class="d-inline" action='<?= base_url($link . '/' . esc($material->id)); ?>' method='post' enctype='multipart/form-data'>
                                                    <?= csrf_field(); ?>
                                                    <input type='hidden' name='_method' value='DELETE' />
                                                    <!-- GET, POST, PUT, PATCH, DELETE-->
                                                    <button type='button' onclick='confirmDelete(this)' class='btn btn-sm mb-2 btn-danger'><i class="fas fa-trash"></i></button>
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