<div class="row">
  <div class="col-sm-2 pull-left">
    <h1>Invoice</h1>
  </div>
  <div class="col-sm-4 pull-right">
    <img class="logo pull-right" src="<?= base_url('assets/images/logo.png'); ?>">
  </div>
</div>
<div style="height:60px;" class="row">&nbsp;</div>
<div class="row">
  <div class="col-sm-6">
    <p>From</p>
    <p>S. Saravanakumar<br>
      h3@hgmail.com<br>
      4th Street<br>
      Tirupur, TN<br>
      600013<br>
      Phone : +91-95659565</p>
  </div>
  <div class="col-sm-6">
    <p>To</p>
    <p><?= $data['emp_name']; ?><br>
      <?= $data['email']; ?><br>
      <?= $data['address']; ?><br>
      Phone : <?= $data['mobile']; ?></p>
  </div>
</div>
<hr style="border-width:3px;">
<div class="row">
  <div class="col-sm-12">
    <p> Number : <?= $data['inv_no']; ?></p>
    <p>Date : <?= date("F d, Y", strtotime($data['inv_date'])); ?></p>
    <p>Terms : <?= $data['terms']; ?></p>
  </div>
</div>
<div class="row" style="height:40px">&nbsp;</div>
<div class="row">
  <div class="col-sm-12">
    <table class="custom-table table table-hover ">
      <thead>
        <th>Description</th>
        <th>Price</th>
        <th>Qty</th>
        <th style="text-align:right;">Total</th>
      </thead>
      <tbody>
        <?php
        if ($items) {
          foreach ($items as $item) {
            ?>
            <tr>
              <td width="60%"><?= $item['description']; ?></td>
              <td><?= $item['price']; ?></td>
              <td><?= $item['qty']; ?></td>
              <td align="right"><?= $item['total']; ?></td>
            </tr>
          <?php
        }
      }
      ?>
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
        <tr>
          <td colspan="3" align="right">
            <h2><strong>Balance Due</strong></h2>
          </td>
          <td align="right" class="grand-total">
            <h2><strong><i class="fa fa-inr"></i> <span><?= $data['total']; ?></span></strong></h2>
          </td>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
<div class="row" style="height:40px">&nbsp;</div>
<hr style="border-width:3px;">
<div class="row">
  <div class="col-sm-12">
    <h2>Notes</h2>
    <p><?= $data['notes']; ?>
  </div>
</div>