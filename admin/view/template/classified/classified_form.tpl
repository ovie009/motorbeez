<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-ebook" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-ebook" class="form-horizontal">
            <div class="tab-content">
           <ul class="nav nav-tabs" id="language">
                <?php foreach ($languages as $language) { ?>
                <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                <?php } ?>
              </ul>
              <div class="tab-content">
                <?php foreach ($languages as $language) { ?>
                <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
                  <div class="form-group required">
                    <label class="col-sm-12 control-label" for="input-title<?php echo $language['language_id']; ?>"><?php echo $entry_title; ?></label>
                    <div class="col-sm-12">
                      <input type="text" name="classified_description[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($classified_description[$language['language_id']]) ? $classified_description[$language['language_id']]['title'] : ''; ?>" placeholder="<?php echo $entry_title; ?>" id="input-title<?php echo $language['language_id']; ?>" class="form-control" />
                      <?php if (isset($error_title[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_title[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-12 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $entry_description; ?></label>
                    <div class="col-sm-12">
                      <textarea name="classified_description[<?php echo $language['language_id']; ?>][post_description]" placeholder="<?php echo $entry_description; ?>" id="input-description<?php echo $language['language_id']; ?>" class="form-control summernote"><?php echo isset($classified_description[$language['language_id']]) ? $classified_description[$language['language_id']]['post_description'] : ''; ?></textarea>
                    </div>
                  </div>
                 </div>
                <?php } ?>
              </div>

            <div class="form-group">
              <label class="col-sm-12 control-label" for="input-category"><?php echo $entry_category?></label>
              <div class="col-sm-12">
              <select class="form-control"  name="classified_category_id">
                  <option value=""><?php echo $text_select; ?></option>
                  <?php foreach ($categorylists as $categorylist) { ?>
                  <?php $selecrd='';if (!empty($categorylist['classified_category_id'] == $classified_category_id)) { ?>                  
                  <?php  $selecrd ='selected';?>
                  <option <?php echo $selecrd;?> value="<?php echo $categorylist['classified_category_id']; ?>">
                  <?php echo $categorylist['name']; ?>
                  </option>
                  <?php } else { ?>
                  <option value="<?php echo $categorylist['classified_category_id']; ?>"><?php echo $categorylist['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
              </select>  
              </div>
            </div>
          
            <div class="subcategoryid" <?php if(empty($classified_id)) { echo 'style="display:none"'; } ?>>

            <div class="form-group">
              <label class="col-sm-12 control-label" for="input-sub-category"><?php echo $entry_sub_category?></label>
              <div class="col-sm-12">
              <select name="sub_category_id" value="" id="input-sub_category_sub" class="form-control">
                
              </select> 
              </div>
            </div>
            </div>

          <div class="sub_subcategoryid" <?php if(empty($classified_id)) { echo 'style="display:none"'; } ?>>
            <div class="form-group">
              <label class="col-sm-12 control-label" for="input-subsubcategory"><?php echo $entry_category_sub_sub?></label>
              <div class="col-sm-12">
              <select name="sub_sub_category_id" value="" id="input-sub_category_sub" class="form-control">
              </select> 
              </div>
            </div>
          </div>
            <div class="postcategory"></div>
             
            <div class="form-group">
              <label class="col-sm-12 control-label" for="input-country"><?php echo $entry_country?></label>
              <div class="col-sm-12">
              <select name="country_id" id="country_id" class="form-control mycountry">
                <option value=""><?php echo $text_select; ?></option>
                <?php foreach ($countries as $country) { ?>
                <?php if ($country['country_id'] == $country_id) { ?>
                <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                <?php } ?>
                <?php } ?>
            </select>  
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-12 control-label" for="input-state"><?php echo $entry_zone?></label>
              <div class="col-sm-12">
               <select name="zone_id" id="input-zone" class="form-control"> 
               <option value=""><?php echo $text_select; ?></option>
             </select>  
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-12 control-label" for="input-city"><?php echo $entry_city?></label>
              <div class="col-sm-12">
                <input type="text" name="city" value="<?php echo $city; ?>" placeholder="<?php echo $entry_city; ?>" id="input-city" class="form-control" />
                <select name="city_id" id="input-city" class="form-control hidden">  
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-12 control-label" for="input-customer"><?php echo $entry_customer?></label>
              <div class="col-sm-12">
                <input type="text" name="customer" value="<?php echo $customer;?>" placeholder="<?php echo $entry_customer; ?>" id="input-customer" class="form-control" />
                  <input type="hidden" name="customer_id" value="<?php echo $customer_id;?>" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-12 control-label" for="input-address"><?php echo $entry_address?></label>
              <div class="col-sm-12">
                <input type="text" name="address" value="<?php echo $address;?>" placeholder="<?php echo $entry_address; ?>" id="input-address" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-12 control-label" for="input-address"><?php echo $entry_location;?></label>
              <div class="col-sm-12">
                  <input type="text" placeholder="<?php echo $text_typelocation;?>" id="geocomplete" class="form-control" />
                  <input type="hidden" name="location" value="<?php echo $location;?>" class="form-control " />
                  <input name="lat" type="hidden" value="<?php echo $lat;?>">
                  <input name="lng" type="hidden" value="<?php echo $long;?>">
                  <div class="map_canvas hide"></div>
              </div>
            </div>
             <div class="form-group">
              <label class="col-sm-12 control-label" for="input-price"><?php echo $entry_price?></label>
              <div class="col-sm-12">
               <input type="text" name="price" value="<?php echo $price;?>" placeholder="<?php echo $entry_price; ?>" id="input-name" class="form-control" />
              </div>
            </div>
				<div class="form-group required">
                <label class="col-sm-2 control-label"><?php echo $entry_postimage; ?></label>
                <div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="singal_post" value="<?php echo $singal_post; ?>" id="input-images_icon" />
                       <?php if($error_post_image){  ?>
                    <div class="text-danger"><?php echo $error_post_image; ?></div>
                  <?php } ?>
                </div>
              </div>
			
			
            <!---images start---->
            <div class="form-group">
            <div class="table-responsive">
                <table id="images" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left"><?php echo $entry_image; ?></td>
                      <td class="text-left" colspan="2"> Action</td>
                    </tr>
                  </thead>
                  <tbody>
                       <?php $image_row = 0; ?>
                    <?php foreach ($post_images as $post_image) { ?>
                    <tr id="image-row<?php echo $image_row; ?>">
                      <td class="text-left"><a href="" id="thumb-image<?php echo $image_row; ?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo $post_image['thumb']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="image[<?php echo $image_row; ?>][image]" value="<?php echo $post_image['image']; ?>" id="input-image<?php echo $image_row; ?>" /></td>
                      <td class="text-right"><button type="button" onclick="$('#image-row<?php echo $image_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                    </tr>
                    <?php $image_row++; ?>
                    <?php } ?>
                  </tbody>
					<tfoot>
						<tr>
						  <td colspan="1"></td>
						  <td class="text-right"><button type="button" onclick="addImage();" data-toggle="tooltip" title="" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
						</tr>
                    </tfoot>
                </table>
              </div>
              </div>
            <!---images end ---->
           
              <div class="form-group">
				<label class="col-sm-2 control-label" for="input-active"><?php echo $entry_active; ?></label>
				<div class="col-sm-12">
				  <select name="active" id="input-active" class="form-control">
					<?php if ($active) { ?>
					<option value="1" selected="selected"><?php echo $text_yes; ?></option>
					<option value="0"><?php echo $text_no; ?></option>
					<?php } else { ?>
					<option value="1"><?php echo $text_yes; ?></option>
					<option value="0" selected="selected"><?php echo $text_no; ?></option>
					<?php } ?>
				  </select>
				</div>
			   </div>
			   
          <div class="form-group">
                <label class="col-sm-12 control-label" for="input-keyword"><span data-toggle="tooltip" title="<?php echo $help_keyword; ?>"><?php echo $entry_keyword; ?></span></label>
                <div class="col-sm-12">
                  <input type="text" name="keyword" value="<?php echo $keyword; ?>" placeholder="<?php echo $entry_keyword; ?>" id="input-keyword" class="form-control" />
                  <?php if ($error_keyword) { ?>
                  <div class="text-danger"><?php echo $error_keyword; ?></div>
                  <?php } ?>
                </div>
              </div>
			   
			   <!---vodeo  start karan ---->
			   <div class="form-group">
						<div class="col-sm-6">
							   <div class="form-group">
							<label class="col-sm-2 control-label" for="input-active"><?php echo $tab_video; ?></label>
							<div class="col-sm-12">
							<select name="video_type" class="form-control videotyp">
							<option><?php echo $text_select;?></option>							
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
							<button type="button"  data-loading-text="<?php echo $text_uploading; ?>" class="btn btn-primary button-upload" ><i class="fa fa-upload"></i></button>
							</span> 
						</div>
				     </div>
						</div>
					</div>
			   </div>
			   <!---vodeo end ---->
			   
			   
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
$('#language a:first').tab('show');
</script>
<script>
$('select[name=\'classified_category_id\']').on('change', function() {
  $.ajax({
    url: 'index.php?route=classified/classifiedadd/categoryclassified_formfiled&token=<?php echo $token; ?>&classified_id=<?php echo $classified_id;?>&classified_category_id=' + this.value,
    dataType: 'html',
      success: function(html) {
      $('.postcategory').html(html);
         
    },
   
  });
   $('select[name=\'classified_id\']').trigger('change');
});
</script>
<script type="text/javascript"><!--
var image_row = <?php echo $image_row; ?>;
function addImage() {
   html  = '<tr id="image-row' + image_row + '">';
   html += '  <td class="text-left"><a href="" id="thumb-image' + image_row + '"data-toggle="image"    class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="image[' + image_row + '][image]" value="" id="input-image' + image_row + '" /></td>';
   html += '  <td class="text-right" colspan="2"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html += '</tr>';
  $('#images tbody').append(html);
  image_row++;
}
//--></script>

<script src="view/javascript/jquery.geocomplete.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $classified_mapkey; ?>&amp;libraries=places"></script>
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
$('select[name=\'country_id\']').bind('change', function() {
  $.ajax({
    url: 'index.php?route=localisation/country/country&token=<?php echo $token; ?>&country_id=' + this.value,
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
</script>
<script type="text/javascript"><!--

$('select[name=\'zone_id\']').bind('change', function() {
  $.ajax({
    url: 'index.php?route=classified/classifiedadd/zone&token=<?php echo $token; ?>&zone_id=' + this.value,
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

$('select[name=\'classified_category_id\']').bind('change', function() {
  $.ajax({
    url: 'index.php?route=classified/classifiedadd/category&token=<?php echo $token; ?>&classified_category_id=' + this.value,
    dataType: 'json',
    beforeSend: function() {
      $('select[name=\'categoryid\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
    },
    complete: function() {
      $('.fa-spin').remove();
    },
    success: function(json) {
      
      html = '<option value=""><?php echo $text_select; ?></option>';

      if (json['subcategory'] && json['subcategory'] != '') {
        for (i = 0; i < json['subcategory'].length; i++) {
          html += '<option value="' + json['subcategory'][i]['classified_category_id'] + '"';

          if (json['subcategory'][i]['classified_category_id'] == '<?php echo $sub_category_id; ?>') {
            html += ' selected="selected"';
          }

          html += '>' + json['subcategory'][i]['name'] + '</option>';
        }
      } else {
        html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
      }

      $('select[name=\'sub_category_id\']').html(html);
      $('select[name=\'sub_category_id\']').trigger('change');
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

//--></script>
<script>
$('select[name=\'sub_category_id\']').bind('change', function() {
  $.ajax({
    url: 'index.php?route=classified/classifiedadd/subcategory&token=<?php echo $token; ?>&classified_category_id=' + this.value,
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

<script>
$(document).ready(function(){
$('select[name=\'classified_category_id\']').bind('change', function() {
  if(this.value != 0) {
    $('.subcategoryid').show();
    
  } else {
    $('.subcategoryid').hide();
   
  }  

 });
});
</script>
<script>
$(document).ready(function(){
$('select[name=\'sub_category_id\']').bind('change', function() {
  if(this.value != 0) {
    $('.sub_subcategoryid').show();
    
  } else {
    $('.sub_subcategoryid').hide();
   
  }  

 });
});
</script>
<script>
    $('input[name=\'customer\']').autocomplete({
    'source': function(request, response) {
    $.ajax({
    url: 'index.php?route=classified/classifiedadd/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
    dataType: 'json',
    success: function(json) {
    json.unshift({
    property_status_id: 0,
    name: '<?php echo $text_none; ?>'
    });

    response($.map(json, function(item) {
    return {
    label: item['name'],
    value: item['customer_id']
    }
    }));
    }
    });
    },
    'select': function(item) {
    $('input[name=\'customer\']').val(item['label']);
    $('input[name=\'customer_id\']').val(item['value']);
    }
    });
	
	
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

$(document).on('click','.button-upload',function() {
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
        url: 'index.php?route=classified/classifiedadd/uploadvideo&token=<?php echo $token; ?>',
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
  
<?php echo $footer; ?>