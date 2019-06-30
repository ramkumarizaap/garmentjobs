<style>
  *,
  table td {
    font-size: 12px;
    color: grey;
  }

  h2 {
    text-transform: uppercase
  }

  .inv-info tr {
    line-height: 20px;
  }

  .item-table td.border-line {
    border-bottom: 1px solid black;
  }

  .item-table tr.header td {
    background-color: #333;
    color: #fff;
  }

  .sm-font {
    font-size: 10px;
  }

  .balance-txt {
    font-size: 16px;
  }
</style>
<table width=95%>
  <tbody>
    <tr>
      <td width="50%">
        <h2 style="font-size:18px;">Invoice</h2>
      </td>
      <td align="right" width="50%">
        <div style="height:0px;">&nbsp;</div>
        <img src="<?= base_url('assets/images/logo.png'); ?>" style="height:35px;width:115px;">
      </td>
    </tr>
    <tr>
      <td style="height:30px">&nbsp;</td>
    </tr>
    <tr>
      <td width="50%">From</td>
      <td width="50%">To</td>
    </tr>
    <tr>
      <td>Ramkumar</td>
      <td><?= $data['c_name']; ?></td>
    </tr>
    <tr>
      <td>sramkum@gmail.com</td>
      <td><?= $data['c_email']; ?></td>
    </tr>
    <tr>
      <td>Chennai</td>
      <td><?= $data['c_address']; ?></td>
    </tr>
    <tr>
      <td>Phone : +91-9566588960</td>
      <td>Phone : +<?= $data['c_mobile']; ?></td>
    </tr>
  </tbody>
</table>
<div style="height:40px;">&nbsp;</div>
<hr style="width:100%;border:width:3px">
<div style="height:40px;">&nbsp;</div>

<table class="inv-info" width=90%>
  <tbody>
    <tr>
      <td>Number : <?= $data['inv_no']; ?></td>
    </tr>
    <tr>
      <td>Date : <?= date("F d, Y", strtotime($data['notes'])); ?></td>
    </tr>
    <tr>
      <td>Terms : <?= $data['terms']; ?></td>
    </tr>
  </tbody>
</table>
<div style="height:30px;">&nbsp;</div>

<table width="100%" class="item-table">
  <tbody>
    <tr class="header">
      <td width="55%" style="line-height:20px;">Description</td>
      <td width="15%" style="line-height:20px;">Price</td>
      <td width="15%" style="line-height:20px;">Qty</td>
      <td width="15%" align="right" style="line-height:20px;">Total</td>
    </tr>
    <tr>
      <td style="line-height:20px;">&nbsp;</td>
    </tr>
    <?php
    if ($items) {
      foreach ($items as $item) {
        ?>
        <tr>
          <td class="border-line"><?= $item['description']; ?></td>
          <td class="border-line"><img valign="middle" height="10" src="<?= base_url('assets/images/inr.png'); ?>">&nbsp;<?= $item['price']; ?></td>
          <td class="border-line"><?= $item['qty']; ?></td>
          <td align="right" class="border-line">
            <img height="10" valign="middle" src="<?= base_url('assets/images/inr.png'); ?>">&nbsp;<?= $item['total']; ?></td>
        </tr>
        <tr>
          <td style="line-height:20px;">&nbsp;</td>
        </tr>
      <?php }
  }; ?>
    <tr>
      <td class="sm-font" align="right" colspan="2">
        Subtotal
      </td>
      <td class="sm-font" align="right" colspan="2">
        <img height="10" valign="middle" src="<?= base_url('assets/images/inr.png'); ?>">&nbsp;<?= $data['sub_total']; ?>
      </td>
    </tr>
    <tr>
      <td class="sm-font border-line" align="right" colspan="2">
        GST (18%)
      </td>
      <td class="border-line sm-font" colspan="2" align="right">
        <img height="10" valign="middle" src="<?= base_url('assets/images/inr.png'); ?>">&nbsp;<?= $data['total_gst']; ?>
      </td>
    </tr>
    <tr>
      <td style="line-height:20px;">&nbsp;</td>
    </tr>
    <tr>
      <td class="sm-font" align="right" colspan="2">
        Total
      </td>
      <td class="sm-font" colspan="2" align="right">
        <img height="10" valign="middle" src="<?= base_url('assets/images/inr.png'); ?>">&nbsp;<?= $data['total']; ?>
      </td>
    </tr>
    <tr>
      <td style="line-height:10px;">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" colspan="2">
        <strong>
          <span class="balance-txt">Balance Due</span>
        </strong>
      </td>
      <td colspan="2" align="right">
        <img height="10" valign="middle" src="<?= base_url('assets/images/inr.png'); ?>">&nbsp;<?= $data['total']; ?>
      </td>
    </tr>
    <tr>
      <td style="line-height:10px;">&nbsp;</td>
    </tr>
  </tbody>
</table>
<hr style="width:100%;border-width:3px">
<h3>Notes</h3>
<p style="font-size:10px;"><?= $data['notes']; ?></p>