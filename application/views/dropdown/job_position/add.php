<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Add Job Position of Applicant</h3>
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
            <h2>Job Position Info</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form class="form-horizontal" novalidate method="post" action="<?= base_url('dropdown/add/job_position'); ?>">
              <input name="id" type="hidden" value="<?= $data['id']; ?>">
              <div class="item form-group <?= form_error('name') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="name" class="form-control col-md-7 col-xs-12" name="name" required="required" type="text" value="<?= set_value('name', $data['name']); ?>">
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('name'); ?></div>
                  </div>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                  <a href="<?= base_url('dropdown/job_position'); ?>" class="btn btn-primary">Cancel</a>
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