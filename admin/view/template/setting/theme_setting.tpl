<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-information" id="btnSubmit" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary">
          <i class="fa fa-save">
          </i>
        </button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default">
          <i class="fa fa-reply">
          </i>
        </a>
      </div>
      <h1>
        <?php echo $heading_title; ?>
      </h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li>
          <a href="<?php echo $breadcrumb['href']; ?>">
            <?php echo $breadcrumb['text']; ?>
          </a>
        </li>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-information" class="form-horizontal">
			 <ul class="nav nav-tabs">
				<li class="active"><a href="#tab-header" data-toggle="tab"><?php echo $tab_header; ?></a></li>
				<li><a href="#tab-footer" data-toggle="tab"><?php echo $tab_footer; ?></a></li>
				<li><a href="#tab-banner" data-toggle="tab"><?php echo $tab_map; ?></a></li>
				<li><a href="#tab_socialmedia" data-toggle="tab"><?php echo $tab_socialmedia; ?></a></li>
				<li><a href="#tab-theme" data-toggle="tab"><?php echo $tab_theme; ?></a></li>
          	</ul>
			<div class="tab-content">
            	
				<div class="tab-pane active" id="tab-header">
					<div class="table-responsive">
						<table id="hdr" class="table table-striped table-bordered table-hover">
							<tbody>	
								<tr>
									<td><input  type="radio"  name="classified_header" value="header1" <?php if($classified_header =='header1') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img class="img-responsive" src="view/image/headers/h1.png" alt="" /></td>
									<td class="text-left"><?php echo $text_header1; ?></td>
								</tr>
								<tr>
									<td><input  type="radio"  name="classified_header" value="header2" <?php if($classified_header =='header2') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img class="img-responsive"  src="view/image/headers/h2.png" alt=""/></td>
									<td class="text-left"><?php echo $text_header2; ?></td>
								</tr>
								<tr>
									<td><input  type="radio"  name="classified_header" value="header3" <?php if($classified_header =='header3') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img class="img-responsive" src="view/image/headers/h3.png" alt="" /></td>
									<td class="text-left"><?php echo $text_header3; ?></td>
								</tr>
							
							</tbody>
						</table>
					</div>	
				</div>
				<div class="tab-pane " id="tab-footer">
					<div class="table-responsive">
						<table id="hdr" class="table table-striped table-bordered table-hover">
							<tbody>	
								<tr>
									<td><input  type="radio"  name="classified_footer" value="footer1" <?php if($classified_footer =='footer1') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img class="img-responsive" src="view/image/footer/f1.png" alt=""/></td>
									<td class="text-left"><?php echo $text_footer1; ?></td>
								</tr>
								<tr>
									<td><input  type="radio"  name="classified_footer" value="footer2" <?php if($classified_footer =='footer2') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img class="img-responsive" src="view/image/footer/f2.png" alt=""/></td>
									<td class="text-left"><?php echo $text_footer2; ?></td>
								</tr>
								<tr>
									<td><input  type="radio"  name="classified_footer" value="footer3" <?php if($classified_footer =='footer3') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img class="img-responsive" src="view/image/footer/f3.png" alt=""/></td>
									<td class="text-left"><?php echo $text_footer3; ?></td>
								</tr>
							
							</tbody>
						</table>
					</div>
				</div>

		<div class="tab-pane " id="tab-banner">
			<div class="tab-content">
	           <div class="form-group">
              <label class="col-sm-2 control-label" for="input-height"><?php echo $text_mapkey?></label>
              <div class="col-sm-10">
              <input name="classified_mapkey" value="<?php echo $classified_mapkey?>" placeholder="<?php echo $text_mapkey;?>" 
              id="input-height" class="form-control" type="text">
              </div>
          </div>
           </div>
		</div>
	
				<div class="tab-pane" id="tab_socialmedia">
			<div class="form-group">
                <label class="col-sm-2 control-label" for="input-flogo"><?php echo $entry_ftlogo?></label>
                <div class="col-sm-10">
				<a href="" id="thumb-flogo" data-toggle="image" class="img-thumbnail"><img src="<?php echo $flogo; ?>" alt="" title="" data-placeholder="<?php echo $flogo; ?>" /></a>
                  <input type="hidden" name="classified_footerlogo" value="<?php echo $classified_footerlogo; ?>" id="input-flogo" />
                </div>
                </div>
             
				   <div class="form-group">
					<label class="col-sm-2 control-label" for="input-footerdesc"><?php echo $entry_footerdesc; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="classified_footerdesc" value="<?php echo $classified_footerdesc; ?>" placeholder="<?php echo $entry_footerdesc; ?>" id="input-footerdesc" class="form-control">
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
			</div>

			<div class="tab-pane" id="tab-theme">
					<div class="table-responsive">
						<table id="hdr" class="table table-striped table-bordered table-hover">
							<tbody>	
								<tr>
									<td style="height:20px; width:20px;"><input  type="radio"  name="classified_theme" value="green"<?php if($classified_theme =='green') { echo "checked='checked'"; }?>/></td>
								
									<td class="text-left" style="background:#20C063;height:29px; width:100px;"></td>
										<td class="text-left">Green</td>
								</tr>

								<tr>
									<td style="height:20px; width:20px;"><input  type="radio"  name="classified_theme" value="blue"<?php if($classified_theme =='blue') { echo "checked='checked'"; }?>/></td>
								
									<td class="text-left" style="background:#3498db;height:29px; width:100px;"></td>
										<td class="text-left">Blue</td>
								</tr>
								<tr>
									<td style="height:20px; width:20px;"><input  type="radio"  name="classified_theme" value="sky"<?php if($classified_theme =='sky') { echo "checked='checked'"; }?>/></td>
								
									<td class="text-left" style="background:#4BC7D2;height:29px; width:100px;"></td>
										<td class="text-left">Sky Blue</td>
								</tr>
								<tr>
									<td style="height:20px; width:20px;"><input  type="radio"  name="classified_theme" value="orange"<?php if($classified_theme =='orange') { echo "checked='checked'"; }?>/></td>
								
									<td class="text-left" style="background:#e67f22;height:29px; width:100px;"></td>
										<td class="text-left">Orange </td>
								</tr>	
								<tr>
									<td style="height:20px; width:20px;"><input  type="radio"  name="classified_theme" value="purple"<?php if($classified_theme =='purple') { echo "checked='checked'"; }?>/></td>
									<td class="text-left" style="background:#8e44ad;height:29px; width:100px;"></td>
									<td class="text-left">Purple </td>
								</tr>
								<tr>
									<td style="height:20px; width:20px;"><input  type="radio"  name="classified_theme" value="pink"<?php if($classified_theme =='pink') { echo "checked='checked'"; }?>/></td>
									<td class="text-left" style="background:#ff1493;height:29px; width:100px;"></td>
									<td class="text-left">Pink </td>
								</tr>
								<tr>
									<td style="height:20px; width:20px;"><input  type="radio"  name="classified_theme" value="default"<?php if($classified_theme =='default') { echo "checked='checked'"; }?>/></td>
									<td class="text-left" style="background:#FED700;height:29px; width:100px;"></td>
									<td class="text-left">Default </td>
								</tr>
								
							</tbody>
						</table>
					</div>
				</div>
				
			</div>	
			
		</form>
    </div>
    </div>
  </div>
  <script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
  <link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
  <script type="text/javascript" src="view/javascript/summernote/opencart.js"></script>  
  <script src="view/javascript/colorbox/jquery.minicolors.js"></script>
<link rel="stylesheet" href="view/javascript/colorbox/jquery.minicolors.css">
<script>
    $(document).ready( function() {
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
  <script type="text/javascript"><!--
$('#language a:first').tab('show');
//--></script>
 
<?php echo $footer; ?></div>
