<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-classified_package').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
		<h1><?php echo $list_title; ?></h1>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
	    <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-classified_package">
          <div class="table-responsive">
            <table class="table table-bordered table-hover hidden-xs">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                   
                    <td class="text-left"><?php if ($sort == 'package_icon') { ?>
                    <a href="<?php echo $sort_package_icon; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_icon?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_package_icon; ?>"><?php echo $column_icon?></a>
                    <?php } ?>
                  </td>


                  <td class="text-left"><?php if ($sort == 'package_name') { ?>
                    <a href="<?php echo $sort_package_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_package_name?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_package_name; ?>"><?php echo $column_package_name?></a>
                    <?php } ?>
                  </td>

                  <td class="text-left"><?php if ($sort == 'price') { ?>
                    <a href="<?php echo $sort_price; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_price?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_price; ?>"><?php echo $column_price?></a>
                    <?php } ?>
                  </td>

                  <td class="text-left"><?php if ($sort == 'type') { ?>
                    <a href="<?php echo $sort_type; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_duration?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_type; ?>"><?php echo $column_duration?></a>
                    <?php } ?>
                  </td>

                    <td class="text-left"><?php if ($sort == 'status') { ?>
                    <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_status; ?>"><?php echo $column_status?></a>
                    <?php } ?>
                  </td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($postplacements) { ?>
                <?php foreach ($postplacements as $result) { ?>
                <tr>
                  <td class="text-left"><?php if (in_array($result['package_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $result['package_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $result['package_id']; ?>" />
                    <?php } ?></td>
                   <td class="text-center"><?php if ($result['package_icon']) { ?>
                    <img src="<?php echo $result['package_icon']; ?>" alt="<?php echo $result['package_icon']; ?>" class="img-thumbnail" />
                    <?php } else { ?>
                    <span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
                    <?php } ?></td>

                  <td class="text-left"><?php echo $result['package_name']; ?></td>
                  <td class="text-left"><?php echo $result['price']; ?></td>
                  <td class="text-left"><?php echo $result['type']; ?></td>
                  <td class="text-left"><?php echo $result['status']; ?></td>

                  <td class="text-right"><a href="<?php echo $result['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="4"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
			<table class="table table-bordered table-hover hidden-lg hidden-md hidden-sm">
              <thead>
                <tr>
                  <td class="text-left"><?php if ($sort == 'package_name') { ?>
                    <a href="<?php echo $sort_package_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_package_name?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_package_name; ?>"><?php echo $column_package_name?></a>
                    <?php } ?>
                  </td>
                  <td class="text-left"><?php if ($sort == 'price') { ?>
                    <a href="<?php echo $sort_price; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_price?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_price; ?>"><?php echo $column_price?></a>
                    <?php } ?>
                  </td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($postplacements) { ?>
                <?php foreach ($postplacements as $result) { ?>
                <tr>
                  <td class="text-left"><?php echo $result['package_name']; ?></td>
                  <td class="text-left"><?php echo $result['price']; ?></td>
               <td class="text-right"><a href="<?php echo $result['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="4"><?php echo $text_no_results; ?></td>
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
<script type="text/javascript"></script>
<script>
		$('.date').datetimepicker({
			pickTime: false
		});
</script>
<?php echo $footer; ?>