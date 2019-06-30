<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Add Company</h3>
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
          <div class="x_title">
            <h2>Company Info</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form class="form-horizontal" novalidate method="post" action="<?= base_url('company/add'); ?>">
              <input name="id" type="hidden" value="<?= $data['id']; ?>">
              <div class="item form-group <?= form_error('company_name') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Company Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="name" class="form-control col-md-7 col-xs-12" name="company_name" required="required" type="text" value="<?= set_value('company_name', $data['name']); ?>">
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
              <div class="item form-group <?= form_error('number') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Number <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="number" id="number" name="number" value="<?= set_value('number', $data['mobile']); ?>" class="form-control col-md-7 col-xs-12">
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('number'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('website') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Website URL <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="url" id="website" value="<?= set_value('website', $data['url']); ?>" name="website" required="required" placeholder="www.website.com" class="form-control col-md-7 col-xs-12">
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('website'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('address') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Location <span class="required">*</span>
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
              <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                  <a href="<?= base_url('candidate'); ?>" class="btn btn-primary">Cancel</a>
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