<div>
  <div class="login_wrapper">
    <div class="animate form login_form">
      <section class="login_content">
        <form class="form-horizontal" action="<?= base_url(); ?>login/chk_login" method="post">
          <h1>Login Here</h1>
          <?php if ($this->session->flashdata('err_msg')) { ?>
            <div class="alert alert-danger alert-dismissible fade in">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button><span class="text-left"><?= $this->session->flashdata('err_msg'); ?></span></div>
          <?php } ?>
          <div class="<?= form_error('username') ? 'bad' : ''; ?>">
            <input type="text" name="username" class="form-control" placeholder="Username" />
            <div class="error"><?= form_error('username'); ?></div>
          </div>
          <div class="<?= form_error('password') ? 'bad' : ''; ?>">
            <input type="password" name="password" class="form-control" placeholder="Password" />
            <div class="error"><?= form_error('password'); ?></div>
          </div>
          <div>
            <button type="submit" class="left btn btn-primary">Log in</button>
          </div>

          <div class="clearfix"></div>

          <div class="separator">
            <div class="clearfix"></div>
            <br />
            <div>
              <h1><img src="<?= base_url('assets/images/logo.png'); ?>" class="logo"></h1>
              <p>&copy;<?= date('Y'); ?> All Rights Reserved. Garment Jobs</p>
            </div>
          </div>
        </form>
      </section>
    </div>
  </div>
</div>