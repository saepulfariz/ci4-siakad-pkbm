<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <?php
    $currentLang = service('request')->getLocale();
    ?>

    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <?php if ($currentLang === 'id'): ?>
          🇮🇩 ID
        <?php else: ?>
          🇺🇸 EN
        <?php endif ?>
        <i class="fas fa-language"></i>
      </a>

      <div class="dropdown-menu dropdown-menu-right">
        <a href="<?= site_url('lang/id') ?>"
          class="dropdown-item <?= $currentLang === 'id' ? 'active' : '' ?>">
          🇮🇩 Indonesia
        </a>

        <a href="<?= site_url('lang/en') ?>"
          class="dropdown-item <?= $currentLang === 'en' ? 'active' : '' ?>">
          🇺🇸 English
        </a>
      </div>
    </li>


    <!-- Notifications Dropdown Menu -->

    <?php

    $notifications = get_notifications();
    $count_unread = db_connect()->table('notifications')->where('user_id', auth()->id())->where('status', 'Unread')->countAllResults();
    // $count_unread = count(array_filter(
    //   $notifications,
    //   fn($n) => $n->status === 'Unread'
    // ));

    ?>
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge"><?= $count_unread; ?></span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header"><?= count($notifications); ?> Notifications</span>
        <div class="dropdown-divider"></div>
        <?php foreach ($notifications as $notification): ?>
          <a href="<?= base_url('notifications/' . $notification->id); ?>" class="dropdown-item">
            <div class="media">
              <!-- <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle"> -->
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  <?= $notification->title; ?>
                  <?php if ($notification->status == 'Unread'): ?>

                    <span class="float-right text-sm text-gray"><i class="fas fa-check-double"></i></span>
                  <?php else: ?>
                    <span class="float-right text-sm text-success"><i class="fas fa-check-double"></i></span>

                  <?php endif; ?>
                </h3>
                <p class="text-sm"><?= $notification->message; ?></p>
                <p class="text-sm text-muted">
                  <i class="far fa-clock mr-1"></i>
                  <?= $notification->created_at
                    ? date('Y-m-d H:i:s', strtotime($notification->created_at))
                    : '-' ?>
                </p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
        <?php endforeach; ?>
        <a href="<?= base_url('notifications'); ?>" class="dropdown-item dropdown-footer">See All Notifications</a>
      </div>
    </li>

    <!-- User Profile Dropdown -->
    <li class="nav-item dropdown user-menu">
      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <img src="<?= asset_url(); ?>assets/dist/img/user.png" class="user-image img-circle elevation-2" alt="User Image">
        <span class="d-none d-md-inline"><?= getProfile()->name; ?></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- User image -->
        <li class="user-header bg-primary">
          <img src="<?= asset_url(); ?>assets/dist/img/user.png" class="img-circle elevation-2" alt="User Image">
          <p>
            <?= getProfile()->name; ?><br>
            <small><?= getProfile()->email; ?></small>
          </p>
        </li>
        <!-- Menu Body -->
        <li class="user-body">
          <div class="row">
            <div class="col-12 text-center">
              <a href="<?= base_url('profile'); ?>">Profile</a>
            </div>
          </div>
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
          <a href="<?= base_url('change-password'); ?>" class="btn btn-default btn-flat"><?= temp_lang('app.change-password') ?></a>
          <a href="<?= base_url('logout'); ?>" class="btn btn-default btn-flat float-right"><?= temp_lang('app.logout') ?></a>
        </li>
      </ul>
    </li>
  </ul>
</nav>