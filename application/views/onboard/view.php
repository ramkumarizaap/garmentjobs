<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Onboarding Candidates </h3>
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
      <div class="col-sm-2 pull-right">
        <a class="btn btn-primary pull-right" href="<?= base_url('onboard/add'); ?>"><i class="fa fa-plus"></i> Add Onboarding</a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Onboarding Candidates List</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Job Position</th>
                  <th>Employer Name</th>
                  <th>Joining Status</th>
                  <th>Salary</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($data->num_rows() > 0) {
                  foreach ($data->result_array() as $item) {
                    ?>
                    <tr>
                      <td><?= $item['firstname'] . " " . $item['lastname']; ?></td>
                      <td><?= $item['j_position']; ?></td>
                      <td><?= $item['employer_name']; ?></td>
                      <td><?= getLabel($item['joining_status']); ?></td>
                      <td><?= $item['salary']; ?></td>
                      <td><?= date("d/m/y h:i:s a", strtotime($item['created_date'])); ?></td>
                      <td>
                        <div class="btn-group">
                          <button data-toggle="dropdown" class="btn btn-danger dropdown-toggle btn-xs" type="button">Action <span class="caret"></span>
                          </button>
                          <ul role="menu" class="dropdown-menu">
                            <?php if ($item['joining_status'] === "On") { ?>
                              <li><a href="<?= base_url("onboard/ch_status/{$item['id']}/1"); ?>"><i class="fa fa-ban"></i> Make as Off</a></li>
                            <?php } else { ?>
                              <li><a href="<?= base_url("onboard/ch_status/{$item['id']}/0"); ?>"><i class="fa fa-check"></i> Make as On</a></li>
                            <?php } ?>
                            <li><a href="<?= base_url("onboard/add/{$item['i_id']}"); ?>"><i class="fa fa-edit"></i> Edit</a></li>
                            <li><a href="#" class="delete-btn" data-toggle="modal" data-action="onboard/delete/<?= $item['i_id']; ?>" data-name="<?= $item['firstname']; ?>" data-target=".bs-example-modal-sm"><i class="fa fa-trash"></i> Delete</a></li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                  <?php
                }
              }
              ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Confirm Delete</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure want to delete onboarding for this candidate <strong class="name"></strong>?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="c-del-btn btn btn-danger">Delete</button>
      </div>

    </div>
  </div>
</div>