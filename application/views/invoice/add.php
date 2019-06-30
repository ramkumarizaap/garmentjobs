<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Invoice Form</h3>
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
            <h2>Invoice Info</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form class="form-horizontal" enctype="multipart/form-data" novalidate method="post" action="<?= base_url('invoice/add'); ?>">
              <input name="id" type="hidden" value="<?= $data['id']; ?>">
              <div class="item form-group <?= form_error('c_name') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">From Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <?= $contact['company_name']; ?>(<?= $contact['hr_email']; ?>)
                  <input name="c_name" type="hidden" value="<?= $contact['hr_email']; ?>">

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
                    <option value="">--Select Invoice To Name--</option>
                    <?php if ($company) {
                      foreach ($company as $c) {
                        $c_sel = ($c['id'] == set_value('emp_name', $data['to_name'])) ? 'selected' : '';
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
              <div class="item form-group <?= form_error('terms') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Invoice Terms <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="terms" class="form-control" value="<?= set_value('terms', $data['terms']); ?>">
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('terms'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('inv_date') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inv_date">Invoice Date <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="col-md-12 xdisplay_inputx form-group has-feedback">
                    <?php
                    $inv_date = $data['inv_date'] ? date("d/m/Y", strtotime($data['inv_date'])) : "";
                    ?>
                    <input type="text" class="form-control has-feedback-left" name="inv_date" id="single_cal1" placeholder="Interview Date" value="<?= set_value('inv_date', $inv_date); ?>">
                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('inv_date'); ?></div>
                  </div>
                </div>
              </div>
              <div class="item form-group <?= form_error('notes') ? 'bad' : ''; ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="notes">Notes <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea class="form-control col-md-7 col-xs-12" rows="3" name="notes"><?= set_value('notes', $data['notes']); ?></textarea>
                  <div class="clearfix"></div>
                  <div class="col-sm-12">
                    <div class="error"><?= form_error('notes'); ?></div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <button class="add-new-row btn btn-info" type="button"><i class="fa fa-plus">&nbsp; Add New Row</i></button>
              </div>
              <div class="form-group">
                <table class="custom-table table table-hover">
                  <thead>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                  </thead>
                  <tbody>
                    <?php
                    $class = "hide";
                    if ($items) {
                      $class = "";
                      foreach ($items as $item) {
                        ?>
                        <tr>
                          <td width="55%"><textarea rows="3" name="description[]" class="form-control"><?= $item['description']; ?></textarea></td>
                          <td><input type="text" name="price[]" value="<?= $item['price']; ?>" class="form-control" placeholder="Price"></td>
                          <td><input type="text" name="qty[]" value="<?= $item['qty']; ?>" class="form-control" placeholder="Qty"></td>
                          <td align="right" class="total"><?= $item['total']; ?></td>
                          <td><button type="button" class="remove-row btn btn-xs btn-danger"><i class="fa fa-remove"></i></button></td>
                        </tr>
                      <?php
                    }
                  }
                  ?>
                    <tr>
                      <td width="55%"><textarea rows="3" name="description[]" class="form-control"></textarea></td>
                      <td><input type="text" name="price[]" value="0" class="form-control" placeholder="Price"></td>
                      <td><input type="text" name="qty[]" value="0" class="form-control" placeholder="Qty"></td>
                      <td class="total">0.00</td>
                      <td class="<?= $class; ?>"><button type="button" class="remove-row btn btn-xs btn-danger"><i class="fa fa-remove"></i></button></td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="3" align="right">Sub Total</td>
                      <td align="right" class="sub-total"><i class="fa fa-inr"></i> <span><?= $data['sub_total']; ?></span></td>
                    </tr>
                    <tr>
                      <td colspan="3" align="right">GST (<?= $data['gst_percentage']; ?>)</td>
                      <td align="right" class="gst-total"><i class="fa fa-inr"></i> <span><?= $data['total_gst']; ?></span></td>
                    </tr>
                    <tr>
                      <td colspan="3" align="right">Total</td>
                      <td align="right" class="grand-total"><i class="fa fa-inr"></i> <span><?= $data['total']; ?></span></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-2 col-md-offset-3 pull-right">
                  <a href="<?= base_url('invoice'); ?>" class="pull-right btn btn-primary">Cancel</a>
                  <button id="send" type="submit" class="pull-right btn btn-success">Submit Payment</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>