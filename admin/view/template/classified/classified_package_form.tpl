<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-post_placement_price" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1><br/>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-post_placement_price" class="form-horizontal">
            <div class="tab-content">
				<div class="form-group required">
					<label class="col-sm-2 control-label"> <?php echo $label_name;?></label>
					<div class="col-sm-10">
						<input type="text" name="package_name" value="<?php echo $package_name;?>"  placeholder="<?php echo $label_name;?>" id="input-package_name" class="form-control">
					     <?php if ($error_name) { ?>
                      <div class="text-danger"><?php echo $error_name; ?></div>
                      <?php } ?>
					</div>
				</div>
			    <div class="form-group required">
					<label class="col-sm-2 control-label"><?php echo $label_price;?></label>
					<div class="col-sm-10">
					  <input type="text" name="price" value="<?php echo $price;?>"  placeholder="<?php echo $label_price;?>" id="input-price" class="form-control">
					  <?php if ($error_price) { ?>
                      <div class="text-danger"><?php echo $error_price; ?></div>
                      <?php } ?>
					</div>
               </div>
                
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo $entry_package_duration;?></label>
					<div class="col-sm-2">
					 <select name="no_of_day" id="input-no_of_day" class="form-control">
						<?php foreach ($days as $day) { ?>
							<option value="<?php echo $day;?>" <?php if($day== $no_of_day) echo "selected"; ?>><?php echo $day;?></option>
						    <?php } ?>
					   </select>
					
					</div>
					<div class="col-sm-3">
						<select name="type" id="input-type" class="form-control">
							<option value="year" <?php if($type== "year") echo "selected"; ?>> <?php echo $entry_one_years;?></option>
							<option value="month" <?php if($type== "month") echo "selected"; ?>>  <?php echo $entry_one_month;?></option>	
							<option value="week" <?php if($type== "week") echo "selected"; ?>> <?php echo $entry_one_week;?></option>
							<option value="day" <?php if($type== "day") echo "selected"; ?>><?php echo $entry_one_day;?></option>
						</select>
					</div>
				</div>	
				   <div class="form-group">
					<label class="col-sm-2 control-label"><?php echo $entry_classifiedlimit;?></label>
					<div class="col-sm-10">
					  <input type="text" name="classified_limit" value="<?php echo $classified_limit;?>"  placeholder="<?php echo $entry_classifiedlimit;?>" id="input-classified_limit" class="form-control">
					</div>
               </div>
				<div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_sticker_icon; ?></label>
                <div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="package_icon" value="<?php echo $package_icon; ?>" id="input-images_icon" />
         
                </div>
              </div>
				 <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <select name="status" id="input-status" class="form-control">
                    <?php if ($status) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
		  </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
<link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="view/javascript/summernote/opencart.js"></script>
<script type="text/javascript">
	$('button[id^=\'button-upload\']').bind('click', function() {
		"use strict";
	var node = this;

	$('#form-upload').remove();

	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

	$('#form-upload input[name=\'file\']').trigger('click');

	if (typeof timer != 'undefined') {
			clearInterval(timer);
	}
	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);

			$.ajax({
				url: 'index.php?route=classified/post_placement_price_list/upload',
				type: 'post',
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$(node).button('loading');
				},
				complete: function() {
					$(node).button('reset');
				},
				success: function(json) {
					$('.text-danger').remove();

					if (json['error']) {
						$(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
					}

					if (json['success']) {
						var imageurl="<?php echo str_replace('http:','',HTTP_SERVER)?>";
						$("#thumb-image").html('<img src="'+imageurl+"image/"+json['location1']+'" alt="" title="" width="100"/>');
						$("#input-image").val(json['location1']);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
	});
</script>

<?php echo $footer; ?>
