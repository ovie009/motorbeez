<?php echo $header; ?>
<div class="container">
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?> postcreate"><?php echo $content_top; ?>
      <div class="pull-left">  
        <h1><?php echo $text_list; ?></h1>
      </div>
      <div class="pull-right container-fluid">
        <div class="innertext">
          <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a> 
            <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-post_edit').submit() : false;"><i class="fa fa-trash-o"></i></button>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="well">
        <div class="row">
          <div class="col-sm-3">
            <div class="form-group">
              <label class="control-label" for="input-filter_status"><?php echo $entry_status?></label>
              <select name="filter_status" id="input-filter_status" class="form-control">
                <option value="*"></option>
                <?php if ($filter_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <?php } ?>
                <?php if (!$filter_status && !is_null($filter_status)) { ?>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label class="control-label" for="input-filter_type"> <?php echo $column_type; ?></label>
              <select name="filter_type" id="input-filter_type" class="form-control">
                <option value="*"></option>
                <?php if ($filter_type) { ?>
                <option value="1" selected="selected"><?php echo $text_free; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_free; ?></option>
                <?php } ?>
                <?php if (!$filter_type && !is_null($filter_type)) { ?>
                <option value="0" selected="selected"><?php echo $text_paid; ?></option>
                <?php } else { ?>
                <option value="0"><?php echo $text_paid; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-sm-2 pull-right">
            <button type="button" id="button-filter"  class="btn btn-primary"><i class="fa fa-filter"></i> <?php echo $button_filter; ?></button>
          </div>
        </div> 
      </div>
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-post_edit">
        <div class="table-responsive">
                <table class="table table-hover">
            <thead>
                <tr>
                <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                <td class="text-left"><?php echo $column_image; ?></td>
                <td class="text-left"><?php echo $column_name; ?></td>
                <td class="text-left"><?php echo $column_type; ?></td>
                <td class="text-left"><?php echo $column_status; ?></td>
                <td class="text-left"><?php echo $column_action; ?></td>
                </tr>
            </thead>
            <tbody>
              <?php if ($postedits) { ?>
                <?php foreach ($postedits as $postedit) { ?><tr>
                <td style="width: 1px;" class="text-center"><input type="checkbox"  name="selected[]" value="<?php echo $postedit['post_id']; ?>" /></td>       
                  <td class="text-left"><img src="<?php echo $postedit['image']; ?>"></td>
                  <td class="text-left"><?php echo $postedit['name']; ?></td>
                  <td class="text-left"><?php echo $postedit['type']; ?></td>
                  <td class="text-left"><?php echo $postedit['status']; ?></td>
                    <td class="text-left"><a href="<?php echo $postedit['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
              </tr>
              <?php } ?> 
              <?php } else { ?>
              <tr>
                <td class="text-center" colspan="6">
				<?php echo $text_no_results; ?></td>
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
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<script type="text/javascript">
$('#button-filter').bind('click', function() {
	'use strict';
  var url = 'index.php?route=classified/postcreate';
  
 var filter_status = $('select[name=\'filter_status\']').val();
  if (filter_status != '*') {
    url += '&filter_status=' + encodeURIComponent(filter_status);
  }
  
  var filter_type = $('select[name=\'filter_type\']').val();
  if (filter_type != '*') {
    url += '&filter_type=' + encodeURIComponent(filter_type); 
  }
  location = url;
});
</script>
<?php echo $footer; ?>