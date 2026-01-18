<?= $this->extend('template/index') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Stat boxes -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?= $class_current->name; ?></h3>
            <p><?= temp_lang('dashboard.current_class'); ?></p>
          </div>
          <div class="icon">
            <i class="fas fa-school"></i>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?= $total_class_subjects; ?></h3>
            <p><?= temp_lang('dashboard.total_class_subjects'); ?></p>
          </div>
          <div class="icon">
            <i class="fas fa-book"></i>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3><?= $total_assignments; ?></h3>
            <p><?= temp_lang('dashboard.total_assignments'); ?></p>
          </div>
          <div class="icon">
            <i class="fas fa-tasks"></i>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
          <div class="inner">
            <h3><?= $average_score_submission->avg_score ?? 0; ?></h3>
            <p><?= temp_lang('dashboard.avg_score'); ?></p>
          </div>
          <div class="icon">
            <i class="fas fa-chart-line"></i>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
<!-- /.content -->
<?= $this->endSection('content') ?>