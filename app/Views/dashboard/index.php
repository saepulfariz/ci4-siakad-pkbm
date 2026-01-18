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
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-4 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?= $total_teachers; ?></h3>
            <p><?= temp_lang('dashboard.total_teachers'); ?></p>
          </div>
          <div class="icon">
            <i class="fas fa-chalkboard-teacher"></i>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?= $total_students; ?></h3>
            <p><?= temp_lang('dashboard.total_students'); ?></p>
          </div>
          <div class="icon">
            <i class="fas fa-user-graduate"></i>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3><?= $total_classes; ?></h3>
            <p><?= temp_lang('dashboard.total_classes'); ?></p>
          </div>
          <div class="icon">
            <i class="fas fa-school"></i>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-6">
        <div class="small-box bg-danger">
          <div class="inner">
            <h3><?= $total_subjects; ?></h3>
            <p><?= temp_lang('dashboard.total_subjects'); ?></p>
          </div>
          <div class="icon">
            <i class="fas fa-book"></i>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-6">
        <div class="small-box bg-primary">
          <div class="inner">
            <h3><?= $total_assignments; ?></h3>
            <p><?= temp_lang('dashboard.active_assignments'); ?></p>
          </div>
          <div class="icon">
            <i class="fas fa-tasks"></i>s
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-6">
        <div class="small-box bg-secondary">
          <div class="inner">
            <h3><?= $total_materials; ?></h3>
            <p><?= temp_lang('dashboard.total_materials'); ?></p>
          </div>
          <div class="icon">
            <i class="fas fa-book-open"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->
<?= $this->endSection('content') ?>