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

                $can_create = auth()->user()->can('academic-years.create');
                $can_edit = auth()->user()->can('academic-years.edit');
                $can_delete = auth()->user()->can('academic-years.delete');

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
                                    <th><?= temp_lang('academic_years.name'); ?></th>
                                    <th><?= temp_lang('academic_years.start_year'); ?></th>
                                    <th><?= temp_lang('academic_years.end_year'); ?></th>
                                    <th><?= temp_lang('academic_years.active'); ?></th>
                                    <th><?= temp_lang('app.action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a = 1;
                                foreach ($academic_years as $academic): ?>
                                    <tr>
                                        <td><?= $a++; ?></td>
                                        <td><?= esc($academic->name); ?></td>
                                        <td><?= esc($academic->start_year); ?></td>
                                        <td><?= esc($academic->end_year); ?></td>
                                        <td>
                                            <?php if ($can_edit): ?>

                                                <?php if ($academic->is_active) : ?>
                                                    <a class="btn btn-success btn-sm" href="<?= base_url($link . '/' . esc($academic->id) . '/deactivate'); ?>">
                                                        <i class="fas fa-check"></i>
                                                    </a>
                                                <?php else : ?>
                                                    <a class="btn btn-danger btn-sm" href="<?= base_url($link . '/' . esc($academic->id) . '/activate'); ?>">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                <?php endif; ?>
                                            <?php else: ?>

                                                <?php if ($academic->is_active) : ?>
                                                    <a class="btn btn-success btn-sm" href="#; ?>">
                                                        <i class="fas fa-check"></i>
                                                    </a>
                                                <?php else : ?>
                                                    <a class="btn btn-danger btn-sm" href="#">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($can_edit): ?>
                                                <a class="btn btn-warning btn-sm mb-2" href="<?= base_url($link . '/' . esc($academic->id) . '/edit'); ?>"><i class="fas fa-edit"></i></a>

                                            <?php endif; ?>
                                            <?php if ($can_delete): ?>

                                                <form class="d-inline" action='<?= base_url($link . '/' . esc($academic->id)); ?>' method='post' enctype='multipart/form-data'>
                                                    <?= csrf_field(); ?>
                                                    <input type='hidden' name='_method' value='DELETE' />
                                                    <!-- GET, POST, PUT, PATCH, DELETE-->
                                                    <button type='button' data-ket="<?= temp_lang('academic_years.delete_confirm'); ?>" onclick='confirmDelete(this)' class='btn btn-sm mb-2 btn-danger'><i class="fas fa-trash"></i></button>
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