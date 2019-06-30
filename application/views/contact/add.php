<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Garment Jobs Conact Info</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <?php if ($this->session->flashdata()) {
      $status = $this->session->flashdata('err_msg') ? 'danger' : 'success';
      $msg = $this->session->flashdata('err_msg') ? $this->session->flashdata('err_msg') : $this->session->flashdata('succ_msg');
      ?>
      <div class="row">
        <div class="alert alert-dismissable alert-<?= $status; ?>">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          <?= $msg; ?>
        </div>
      </div>
    <?php } ?>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <form class="form-horizontal" novalidate method="post" action="<?= base_url('contact/add'); ?>">
            <div class="x_title">
              <h2>Personal Info</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="item form-group <?= form_error('company_name') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Propreiter Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="name" class="form-control col-md-7 col-xs-12" name="company_name" required="required" type="text" value="<?= set_value('company_name', $data['company_name']); ?>">
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('company_name'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('email') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" value="<?= set_value('email', $data['email']); ?>">
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('email'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('mobile') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mobile">Mobile <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="mobile" id="mobile" name="mobile" value="<?= set_value('mobile', $data['mobile']); ?>" class="form-control col-md-7 col-xs-12">
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('mobile'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('address') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Address <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea id="textarea" required="required" name="address" class="form-control col-md-7 col-xs-12"><?= set_value('address', $data['address']); ?></textarea>
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('address'); ?></div>
                  </div>
                </div>
              </div>
              <div class="ln_solid"></div>
            </div>
            <div class="x_title">
              <h2>Other Info</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="item form-group <?= form_error('hr_email') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">HR Email <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="name" class="form-control col-md-7 col-xs-12" name="hr_email" required="required" type="text" value="<?= set_value('hr_email', $data['hr_email']); ?>">
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('hr_email'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('sales_email') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sales_email">Sales Email <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="sales_email" id="sales_email" name="sales_email" required="required" class="form-control col-md-7 col-xs-12" value="<?= set_value('sales_email', $data['sales_email']); ?>">
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('sales_email'); ?></div>
                  </div>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                  <a href="<?= base_url('contact'); ?>" class="btn btn-primary">Cancel</a>
                  <button id="send" type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>