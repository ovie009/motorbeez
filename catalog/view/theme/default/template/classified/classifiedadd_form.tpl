<?php echo $header; ?>
<div class="container">
  
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
 
      <div class="add">
        <div class="addtop">
          <h1><?php echo $heading_title; ?></h1>
        </div>
        <?php if ($error_warning) { ?>
          <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
              <button type="button" class="close" data-dismiss="alert">&times;</button>
          </div>
        <?php } ?>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal addform">
          <fieldset id="account">
            <ul class="nav nav-tabs" id="language">
            <?php foreach ($languages as $language) { ?>
              <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="catalog/language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
            <?php } ?>
          </ul>

            <div class="tab-content">
              <?php foreach ($languages as $language) { ?>
                <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
                  <div class="form-group required">
                          <label class="control-label" for="input-title"> <?php echo $entry_title; ?>  </label>
                        <input type="text" name="classified_description[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($classified_description[$language['language_id']]) ? $classified_description[$language['language_id']]['title'] : ''; ?>" placeholder="<?php echo $entry_title; ?>" id="input-title<?php echo $language['language_id'];?>" class="form-control" />
                         <?php if (isset($error_title[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_title[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>

                  <div class="form-group">
                    <label class="control-label" for="input-description"><?php echo $entry_description; ?></label>
                    <textarea name="classified_description[<?php echo $language['language_id']; ?>][post_description]" placeholder="<?php echo $entry_description; ?>" id="input-description<?php echo $language['language_id'];?>" class="form-control summernote"> <?php echo isset($classified_description[$language['language_id']]) ? $classified_description[$language['language_id']]['post_description'] : ''; ?> </textarea>
                   </div>
                </div>
            <?php } ?>
            </div>

           <div class="form-group" id="activeli">
               <label><?php echo $text_selectcategory; ?></label>
                <ul class="nav nav-tabs list-inline">
                  <?php foreach ($categorylists as $categorylist) { ?>

                  <li class="<?php if ($categorylist['classified_category_id']==$classified_category_id) { echo 'active'; }?>">
                    <a href="#<?php echo $categorylist['name']; ?>" class="classifid_category toggleclass<?php echo $categorylist['classified_category_id']; ?>" id="<?php echo $categorylist['classified_category_id']; ?>" aria-hidden="true" data-toggle="tab">
                     
                    <input type="hidden" name="classified_category_id" value="<?php echo $categorylist['classified_category_id']; ?>"/>
					 <img src="<?php echo $categorylist['categoryimage']; ?>" alt="<?php echo $categorylist['name']; ?>" title="<?php echo $categorylist['name']; ?>" class="img-responsive"></a>
				 </li>
                     <?php } ?>
                     <input type="hidden" name="classified_category_id" value="<?php echo $classified_category_id; ?>"/>
                </ul>
            </div>
           <div class="subcategoryid" <?php if(empty($classified_id) || empty($sub_category_id)) { echo 'style="display:none"'; } ?>>
             <div class="form-group">
                <label class="control-label"><?php echo $entry_category_sub;?></label>
                <select name="sub_category_id" id="input-sub_category_sub" class="form-control">
                <option value=""><?php echo $text_select; ?></option>
                <?php foreach ($subcategory as $result) { ?>
                <?php if ($result['classified_category_id'] == $sub_category_id) { ?>
                <option value="<?php echo $result['classified_category_id']; ?>" selected="selected"><?php echo $result['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $result['classified_category_id']; ?>"><?php echo $result['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="sub_subcategoryid" <?php if(empty($classified_id) || empty($sub_sub_category_id)) { echo 'style="display:none"'; } ?>>
            <div class="form-group">
      					<label class="control-label"><?php echo $entry_category_sub_sub; ?></label>
                  <select name="sub_sub_category_id" id="input-subsub_category_sub" class="form-control">
                    <option value=""><?php echo $text_select; ?></option>
                      <?php foreach ($sub_subcategory as $result) { ?>
                  <?php if ($result['classified_category_id'] == $sub_sub_category_id) { ?>
                  <option value="<?php echo $result['classified_category_id']; ?>" selected="selected"><?php echo $result['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $result['classified_category_id']; ?>"><?php echo $result['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
      				    </select>
      				  </div>
            </div>
            <div class="postcategory"></div>
		    
		   <div class="form-group required">
					  <label class="control-label" for="country_id"> <?php echo $entry_country;?> </label>
						<select name="country_id" id="country_id" class="form-control mycountry">
						    <option value="162" selected="selected">PAKISTAN</option>
							<option value=""><?php echo $text_select; ?></option>
							
				<?php foreach ($countries as $country) { ?>
				<?php if ($country['country_id'] == $country_id) { ?>
				<option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
				<?php } else { ?>
				<option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
				<?php } ?>
				<?php } ?>
					   </select>
					   
				<?php if ($error_country) { ?>
					<div class="text-danger"><?php echo $error_country; ?></div>
				<?php } ?>
				   
			</div>
			  <div class="form-group required">
					<label class="control-label" for="country_id"> <?php echo $entry_state;?></label>
					  <select name="zone_id" id="input-zone" class="form-control">
			   <option value=""><?php echo $text_select; ?></option>
			 </select>
				<?php if ($error_zone) { ?>
					<div class="text-danger"><?php echo $error_zone; ?></div>
				<?php } ?>
			 </div>
			<div class="form-group">
				<label class="control-label" for="city_id"> <?php echo $entry_city;?></label>
			    <input type="text" name="city" value="<?php echo $city; ?>" placeholder="<?php echo $entry_city; ?>" id="input-city" class="form-control" />
      	<select name="city_id" class="form-control hidden">
					<option value=""><?php echo $text_select; ?></option>
				</select>
			</div>
      <div class="form-group">
        <label class="control-label" for="address"> <?php echo $entry_address;?></label>
          <input type="text" name="address" value="<?php echo $address; ?>" placeholder="<?php echo $entry_address; ?>" id="input-address" class="form-control" />
      </div>
			<div class="form-group">
					<label class="control-label" for="country_id"> <?php echo $text_location;?></label>
					<input id="geocomplete" class="form-control" type="text" placeholder="<?php echo $text_typeaddress;?>" />
					<input type="hidden" name="location" class="form-control"  value="<?php echo $location;?>" />
					<input name="lat" type="hidden" value="<?php echo $lat;?>">
					<input name="lng" type="hidden" value="<?php echo $long;?>">
					<div class="map_canvas hide"></div>
					   
			</div>
			<div class="form-group required">
				<label class="control-label" for="thumb-image"> <?php echo $entry_image;?></label>
			</div>				
			<div class="row marging-bottoms">
				<div class="">
				<div class="imagebox">
					<span id="thumb-image">
					<img src="<?php echo $profileImage;?>" data-placeholder="<?php echo $placeholder; ?>" id="thumb-image-add">
					</span>
				</div>
					<button type="button" id="button-upload" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default btn-block"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
					<input type="hidden" name="singal_post" value="<?php echo $singal_post;?>" id="input-image-add"/>
				<?php if ($error_post_image) { ?>
				   <div class="text-danger"><?php echo $error_post_image; ?></div>
				<?php } ?>
			 </div>
			</div>
		
			<div class="clearfix"></div>
			<div class="clearfix"></div>
			<div class="form-group">
				<label class="control-label" for="input-uploader"><?php echo $entry_images;?></label>
					<div class="row">
						<div id="uploader"></div>
					</div>
			</div>
	  <?php if(!empty($post_images)) { ?>
      <div class="form-group">
            <div class="table-responsive">
                <table id="images" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left"><?php echo $entry_otherimages; ?></td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>
                       <?php $image_row = 0; ?>
                    <?php foreach ($post_images as $post_image) { ?>
                    <tr id="image-row<?php echo $post_image['classified_img_id']; ?>">
                      <td class="text-left"><img src="<?php echo $post_image['thumb']; ?>" id="input-image<?php echo $image_row; ?>" /></td>
                      <td class="text-right">
                        <button type="button" onclick="deleteimage(<?php echo $post_image['classified_img_id']; ?>);" data-toggle="tooltip" title="" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                    </tr>
                    <?php $image_row++; ?>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="3"></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              </div>
              <?php } ?>
          </fieldset>
          <div class="form-group">
              <label class="control-label" for="input-price"><?php echo $entry_price; ?> </label>
              <input type="text" name="price" value="<?php echo $pricer; ?>" placeholder="<?php echo $entry_price; ?>" id="input-price" class="form-control" />
          </div>
		  <!---vodeo start --->
			   <div class="form-group">
						<div class="col-sm-6 row">
							   <div class="form-group">
							<label class="col-sm-2 control-label" for="input-active"><?php echo $tab_video; ?></label>
							<div class="col-sm-12">
							<select name="video_type" class="form-control videotyp">
							<option value="0"><?php echo $text_select;?></option>							
							<?php foreach ($videotypes as $videotype) { ?>
							 <?php if($videotype['value'] == $video_type){ ?>
							 	 <option value="<?php echo $videotype['value']; ?>" selected="selected"><?php echo $videotype['name']; ?></option>
							 <?php } else{ ?>
							   <option value="<?php echo $videotype['value']; ?>"><?php echo $videotype['name']; ?></option>
							<?php } }  ?>
							</select>
							</div>
						   </div>
					   </div>
					   
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-4 control-label" for="input-active"><?php echo $text_upload; ?></label>
							<div class="row"></div>
							<div class="col-sm-12">
							<div class="video_youtube"   
							<?php if ($video_type=='youtube'){ ?>
							style="display:block;"
							<?php } else {?> 
							style="display:none;"
							<?php } ?>>
							<input type="text" name="youtube_video" value="<?php echo $youtube_video;?>" placeholder="" class="form-control" />
							</div>
							<div class="video_vimeo"   
							<?php if ($video_type=='vimeo'){ ?>
							style="display:block;"
							<?php } else {?> 
							style="display:none;"
							<?php } ?>>
							<input type="text" name="video_vimeo" value="<?php echo $video_vimeo;?>" placeholder="" class="form-control" />
							</div>
						<div class="input-group video_upd"
						<?php if ($video_type == 'upload'){ ?>
							style="display:block;"
							<?php } else {?> 
							style="display:none;"
							<?php } ?>>
							<input type="text" name="upload_video" value="<?php echo $upload_video;?>" placeholder="" class="form-control" id="upload-video-image" />
							<span class="input-group-btn">
							<button type="button"  data-loading-text="<?php echo $text_uploading; ?>" class="btn btn-primary button-upload-video" ><i class="fa fa-upload"></i></button>
							</span> 
						</div>
				        </div>
				     
						</div>
					</div>
			   </div>
			   <!---vodeo end ---->
          <div class="form-group">
           <div class="buttons pull-right">           
            <?php if(!empty($payment_status)) { ?>
            <?php if($currentdate > $expirydate && empty($customer_id)) { ?>
              <button type="button" data-toggle="modal"  data-target="#myModal" class="btn btn-primary">
                  <?php echo $button_continue; ?>
                </button>           
                <?php } elseif($classified_limit <= $total_classified && empty($customer_id)) { ?>
                  <button type="button" data-toggle="modal"  data-target="#myModal" class="btn btn-primary">
                 <?php echo $button_continue; ?>
                </button> 
                <?php } else { ?>
                 <input type="submit" value="<?php echo $button_continue; ?>" class="btn btn-primary" />
                <?php } ?>
                
                <?php } else { ?>
                 <input type="submit" value="<?php echo $button_continue; ?>" class="btn btn-primary" />
                <?php } ?>
           </div>
        </div>
       </div>
     </form>
      </div>
      <?php echo $content_bottom; ?>
    </div>
    <?php echo $column_right; ?>
  </div>
</div>

<!-- model -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    <div class="tab-first"></div>
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      <?php if($currentdate > $expirydate) { ?>
          <h3 class="modal-title"><b><?php echo $text_error_planexpiry; ?></b></h3>
      <?php } else { ?>
            <h3 class="modal-title"><b><?php echo $text_error_planrenew; ?></b></h3>
            <?php } ?> 
        </div>
      </div>
    </div>
  </div>
<style> 
 div.required .control-label:not(span):before, td.required:before {
    content: '* ';
    color: #F00;
    font-weight: bold;
}
</style>

<!-- model -->
<!-- map  api-->
<link rel="stylesheet" href="catalog/view/javascript/uploader/jquery.ui.plupload.css" type="text/css" />
<link rel="stylesheet" href="catalog/view/javascript/uploader/jquery.plupload.queue.css" type="text/css" />
<script type="text/javascript" src="catalog/view/javascript/uploader/browserplus-min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/uploader/plupload.js"></script>
<script type="text/javascript" src="catalog/view/javascript/uploader/plupload.gears.js"></script>
<script type="text/javascript" src="catalog/view/javascript/uploader/plupload.silverlight.js"></script>
<script type="text/javascript" src="catalog/view/javascript/uploader//plupload.flash.js"></script>
<script type="text/javascript" src="catalog/view/javascript/uploader/plupload.browserplus.js"></script>
<script type="text/javascript" src="catalog/view/javascript/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="catalog/view/javascript/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="catalog/view/javascript/uploader/jquery.ui.plupload.js"></script>
<script type="text/javascript" src="catalog/view/javascript/uploader/jquery.plupload.queue.js"></script>
<script>
  $('#language a:first').tab('show');

 $('button[id^=\'button-upload\']').on('click', function() {
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
					url: 'index.php?route=classified/classifiedadd/addClass',
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
							
							$("#thumb-image").html('<img src="'+json['location1']+'" alt="" title="" />');
							$("#input-image-add").val(json['location']);
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
<script>
$('.classifid_category').on('click', function() {
   var classified_category_id = $(this).attr('id');
    $('input[name=\'classified_category_id\']').val(classified_category_id);
 $.ajax({
    url: 'index.php?route=classified/classifiedadd/categoryclassified_formfiled&classified_id=<?php echo $classified_id;?>&classified_category_id=' + classified_category_id,
    dataType: 'html',
    success: function(html) {
    $('.postcategory').html(html);
  $(".active").removeAttr("style");
      
    }

});
  
   

});
	$('select[name=\'classifid_category\']').trigger('change');
</script>
 <?php if(!empty($classified_category_id)){ ?>
 <script>
 	$('select[name=\'classifid_category\']').trigger('change');
	</script>
 <?php } else {  ?>
  <script>
	$('.classifid_category:first').trigger('click');
	$("#activeli li:first").addClass("active");
	$("#activeli li:last").removeClass('active');
 
 </script>
 <?php } ?>
<script>
$(document).ready(function(){
$('select[name=\'sub_category_id\']').on('change', function() {
  if(this.value != 0) {
    $('.sub_subcategoryid').show();

  } else {
    $('.sub_subcategoryid').hide();

  }
});
});
</script>
<script>
$('.classifid_category').bind('click', function() {
'use strict';
    var classified_category_id = $(this).attr('id');

  $.ajax({
    url: 'index.php?route=classified/classifiedadd/category&classified_category_id=' + classified_category_id,
    dataType: 'json',
    beforeSend: function() {
      $('select[name=\'categoryid\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
    },
    complete: function() {
      $('.fa-spin').remove();
    },
    success: function(json) {

      var html = '<option value=""><?php echo $text_select; ?></option>';

      if (json['subcategory'] && json['subcategory'] != '') {
        $('.subcategoryid').show();

        for (var i = 0; i < json['subcategory'].length; i++) {
          html += '<option value="' + json['subcategory'][i]['classified_category_id'] + '"';

          if (json['subcategory'][i]['classified_category_id'] == '<?php echo $sub_category_id; ?>') {
            html += ' selected="selected"';
          }

          html += '>' + json['subcategory'][i]['name'] + '</option>';
        }
      }

       else {
        html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
        $('.subcategoryid').hide();

      }

    $('select[name=\'sub_category_id\']').html(html);
    $('select[name=\'sub_category_id\']').trigger('change');
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});
//-->
</script>
<script>
$('select[name=\'sub_category_id\']').bind('change', function() {
  $.ajax({
    url: 'index.php?route=classified/classifiedadd/subcategory&classified_category_id=' + this.value,
    dataType: 'json',
    beforeSend: function() {
      $('select[name=\'sub_category_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
    },
    complete: function() {
      $('.fa-spin').remove();
    },
    success: function(json) {

      html = '<option value=""><?php echo $text_select; ?></option>';

      if (json['sub_subcategory'] && json['sub_subcategory'] != '') {
        for (i = 0; i < json['sub_subcategory'].length; i++) {
          html += '<option value="' + json['sub_subcategory'][i]['classified_category_id'] + '"';

          if (json['sub_subcategory'][i]['classified_category_id'] == '<?php echo $sub_sub_category_id; ?>') {
            html += ' selected="selected"';
          }

           html += '>' + json['sub_subcategory'][i]['name'] + '</option>';
        }
      } else {
        html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
            $('.sub_subcategoryid').hide();

      }

      $('select[name=\'sub_sub_category_id\']').html(html);
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

$('select[name=\'classified_category_id\']').trigger('change');
</script>
<script type="text/javascript">
// Convert divs to queue widgets when the DOM is ready
$(function() {
	'use strict';
	// Setup html5 version
	$("#uploader").pluploadQueue({
		// General settings
		runtimes : 'html5',
		url : 'catalog/controller/classified/upload.php',
		max_file_size : '10mb',
		chunk_size : '1mb',
		unique_names : true,
		multi_selection:true,
		multiple_queues: true,
		filters : [
			{title : "Image files", extensions : "jpg,jpeg,gif,png"},
			
		],
		// Duplicate images Remove
		init: {
			FilesAdded: function (up, files) {
				//Newly loaded Function
				for (var i = 0; i < up.files.length; i++) {
					for (var j = 1; j < up.files.length; j++) {
						if (up.files[i].name == up.files[j].name && i != j) {
							alert('Error File ' + up.files[i].name + ' already exists. !');
							up.splice(i, 1);
							//Here I am to delete duplicate files exists

						}
					}
				}
			}
		},


	});
	// Client side form validation
	$('form').submit(function(e) {
		var uploader = $('#uploader').pluploadQueue();
      
            uploader.bind('StateChanged', function() {
                if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
                    $('form')[0].submit();
                }
            });
			   uploader.start();
	

		
    });
});

function deleteimage(classified_img_id){

	if(classified_img_id){
		$.ajax({
		url: 'index.php?route=classified/classifiedadd/deleteimg&classified_img_id='+classified_img_id,
		type: 'post',
		data: 'classified_img_id='+classified_img_id,
		dataType: 'json',
		success: function(json) {
		$('.alert, .text-danger').remove();


		if (json['success']) {
			$('#image-row'+classified_img_id).remove();
			}
		}
		});
	}
	}
</script>
<script type="text/javascript"><!--
$('select[name=\'country_id\']').bind('change', function() {
  $.ajax({
    url: 'index.php?route=classified/classifiedadd/country&country_id=' + this.value,
    dataType: 'json',
    beforeSend: function() {
      $('select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
    },
    complete: function() {
      $('.fa-spin').remove();
    },
    success: function(json) {
      if (json['postcode_required'] == '1') {
        $('input[name=\'postcode\']').parent().parent().addClass('required');
      } else {
        $('input[name=\'postcode\']').parent().parent().removeClass('required');
      }

      html = '<option value=""><?php echo $text_select; ?></option>';

      if (json['zone'] && json['zone'] != '') {
        for (i = 0; i < json['zone'].length; i++) {
          html += '<option value="' + json['zone'][i]['zone_id'] + '"';

          if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
            html += ' selected="selected"';
          }

          html += '>' + json['zone'][i]['name'] + '</option>';
        }
      } else {
        html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
      }

      $('select[name=\'zone_id\']').html(html);
      $('select[name=\'zone_id\']').trigger('change');
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});
//--></script>
   
<script src="catalog/view/javascript/jquery.geocomplete.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $classified_mapkey;?>&amp;libraries=places"></script>
    <script>
      jQuery(function(){
        jQuery("#geocomplete").geocomplete({
          map: ".map_canvas",
          details: "form ",
          markerOptions: {
            draggable: true
          }
        });
        jQuery("#geocomplete").bind("geocode:dragged", function(event, latLng){
          jQuery("input[name=lat]").val(latLng.lat());
          jQuery("input[name=lng]").val(latLng.lng());
          jQuery("#reset").show();
        });
        jQuery("#reset").click(function(){
          jQuery("#geocomplete").geocomplete("resetMarker");
          jQuery("#reset").hide();
          return false;
        });

        jQuery("#find").click(function(){
          jQuery("#geocomplete").trigger("geocode");
        }).click();
      });
    </script>

    <script type="text/javascript"><!--

$('select[name=\'zone_id\']').bind('change', function() {
  $.ajax({
    url: 'index.php?route=classified/classifiedadd/zone&zone_id=' + this.value,
    dataType: 'json',
    beforeSend: function() {
      $('select[name=\'zone_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
    },
    complete: function() {
      $('.fa-spin').remove();

    },
    success: function(json) {

    html = '<option value=""><?php echo $text_select; ?></option>';

    if (json['city'] && json['city'] != '') {
    for (i = 0; i < json['city'].length; i++) {
      html += '<option value="' + json['city'][i]['city_id'] + '"';

      if (json['city'][i]['city_id'] == '<?php echo $city_id; ?>') {
        html += ' selected="selected"';
      }

      html += '>' + json['city'][i]['cityname'] + '</option>';
    }
    } else {
    html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
    }

    $('select[name=\'city_id\']').html(html);

    },

    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }


  });
});
 $('select[name=\'country_id\']').trigger('change');
</script>
<script>

	$(document).on('change','.videotyp',function() {
    var valuee = this.value;
    if(valuee =='vimeo'){
      $('.video_vimeo').show(); 
    }else{
       $('.video_vimeo').hide(); 
    }  

    if(valuee =='youtube'){
      $('.video_youtube').show(); 
    }else{
       $('.video_youtube').hide(); 
    }
    if(valuee =='upload'){
      $('.video_upd').show(); 
    }else{
       $('.video_upd').hide(); 
    }
});

$(document).on('click','.button-upload-video',function() {
  var node = this;

  $('#form-upload-video').remove();
  
  $('body').prepend('<form enctype="multipart/form-data" id="form-upload-video" style="display: none;"><input type="file" name="file" /></form>');

  $('#form-upload-video input[name=\'file\']').trigger('click');
  
  if (typeof timer != 'undefined') {
      clearInterval(timer);
  }
  
  timer = setInterval(function() {
    if ($('#form-upload-video input[name=\'file\']').val() != '') {
      clearInterval(timer);   
      
      $.ajax({
        url: 'index.php?route=classified/classifiedadd/uploadvideo',
        type: 'post',   
        dataType: 'json',
        data: new FormData($('#form-upload-video')[0]),
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
          if (json['error']) {
            alert(json['error']);
          }
          if (json['success']) {
             $('#upload-video-image').val(json['filename']);

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
<script type="text/javascript" src="catalog/view/javascript/summernote/summernote.js"></script>
<link href="catalog/view/javascript/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="catalog/view/javascript/summernote/opencart.js"></script>
<?php echo $footer; ?>