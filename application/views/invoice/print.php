<link href="<?= base_url(); ?>assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<style>
  * {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 12px;
  }

  @media print {
    table {
      -webkit-print-color-adjust: exact;
    }


    table thead th {
      /* background-color: #000 !important; */
      color: #fff !important;
    }

    table tfoot tr td:nth-child(even) {
      font-weight: bold;
    }

    .custom-table tbody,
    .custom-table tfoot tr:nth-child(even) {
      border-bottom: 3px #333333 solid;
    }
  }

  .container-print {
    width: 90%;
    margin: 0 auto;
  }

  .print-logo {
    height: 60px;
    width: 160px;
  }
</style>
<div class="container-print">
  <div class="row">
    <div class="pull-left">
      <h1>Invoice</h1>
    </div>
    <div class="pull-right">
      <h1><img class="print-logo" src="<?= base_url('assets/images/logo.png'); ?>"></h1>
    </div>
  </div>
  <div class="row">
    <div class="pull-left" style="width:50%;">
      <p>From</p>
      <p>S. Saravanakumar<br>
        h3@hgmail.com<br>
        4th Street<br>
        Tirupur, TN<br>
        600013<br>
        Phone : +91-95659565</p>
    </div>
    <div class="pull-right" style="width:50%;">
      <p>To</p>
      <p><?= $data['emp_name']; ?><br>
        <?= $data['email']; ?><br>
        <?= $data['address']; ?><br>
        Phone : <?= $data['mobile']; ?></p>
    </div>
  </div>

  <div class="row" style="height:40px;">
    <hr style="border-width:3px">
  </div>
  <div class="row">
    <p> Number : <?= $data['inv_no']; ?></p>
    <p>Date : <?= date("F d, Y", strtotime($data['inv_date'])); ?></p>
    <p>Terms : <?= $data['terms']; ?></p>
  </div>
  <div class="row" style="height:40px">&nbsp;</div>
  <div class="row">
    <table class="custom-table table table-hover ">
      <thead>
        <th style="background-color:#333 !important;">Description</th>
        <th style="background-color:#333 !important;">Price</th>
        <th style="background-color:#333 !important;">Qty</th>
        <th style="text-align:right;background-color:#333 !important;">Total</th>
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
          <td colspan="3" align="right">GST (<?= $data['gst_percentage']; ?>%)</td>
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
  <div class="row" style="height:20px">&nbsp;</div>
  <hr style="border-width:3px;">
  <div class="row">
    <h4>Notes</h4>
    <p><?= $data['notes']; ?>
  </div>
</div>

<script>
  window.print();
</script>