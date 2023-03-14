<?php echo $header; ?>
<form action="<?php echo $action; ?>" method="post" id="ppsubmit">
  <input type="hidden" name="cmd" value="_cart" />
  <input type="hidden" name="upload" value="1" />
  <input type="hidden" name="business" value="<?php echo $business;?>" />
   <?php $i = 1; ?>
  <input type="hidden" name="item_name_<?php echo $i; ?>" value="<?php echo $planname; ?>" />
  <input type="hidden" name="amount_<?php echo $i; ?>" value="<?php echo $price; ?>" />
  <input type="hidden" name="quantity_<?php echo $i; ?>" value="1" />
  <input type="hidden" name="currency_code" value="<?php echo $currency_code; ?>" />
  <input type="hidden" name="first_name" value="<?php echo $first_name; ?>" />
  <input type="hidden" name="address1" value="" />
  <input type="hidden" name="city" value="" />
  <input type="hidden" name="zip" value="" />
  <input type="hidden" name="country" value="" />
  <input type="hidden" name="address_override" value="0" />
  <input type="hidden" name="email" value="<?php echo $email; ?>" />
  <input type="hidden" name="invoice" value="" />
  <input type="hidden" name="lc" value="<?php echo $lc; ?>" />
  <input type="hidden" name="rm" value="2" />
  <input type="hidden" name="no_note" value="1" />
  <input type="hidden" name="no_shipping" value="1" />
  <input type="hidden" name="charset" value="utf-8" />
  <input type="hidden" name="return" value="<?php echo $return; ?>" />
  <input type="hidden" name="notify_url" value="<?php echo $notify_url; ?>" />
  <input type="hidden" name="cancel_return" value="<?php echo $cancel_return; ?>" />
  <input type="hidden" name="paymentaction" value="<?php echo $paymentaction; ?>" />
  <input type="hidden" name="custom" value="<?php echo $customer_id; ?>" />
  <input type="hidden" name="bn" value="OpenCart_2.0_WPS" />
  <div class="buttons" style="display:none">
    <div class="pull-right">
      <input type="submit" value="<?php echo $button_confirm; ?>" class="btn btn-primary" />
    </div>
  </div>
</form>
<div class="container">
  <div class="row">
    <div class="col-sm-6 col-sm-offset-3">
      <div class="classi-loading text-center">
        <img src="<?php echo $loading ;?>" style="width:20%">
      </div>
    </div>
  </div>
</div>

<script type="text/javascript"><!--
setTimeout('Redirect()',2000);
function Redirect(){
  $('#ppsubmit').submit();
}
// --></script>
<?php echo $footer; ?>