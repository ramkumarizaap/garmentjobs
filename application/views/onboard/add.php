<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Onboarding Candidate</h3>
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
            <h2>Onboarding Info</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form class="form-horizontal" enctype="multipart/form-data" novalidate method="post" action="<?= base_url('onboard/add'); ?>">
              <input name="id" type="hidden" value="<?= $data['id']; ?>">
              <div class="item form-group <?= form_error('c_name') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Candidate Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control multi-select" name="c_name">
                    <option value="">--Select Candidate Name--</option>
                    <?php if ($candidate) {
                      foreach ($candidate as $cd) {
                        $cd_sel = ($cd['id'] == set_value('c_name', $data['c_name'])) ? 'selected' : '';
                        ?>
                        <option <?= $cd_sel; ?> value="<?= $cd['id']; ?>"><?= $cd['firstname'] . " " . $cd['lastname']; ?></option>
                      <?php }
                  } ?>
                  </select>
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('c_name'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('emp_name') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Employer Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control multi-select" name="emp_name">
                    <option value="">--Select Employer Name--</option>
                    <?php if ($company) {
                      foreach ($company as $c) {
                        $c_sel = ($c['id'] == set_value('emp_name', $data['emp_name'])) ? 'selected' : '';
                        ?>
                        <option <?= $c_sel; ?> value="<?= $c['id']; ?>"><?= $c['name']; ?></option>
                      <?php }
                  } ?>
                  </select>
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('emp_name'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('job_title') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Job Title <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control multi-select" name="job_title">
                    <option value="">--Select Job Title--</option>
                    <?php if ($jobs) {
                      foreach ($jobs as $j) {
                        $j_sel = ($j['id'] == set_value('job_title', $data['job_title'])) ? 'selected' : '';
                        ?>
                        <option <?= $j_sel; ?> value="<?= $j['id']; ?>"><?= $j['name']; ?></option>
                      <?php }
                  } ?>
                  </select>
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('job_title'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('join_date') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="join_date">Joining Date <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="col-md-12 xdisplay_inputx form-group has-feedback">
                    <input type="text" class="form-control has-feedback-left" name="join_date" id="single_cal1" placeholder="Interview Date" value="<?= set_value('join_date', date('d/m/Y', strtotime($data['join_date']))); ?>">
                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('join_date'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('address') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Location <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="address" name="address" value="<?= set_value('address', $data['location']); ?>" class="form-control col-md-7 col-xs-12">
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('address'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('salary') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="salary">Salary Per Annum <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="salary" name="salary" value="<?= set_value('salary', $data['salary']); ?>" class="form-control col-md-7 col-xs-12">
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('salary'); ?></div>
                  </div>
                </div>
              </div>

              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                  <a href="<?= base_url('onboard'); ?>" class="btn btn-primary">Cancel</a>
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