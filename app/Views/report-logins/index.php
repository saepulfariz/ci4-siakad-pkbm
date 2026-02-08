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
                <div class="card">
                    <div class="card-body">
                        <table class="table w-100" id="table2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= temp_lang('report_logins.name'); ?></th>
                                    <th><?= temp_lang('report_logins.group'); ?></th>
                                    <th><?= temp_lang('report_logins.ip_address'); ?></th>
                                    <th><?= temp_lang('report_logins.user_agent'); ?></th>
                                    <th><?= temp_lang('report_logins.id_type'); ?></th>
                                    <th><?= temp_lang('report_logins.identifier'); ?></th>
                                    <th><?= temp_lang('report_logins.date'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a = 1;
                                foreach ($report_logins as $login): ?>
                                    <tr>
                                        <td><?= $a++; ?></td>
                                        <td><?= esc($login->name); ?></td>
                                        <td><?= esc($login->group); ?></td>
                                        <td><?= esc($login->ip_address); ?></td>
                                        <td><?= esc($login->user_agent); ?></td>
                                        <td><?= esc($login->id_type); ?></td>
                                        <td><?= esc($login->identifier); ?></td>
                                        <td><?= esc($login->date); ?></td>
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