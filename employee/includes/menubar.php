<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user['firstname'].' '.$user['lastname']; ?></p>
          <a><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MANAGE</li>
        <li><a href="home.php"><i class="fa fa-calendar"></i> <span>Home page</span></a></li>
        <li><a href="profile.php"><i class="fa fa-file-text"></i> My profile</a></li>
        <li><a href="attendance.php"><i class="fa fa-suitcase"></i> My attendance</a></li>
        <li><a href="schedule.php"><i class="fa fa-suitcase"></i> My schedule</a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>