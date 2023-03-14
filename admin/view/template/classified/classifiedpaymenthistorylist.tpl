<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
  </div>
  <div class="container-fluid">
     <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_lists; ?></h3>
      </div>
      <div class="panel-body">
        <form action="" method="post" enctype="multipart/form-data" id="form-enquiry">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left"><?php echo $column_name?></td>
                  <td class="text-left"><?php echo $column_pakagesname?></td>
                  <td class="text-left"><?php echo $column_price?></td>
                  <td class="text-left"><?php echo $column_orderstartus?></td>
                  <td class="text-left"><?php echo $column_expirydate?></td>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($completes_info)) { ?>
                <?php foreach ($completes_info as $result) { ?>
                <tr>
                  <td class="text-left">
                    <input type="checkbox" name="selected[]" value="<?php echo $result['classified_paid_package_id']; ?>" />
                   </td>
                    <td class="text-left"><?php echo $result['customer']; ?></td>
                    <td class="text-left"><?php echo $result['package_name']; ?></td>
                    <td class="text-left"><?php echo $result['price']; ?></td>
                    <td class="text-left"><?php echo $result['order_status']; ?></td>
                    <td class="text-left"><?php echo $result['expirydate']; ?></td>
                 </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="7"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>