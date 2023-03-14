<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-post_placement_price" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        </div>
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
          <!---product-start---->
            <div class="form-group">
              <label class="col-sm-2 control-label"><?php echo $entry_classfiedadd; ?></label>
              <div class="col-sm-8">
               <input type="text" name="classified_classified" value="<?php echo $classified_classified;?>"  class="form-control"/>
               <input type="hidden" name="classified_classified_id" value="<?php echo $classified_classified_id;?>"  class="form-control"/>
              </div>
            </div>
            <!---product-end ---->
            <div class="tab-content">
               <div class="form-group">
              <label class="col-sm-2 control-label"><span data-toggle="tooltip" title=""><?php echo $entry_title; ?></span></label>
               <div class="col-sm-8">
                 <input type="text" name="classified_titlecolor" value="<?php echo $classified_titlecolor; ?>"  class="form-control color"  />
              </div>
            </div>
               <div class="form-group">
              <label class="col-sm-2 control-label"><span data-toggle="tooltip" title=""><?php echo $entry_price; ?></span></label>
               <div class="col-sm-8">
                 <input type="text" name="classified_pricecolor" value="<?php echo $classified_pricecolor; ?>"  class="form-control color"  />
              </div>
            </div>
			    	<div class="form-group hide">
              <label class="col-sm-2 control-label"><span data-toggle="tooltip" title=""><?php echo $entry_iconcolor; ?></span></label>
              <div class="col-sm-8">
               <input type="text" name="classified_iconcolor" value="<?php echo $classified_iconcolor; ?>"  class="form-control color"  />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"><span data-toggle="tooltip" title=""><?php echo $entry_iconborder; ?></span></label>
              <div class="col-sm-8">
               <input type="text" name="classified_bordercolor" value="<?php echo $classified_bordercolor; ?>"  class="form-control color"  />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"><span data-toggle="tooltip" title=""><?php echo $entry_searchbtncolor; ?></span></label>
              <div class="col-sm-8">
               <input type="text" name="classified_searchbtncolor" value="<?php echo $classified_searchbtncolor; ?>"  class="form-control color"  />
              </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label"><span data-toggle="tooltip" title=""><?php echo $entry_listbuttoncolor; ?></span></label>
              <div class="col-sm-8">
               <input type="text" name="classified_listgridbtncolor" value="<?php echo $classified_listgridbtncolor; ?>"  class="form-control color"  />
              </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><span data-toggle="tooltip" title=""><?php echo $entry_filtertitle; ?></span></label>
              <div class="col-sm-8">
               <input type="text" name="classified_filtertitlecolor" value="<?php echo $classified_filtertitlecolor; ?>"  class="form-control color"  />
              </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><span data-toggle="tooltip" title=""><?php echo $entry_filterbg; ?></span></label>
              <div class="col-sm-8">
               <input type="text" name="classified_filterbgcolor" value="<?php echo $classified_filterbgcolor; ?>"  class="form-control color"  />
              </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><span data-toggle="tooltip" title=""><?php echo $entry_dashboardtabactive; ?></span></label>
              <div class="col-sm-8">
               <input type="text" name="classified_dashboardtabbgcolor" value="<?php echo $classified_dashboardtabbgcolor; ?>"  class="form-control color"  />
              </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label"><span data-toggle="tooltip" title=""><?php echo $entry_dashboardhoverbg; ?></span></label>
              <div class="col-sm-8">
                <input type="text" name="classified_dashboardhoverbgcolor" value="<?php echo $classified_dashboardhoverbgcolor; ?>"  class="form-control color"  />
              </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><span data-toggle="tooltip" title=""><?php echo $entry_dashboardtxtcolor; ?></span></label>
              <div class="col-sm-8">
               <input type="text" name="classified_dashboardtextcolor" value="<?php echo $classified_dashboardtextcolor; ?>"  class="form-control color"  />
              </div>
            </div>
             <div class="form-group">
              <label class="col-sm-2 control-label"><span data-toggle="tooltip" title=""><?php echo $entry_dashboardhovertxtcolor; ?></span></label>
              <div class="col-sm-8">
               <input type="text" name="classified_dashboardhovertextcolor" value="<?php echo $classified_dashboardhovertextcolor; ?>"  class="form-control color"  />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"><span data-toggle="tooltip" title=""><?php echo $entry_dashboardbtnbg; ?></span></label>
              <div class="col-sm-8">
               <input type="text" name="classified_dashboardbtnbgcolor" value="<?php echo $classified_dashboardbtnbgcolor; ?>"  class="form-control color"  />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"><span data-toggle="tooltip" title=""><?php echo $entry_dashboardsticker; ?></span></label>
              <div class="col-sm-8">
               <input type="text" name="classified_dashboardstickerbgcolor" value="<?php echo $classified_dashboardstickerbgcolor; ?>"  class="form-control color"  />
              </div>
            </div>
		
			<div class="form-group">
                <label class="col-sm-2 control-label" for="input-icon"><span data-toggle="tooltip" title="" data-original-title="The icon should be a PNG that is 16px x 16px."><?php echo $classified_bannerads?></span></label>
                <div class="col-sm-10">
				<a href="" id="thumb-icon" data-toggle="image" class="img-thumbnail"><img src="<?php echo $icon; ?>" alt="" title="" data-placeholder="<?php echo $icon; ?>" /></a>
                  <input type="hidden" name="classified_icon" value="<?php echo $classified_icon; ?>" id="input-icon" />
                </div>
                </div>
              </div>
          <div class="form-group">
              <label class="col-sm-2 control-label" for="input-width"><?php echo $text_width?></label>
              <div class="col-sm-10">
              <input name="classified_width" value="<?php echo $classified_width?>" placeholder="<?php echo $text_width?>" 
              id="input-width" class="form-control" type="text">
              </div>
          </div>
           <div class="form-group">
              <label class="col-sm-2 control-label" for="input-height"><?php echo $text_height?></label>
              <div class="col-sm-10">
              <input name="classified_height" value="<?php echo $classified_height?>" placeholder="<?php echo $text_height;?>" 
              id="input-height" class="form-control" type="text">
              </div>
          </div>
			<div class="form-group required">
					<label class="col-sm-2 control-label" for="input-telephone"><?php echo $text_mapapi; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="classified_mapkey" value="<?php echo $classified_mapkey; ?>" placeholder="Google Map key" id="input-mapkey" class="form-control">
					 </div>
                </div>
            <div class="form-group">
					<label class="col-sm-2 control-label" for="input-fb"><?php echo $entry_facebook; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="classified_fb" value="<?php echo $classified_fb; ?>" placeholder="<?php echo $entry_facebook; ?>" id="input-fb" class="form-control">
					 </div>
                </div>
	            <div class="form-group">
					<label class="col-sm-2 control-label" for="input-twitter"><?php echo $entry_twitter; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="classified_twitter" value="<?php echo $classified_twitter; ?>" placeholder="<?php echo $entry_twitter; ?>" id="input-twitter" class="form-control">
					 </div>
                </div>
            <div class="form-group">
					<label class="col-sm-2 control-label" for="input-google"><?php echo $entry_google; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="classified_google" value="<?php echo $classified_google; ?>" placeholder="<?php echo $entry_google; ?>" id="input-google" class="form-control">
					 </div>
                </div>
            <div class="form-group">
					<label class="col-sm-2 control-label" for="input-instgram"><?php echo $entry_instgram; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="classified_instgram" value="<?php echo $classified_instgram; ?>" placeholder="<?php echo $entry_instgram; ?>" id="input-instgram" class="form-control">
					 </div>
                </div>
            <div class="form-group">
					<label class="col-sm-2 control-label" for="input-youtube"><?php echo $entry_youtube; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="classified_youtube" value="<?php echo $classified_youtube; ?>" placeholder="<?php echo $entry_youtube; ?>" id="input-youtube" class="form-control">
					 </div>
                </div>
            <div class="form-group">
					<label class="col-sm-2 control-label" for="input-linkdin"><?php echo $entry_linkdin; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="classified_linkdin" value="<?php echo $classified_linkdin; ?>" placeholder="<?php echo $entry_linkdin; ?>" id="input-linkdin" class="form-control">
					 </div>
                </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="view/javascript/colorbox/jquery.minicolors.js"></script>
<link rel="stylesheet" href="view/javascript/colorbox/jquery.minicolors.css">
<script>
    $(document).ready( function() {
      "use strict";
            $('.color').each(function() {
           $(this).minicolors({
          control: $(this).attr('data-control') || 'hue',
          defaultValue: $(this).attr('data-defaultValue') || '',
          inline: $(this).attr('data-inline') === 'true',
          letterCase: $(this).attr('data-letterCase') || 'lowercase',
          opacity: $(this).attr('data-opacity'),
          position: $(this).attr('data-position') || 'bottom left',
          change: function(hex, opacity) {
            if( !hex ) return;
            if( opacity ) hex += ', ' + opacity;
            try {
              console.log(hex);
            } catch(e) {}
          },
          theme: 'bootstrap'
        });
                
            });
      
    });
</script>
<script>
    $('input[name=\'classified_classified\']').autocomplete({
    'source': function(request, response) {
    $.ajax({
    url: 'index.php?route=classified/classified_setting/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
    dataType: 'json',
    success: function(json) {
    json.unshift({
    property_status_id: 0,
    name: '<?php echo $text_none; ?>'
    });

    response($.map(json, function(item) {
    return {
    label: item['name'],
    value: item['classified_classified_id']
    }
    }));
    }
    });
    },
    'select': function(item) {
    $('input[name=\'classified_classified\']').val(item['label']);
    $('input[name=\'classified_classified_id\']').val(item['value']);
    }
    });
  </script>

<?php echo $footer; ?>
