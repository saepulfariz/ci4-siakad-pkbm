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
    <!-- Stat boxes -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?= $total_teacher_subjects; ?></h3>
            <p><?= temp_lang('dashboard.total_teacher_subjects'); ?></p>
          </div>
          <div class="icon">
            <i class="fas fa-book"></i>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?= $total_teacher_subject_classes; ?></h3>
            <p><?= temp_lang('dashboard.total_teacher_subject_classes'); ?></p>
          </div>
          <div class="icon">
            <i class="fas fa-school"></i>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <a href="<?= base_url('assignments'); ?>">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?= $total_assignments; ?></h3>
              <p><?= temp_lang('dashboard.total_assignments'); ?></p>
            </div>
            <div class="icon">
              <i class="fas fa-tasks"></i>
            </div>
          </div>
        </a>
      </div>

      <div class="col-lg-3 col-6">
        <a href="<?= base_url('assignment-submissions'); ?>">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?= $total_assignment_submissions; ?></h3>
              <p><?= temp_lang('dashboard.total_assignment_submissions'); ?></p>
            </div>
            <div class="icon">
              <i class="fas fa-clipboard-check"></i>
            </div>
          </div>
        </a>
      </div>
    </div>


    <div class="row">
      <div class="col-md-6 mb-2">
        <div class="card">
          <div class="card-header">
            <?= temp_lang('dashboard.new_notifications'); ?>
          </div>
          <div class="card-body">
            <?php foreach ($notifications as $notification): ?>
              <p class="mb-0">
                <a href="<?= base_url('notificatons/' . $notification->id); ?>">
                  <?= $notification->title; ?>
                </a>
              </p>
              <small><?= $notification->created_at->humanize(); ?></small>
              <hr>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <div class="col-md-6 mb-2">
        <div class="card">
          <div class="card-header">
            <?= temp_lang('dashboard.new_annoucements'); ?>
          </div>
          <div class="card-body">
            <?php foreach ($annoucements as $annoucement): ?>
              <p class="mb-0">
                <a href="<?= base_url('notificatons/' . $annoucement->id); ?>">
                  <?= $annoucement->title; ?>
                </a>
              </p>
              <small><?= $annoucement->created_at ? $annoucement->created_at->humanize() : ''; ?></small>
              <hr>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
<!-- /.content -->
<?= $this->endSection('content') ?>