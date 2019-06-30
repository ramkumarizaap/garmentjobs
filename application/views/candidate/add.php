<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Add Canidate</h3>
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
            <h2>Candidate Info</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form class="form-horizontal" enctype="multipart/form-data" novalidate method="post" action="<?= base_url('candidate/add/' . $data["id"] . ''); ?>">
              <input name="id" type="hidden" value="<?= $data['id']; ?>">
              <div class="item form-group <?= form_error('firstname') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">First Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="name" class="form-control col-md-7 col-xs-12" name="firstname" required="required" type="text" value="<?= set_value('firstname', $data['firstname']); ?>">
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('firstname'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('lastname') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Last Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="name" class="form-control col-md-7 col-xs-12" name="lastname" required="required" type="text" value="<?= set_value('lastname', $data['lastname']); ?>">
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('lastname'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('fathername') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Father Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="name" class="form-control col-md-7 col-xs-12" name="fathername" required="required" type="text" value="<?= set_value('fathername', $data['fathername']); ?>">
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('fathername'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('marital_status') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="experience">Marital Status <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control multi-select" name="marital_status">
                    <option>--Select Marital Status--</option>
                    <option <?= ($data['marital_status'] === "Single") ? 'selected' : ''; ?> value="Single">Single </option>
                    <option <?= ($data['marital_status'] === "Marrired") ? 'selected' : ''; ?> value="Marrired">Marrired</option>
                    <option <?= ($data['marital_status'] === "Divorced") ? 'selected' : ''; ?> value="Divorced">Divorced</option>
                  </select>
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('marital_status'); ?></div>
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
                  <input type="text" id="mobile" name="mobile" value="<?= set_value('mobile', $data['mobile']); ?>" class="form-control col-md-7 col-xs-12">
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('mobile'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('location') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Location <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea id="textarea" required="required" name="location" class="form-control col-md-7 col-xs-12"><?= set_value('location', $data['address']); ?></textarea>
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('location'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('experience') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="experience">Experience <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control multi-select" name="experience">
                    <option>--Select Experience--</option>
                    <option <?= ($data['experience'] === "Fresher") ? 'selected' : ''; ?> value="Fresher">Fresher or &lt; 1 </option>
                    <option <?= ($data['experience'] === "Intermediates") ? 'selected' : ''; ?> value="Intermediates"> Years > 2</option>
                    <option <?= ($data['experience'] === "Experts") ? 'selected' : ''; ?> value="Experts">Years > 8</option>
                  </select>
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('experience'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('qualification') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qualification">Qualification <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control multi-select" name="qualification">
                    <option>--Select Qualification--</option>
                    <?php if ($qualifications) {
                      foreach ($qualifications as $q) {
                        $q_sel = ($q['id'] == set_value('qualification', $data['qualification'])) ? 'selected' : '';
                        ?>
                        <option <?= $q_sel; ?> value="<?= $q['id']; ?>"><?= $q['name']; ?></option>
                      <?php }
                  } ?>
                  </select>
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('qualification'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('job_title') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="job_title">Job Title <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control multi-select" name="job_title">
                    <option>--Select Job Title--</option>
                    <?php if ($jobs) {
                      foreach ($jobs as $j) {
                        $j_sel = ($j['id'] == set_value('job_title', $data['job_position'])) ? 'selected' : '';
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
              <div class="item form-group <?= form_error('current_designation') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="current_designation">Current Designation<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="current_designation" name="current_designation" value="<?= set_value('current_designation', $data['current_employer']); ?>" class="form-control col-md-7 col-xs-12">
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('current_designation'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('c_employer') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="c_employer">Current Employer<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="c_employer" name="c_employer" value="<?= set_value('c_employer', $data['current_employer']); ?>" class="form-control col-md-7 col-xs-12">
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('c_employer'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('current_salary') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="current_salary">Current Salary<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="current_salary" name="current_salary" value="<?= set_value('current_salary', $data['current_salary']); ?>" class="form-control col-md-7 col-xs-12">
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('current_salary'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('expected_salary') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="expected_salary">Expected Salary <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="expected_salary" name="expected_salary" value="<?= set_value('expected_salary', $data['exp_salary']); ?>" class="form-control col-md-7 col-xs-12">
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('expected_salary'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('skills') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Skillset <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control multi-select" multiple name="skills[]">
                    <option>--Select Skills--</option>
                    <?php if ($skills) {
                      $ss = explode(",", $data['skillset']);
                      foreach ($skills as $s) {
                        $s_sel = ($s['id'] == set_value('skills[]', $data['skills']) || in_array($s['id'], $ss)) ? 'selected' : '';
                        ?>
                        <option <?= $s_sel; ?> value="<?= $s['id']; ?>"><?= $s['name']; ?></option>
                      <?php }
                  } ?>
                  </select>
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('skills'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('negotiable') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="negotiable">Salary Negotiable
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="radio">
                    <label>
                      <input type="radio" name="negotiable" value="Yes" class="flat"> Yes&nbsp;&nbsp;&nbsp;
                      <input type="radio" name="negotiable" value="No" class="flat"> No
                    </label>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('negotiable'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('skype') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="skype">Skype
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="skype" name="skype" value="<?= set_value('skype', $data['skype']); ?>" class="form-control col-md-7 col-xs-12">
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('skype'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('candidate_status') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="candidate_status">Candiate Status <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control multi-select" name="candidate_status">
                    <option value="">--Select Status--</option>
                    <?php if ($status) {
                      foreach ($status as $st) {
                        $c_sel = ($st['id'] == set_value('candidate_status', $data['application_status'])) ? 'selected' : '';
                        ?>
                        <option <?= $c_sel; ?> value="<?= $st['id']; ?>"><?= $st['name']; ?></option>
                      <?php }
                  } ?>
                  </select>
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('candidate_status'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('source') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="source">Source <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control multi-select" name="source">
                    <option>--Select Source--</option>
                    <?php if ($source) {
                      foreach ($source as $src) {
                        $src_sel = ($src['id'] == set_value('source', $data['source'])) ? 'selected' : '';
                        ?>
                        <option <?= $src_sel; ?> value="<?= $src['id']; ?>"><?= $src['name']; ?></option>
                      <?php }
                  } ?>
                  </select>
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('source'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('resume') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="resume">Resume <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" id="file" name="resume" class="form-control col-md-7 col-xs-12">
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('resume'); ?></div>
                  </div>
                  <div class="col-sm-12">
                    <?php
                    if ($data['id'] !== '') {
                      echo "<br><strong><p>" . $data['resume'] . "</p></strong>";
                      ?>
                      <input type="hidden" name="old_resume" value="<?= $data['resume']; ?>" class="form-control col-md-7 col-xs-12">
                    <?php
                  }
                  ?>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('photo') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="photo">Photo <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" id="file" name="photo" class="form-control col-md-7 col-xs-12">
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('photo'); ?></div>
                  </div>
                  <div class="col-sm-12">
                    <?php
                    if ($data['id'] !== '') {
                      echo "<br><strong><p>" . $data['photo'] . "</p></strong>";
                      ?>
                      <input type="hidden" name="old_photo" value="<?= $data['photo']; ?>" class="form-control col-md-7 col-xs-12">
                    <?php
                  }
                  ?>
                  </div>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                  <a href="<?= base_url('company'); ?>" class="btn btn-primary">Cancel</a>
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