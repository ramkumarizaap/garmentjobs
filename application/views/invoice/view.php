<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Invoices </h3>
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
        <a class="btn btn-primary pull-right" href="<?= base_url('invoice/add'); ?>"><i class="fa fa-plus"></i> Create Invoice</a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Invoices List</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Invoice ID</th>
                  <th>To Name</th>
                  <th>Invoice Date</th>
                  <th>Total</th>
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
                      <td>
                        <strong><a data-target=".inv-view-modal" data-inv-id="<?= $item['inv_no'] ?>" data-id="<?= $item['id'] ?>" class="view-invoice" data-toggle="modal" href="#"><i class="fa fa-eye"></i> &nbsp;
                            <?= $item['inv_no']; ?></a></strong>
                      </td>
                      <td><?= $item['emp_name']; ?></td>
                      <td><?= date("d/m/Y", strtotime($item['inv_date'])); ?></td>
                      <td><i class="fa fa-inr"></i> <?= $item['total']; ?></td>
                      <td><?= date("d/m/y h:i:s a", strtotime($item['created_date'])); ?></td>
                      <td width="15%">
                        <div class="btn-group">
                          <button data-toggle="dropdown" class="btn btn-danger dropdown-toggle btn-sm" type="button">Action <span class="caret"></span>
                          </button>
                          <ul role="menu" class="dropdown-menu">
                            <li><a href="<?= base_url("invoice/add/{$item['i_id']}"); ?>"><i class="fa fa-envelope"></i> Send Mail</a></li>
                            <li><a target="_blank" href="<?= base_url("invoice/print_invoice/{$item['i_id']}"); ?>"><i class="fa fa-print"></i> Print Invoice</a></li>
                            <li><a href="<?= base_url("invoice/add/{$item['i_id']}"); ?>"><i class="fa fa-edit"></i> Edit</a></li>
                            <li><a href="#" class="delete-btn" data-toggle="modal" data-action="invoice/delete/<?= $item['i_id']; ?>" data-name="<?= $item['emp_name']; ?>" data-target=".bs-example-modal-sm"><i class="fa fa-trash"></i> Delete</a></li>
                          </ul>
                        </div>
                        <a href="<?= base_url("invoice/download_invoice/{$item['id']}"); ?>" style="margin-top:5px;" class="btn btn-sm btn-primary">
                          <i class="fa fa-download"></i> Download PDF</a>
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
        <p>Are you sure want to delete invoice for this company <strong class="name"></strong>?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="c-del-btn btn btn-danger">Delete</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade inv-view-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="width:1200px;">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">#Invoice - <strong><span class="inv-no"></span></strong></h4>
      </div>
      <div class="modal-body" style="overflow:auto;height:700px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="c-del-btn btn btn-primary"> <i class="fa fa-download"></i>&nbsp;Download PDF</button>
        <a target="_blank" class="btn btn-info" href="<?= base_url("invoice/print_invoice/{$item['i_id']}"); ?>"><i class="fa fa-print"></i> Print Invoice</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>