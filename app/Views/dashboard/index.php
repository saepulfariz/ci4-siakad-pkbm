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
        <a href="<?= base_url('teachers'); ?>">
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= $total_teachers; ?></h3>
              <p><?= temp_lang('dashboard.total_teachers'); ?></p>
            </div>
            <div class="icon">
              <i class="fas fa-chalkboard-teacher"></i>
            </div>
          </div>
        </a>
      </div>

      <div class="col-lg-4 col-6">
        <a href="<?= base_url('students'); ?>">
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?= $total_students; ?></h3>
              <p><?= temp_lang('dashboard.total_students'); ?></p>
            </div>
            <div class="icon">
              <i class="fas fa-user-graduate"></i>
            </div>
          </div>
        </a>
      </div>

      <div class="col-lg-4 col-6">
        <a href="<?= base_url('classes'); ?>">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?= $total_classes; ?></h3>
              <p><?= temp_lang('dashboard.total_classes'); ?></p>
            </div>
            <div class="icon">
              <i class="fas fa-school"></i>
            </div>
          </div>
        </a>
      </div>

      <div class="col-lg-4 col-6">
        <a href="<?= base_url('subjects'); ?>">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?= $total_subjects; ?></h3>
              <p><?= temp_lang('dashboard.total_subjects'); ?></p>
            </div>
            <div class="icon">
              <i class="fas fa-book"></i>
            </div>
          </div>
        </a>
      </div>

      <div class="col-lg-4 col-6">
        <a href="<?= base_url('assignments'); ?>">
          <div class="small-box bg-primary">
            <div class="inner">
              <h3><?= $total_assignments; ?></h3>
              <p><?= temp_lang('dashboard.active_assignments'); ?></p>
            </div>
            <div class="icon">
              <i class="fas fa-tasks"></i>
            </div>
          </div>
        </a>
      </div>

      <div class="col-lg-4 col-6">
        <a href="<?= base_url('materials'); ?>">
          <div class="small-box bg-secondary">
            <div class="inner">
              <h3><?= $total_materials; ?></h3>
              <p><?= temp_lang('dashboard.total_materials'); ?></p>
            </div>
            <div class="icon">
              <i class="fas fa-book-open"></i>
            </div>
          </div>
        </a>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <?= temp_lang('dashboard.login_activity'); ?>
          </div>
          <div class="card-body">
            <canvas id="login-activity" height="400"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->
<?= $this->endSection('content') ?>


<?= $this->section('script') ?>
<script>
  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode = 'index'
  var intersect = true

  const studentData = <?= json_encode($chart_login['student']) ?>;
  const teacherData = <?= json_encode($chart_login['teacher']) ?>;


  var $loginActivity = $('#login-activity')
  // eslint-disable-next-line no-unused-vars
  var loginActivity = new Chart($loginActivity, {
    type: 'bar',
    data: {
      labels: ['<?= temp_lang('dashboard.monday'); ?>', '<?= temp_lang('dashboard.tuesday'); ?>', '<?= temp_lang('dashboard.wednesday'); ?>', '<?= temp_lang('dashboard.thursday'); ?>', '<?= temp_lang('dashboard.friday'); ?>', '<?= temp_lang('dashboard.saturday'); ?>', '<?= temp_lang('dashboard.sunday'); ?>'],
      datasets: [{
          label: '<?= temp_lang('dashboard.login_teacher'); ?>',
          backgroundColor: '#3B82F6',
          borderColor: '#3B82F6',
          data: teacherData,
        },
        {
          label: '<?= temp_lang('dashboard.login_student'); ?>',
          backgroundColor: '#10B981',
          borderColor: '#10B981',
          data: studentData,
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function(value) {
              if (value >= 1000) {
                value /= 1000
                value += 'k'
              }

              return '$' + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })
</script>
<?= $this->endSection('script') ?>