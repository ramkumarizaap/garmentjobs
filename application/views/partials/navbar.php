<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="<?= base_url('home'); ?>" class="site_title" style="height:auto;">
        <img class="logo" src="<?= base_url('assets/images/logo.png'); ?>"></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_pic">
        <img src="<?= base_url('assets/images/user.png'); ?>" alt="..." class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <span>Welcome,</span>
        <h2><?= $this->session->userdata('userdata')['name']; ?></h2>
      </div>
    </div>
    <!-- /menu profile quick info -->

    <br />
    <?php
    $uri = $this->uri->segment(1);
    $counts = get_counts();
    ?>
    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <ul class="nav side-menu">
          <li><a href="<?= base_url('home'); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
          <li class="<?= ($uri === 'company') ? 'active' : ''; ?>">
            <a href="<?= base_url('company'); ?>"><i class="fa fa-bank"></i> Companies
              <span class="right badge bg-red"><?= $counts['company']['id']; ?></span></a>
          </li>
          <li class="<?= ($uri === 'candidate') ? 'active' : ''; ?>">
            <a href="<?= base_url('candidate'); ?>"><i class="fa fa-users"></i> Candidates
              <span class="right badge bg-aero"><?= $counts['candidate']['id']; ?></span></a>
          </li>
          <li class="<?= ($uri === 'interview') ? 'active' : ''; ?>">
            <a href="<?= base_url('interview'); ?>"><i class="fa fa-edit"></i> Interviews
              <span class="right badge bg-purple"><?= $counts['interview']['id']; ?></span></a>
          </li>
          <li class="<?= ($uri === 'onboard') ? 'active' : ''; ?>">
            <a href="<?= base_url('onboard'); ?>"><i class="fa fa-plane"></i> On Boarding
              <span class="right badge bg-blue"><?= $counts['boarding']['id']; ?></span></a>
          </li>
          <li class="<?= ($uri === 'invoice') ? 'active' : ''; ?>">
            <a href="<?= base_url('invoice'); ?>"><i class="fa fa-inr"></i>Invoice</a>
          </li>
          <li class="<?= ($uri === 'contact' || $uri === 'dropdown') ? 'active' : ''; ?>">
            <a><i class="fa fa-cogs"></i>Settings <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="<?= ($uri === 'contact') ? 'display:block;' : ''; ?>">
              <li class="<?= ($uri === 'dropdown') ? 'active' : ''; ?>"><a>Dropdown Values <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li class="sub_menu"><a href="<?= base_url('dropdown/source'); ?>">Source</a></li>
                  <li><a href="<?= base_url('dropdown/job_position'); ?>">Job Position</a></li>
                  <li><a href="<?= base_url('dropdown/qualification'); ?>">Qualifications</a></li>
                  <li><a href="<?= base_url('dropdown/app_status'); ?>">Applicant Status</a></li>
                  <li><a href="<?= base_url('dropdown/interview_status'); ?>">Interview Status</a></li>
                  <li><a href="<?= base_url('dropdown/interview_type'); ?>">Interview Type</a></li>
                  <li><a href="<?= base_url('dropdown/skills'); ?>">Skills</a></li>
                </ul>
              </li>
              <li class="<?= ($uri === 'contact') ? 'active' : ''; ?>">
                <a href="<?= base_url('contact'); ?>"><i class="fa fa-phone"></i> Contact Info</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?= base_url('login/logout'); ?>">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>
<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="images/img.jpg" alt=""><?= $this->session->userdata('userdata')['name']; ?>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="javascript:;"> Profile</a></li>
            <li><a href="<?= base_url('login/logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>