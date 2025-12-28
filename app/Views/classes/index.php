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

                $can_create = auth()->user()->can('classe.create');
                $can_edit = auth()->user()->can('classe.edit');
                $can_delete = auth()->user()->can('classe.delete');

                ?>
                <a href="<?= base_url($link . '/new'); ?>" class="btn btn-primary btn-sm mb-2">New</a>
                <div class="card">
                    <div class="card-body">
                        <table class="table" id="table2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Parent</th>
                                    <th>Name</th>
                                    <th>Homeroom</th>
                                    <th>Education</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a = 1;
                                foreach ($classes as $clsss): ?>
                                    <tr>
                                        <td><?= $a++; ?></td>
                                        <td><?= $clsss->class_parent; ?></td>
                                        <td><?= $clsss->name; ?></td>
                                        <td><?= $clsss->teacher_name; ?></td>
                                        <td><?= $clsss->education_name; ?></td>
                                        <td>
                                            <a class="btn btn-warning btn-sm mb-2" href="<?= base_url($link . '/' . $clsss->id . '/edit'); ?>"><i class="fas fa-edit"></i></a>
                                            <form class="d-inline" action='<?= base_url($link . '/' . $clsss->id); ?>' method='post' enctype='multipart/form-data'>
                                                <?= csrf_field(); ?>
                                                <input type='hidden' name='_method' value='DELETE' />
                                                <!-- GET, POST, PUT, PATCH, DELETE-->
                                                <button type='button' onclick='confirmDelete(this)' class='btn btn-sm mb-2 btn-danger'><i class="fas fa-trash"></i></button>
                                            </form>

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