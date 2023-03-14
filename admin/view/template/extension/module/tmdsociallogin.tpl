<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-tmdsociallogin" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
	   <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-setting" data-toggle="tab"><?php echo $tab_setting; ?>  <i class="fa fa-cog fa-fw"></i></a></li>
            <li><a href="#tab-facbook" data-toggle="tab"><?php echo $tab_facbook; ?>  <i class="fa fa-facebook"></i></a></li>
            <li><a href="#tab-twitter" data-toggle="tab"><?php echo $tab_twitter; ?>  <i class="fa fa-twitter-square"></i></a></li>
            <li><a href="#tab-google" data-toggle="tab"><?php echo $tab_google; ?>  <i class="fa fa-google"></i></a></li>
            <li><a href="#tab-linkedin" data-toggle="tab"><?php echo $tab_linkedin; ?>  <i class="fa fa-linkedin-square"></i></a></li>
          </ul>
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-tmdsociallogin" class="form-horizontal">
          
		<div class="tab-content">
			<div class="tab-pane active in" id="tab-setting">
			  
			<div class="form-group">
				<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
				<div class="col-sm-10">
				  <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
				  <?php if ($error_name) { ?>
				  <div class="text-danger"><?php echo $error_name; ?></div>
				  <?php } ?>
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
			
			<div class="tab-pane" id="tab-facbook">
			
			<div class="form-group">
				<label class="col-sm-2 control-label" for="input-fbtitle"><?php echo $entry_title; ?></label>
				<div class="col-sm-10">
				  <input type="text" name="fbtitle" value="<?php echo $fbtitle; ?>" placeholder="<?php echo $entry_title; ?>" id="input-fbtitle" class="form-control" />
				</div>
			</div>
			
		 
			  
			<div class="form-group">
		        <label class="col-sm-2 control-label" for="input-fbapikey"><?php echo $entry_apikey; ?></label>  
				
				<div class="col-sm-6">
					<input type="text" name="fbapikey" id="fb-apikey" value="<?php echo $fbapikey; ?>" class="form-control"/> 
		         
				 <?php if ($error_fbapikey) { ?>
				  <div class="text-danger"><?php echo $error_fbapikey; ?></div>
				  <?php } ?>
		         </div>
				 <div class="col-sm-4">
					<?php echo $text_fblink; ?>
		         </div>
			</div>
			
			 <div class="form-group">
			    <label class="col-sm-2 control-label" for="input-fbsecretapi"><?php echo $entry_apisecret; ?></label>  
				 
				 <div class="col-sm-10">
				 <input type="text" name="fbsecretapi" id="fb-apisecret" value="<?php echo $fbsecretapi; ?>" class="form-control"/> 
				 <?php if ($error_fbsecretapi) { ?>
				  <div class="text-danger"><?php echo $error_fbsecretapi; ?></div>
				  <?php } ?>
				 </div>
			</div>
			
			  
			<div class="form-group">
				<label class="col-sm-2 control-label" for="input-fbstatus"><?php echo $entry_status; ?></label>
				<div class="col-sm-10">
				  <select name="fbstatus" id="input-fbstatus" class="form-control">
					<?php if ($fbstatus) { ?>
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
			
			<div class="tab-pane" id="tab-twitter">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-twittertitle"><?php echo $entry_title; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="twittertitle" value="<?php echo $twittertitle; ?>" placeholder="<?php echo $entry_title; ?>" id="input-twittertitle" class="form-control" />
					</div>
				</div>
				
			
				
				<div class="form-group">
		        <label class="col-sm-2 control-label" for="input-twitapikey"><?php echo $entry_twapikey; ?></label>  
				
				<div class="col-sm-6">
					<input type="text" name="twitapikey" id="twit-apikey" value="<?php echo $twitapikey; ?>" class="form-control"/> 
		           <?php if ($error_twitapikey) { ?>
				  <div class="text-danger"><?php echo $error_twitapikey; ?></div>
				  <?php } ?>
		         </div>
				 <div class="col-sm-4">
					<?php echo $text_twitlink; ?>
		         </div>
				</div>
			
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-twitsecretapi"><?php echo $entry_twapisecret; ?></label>  
					 
					 <div class="col-sm-10">
					 <input type="text" name="twitsecretapi" id="twit-apisecret" value="<?php echo $twitsecretapi; ?>" class="form-control"/> 
					   <?php if ($error_twitsecret) { ?>
				  <div class="text-danger"><?php echo $error_twitsecret; ?></div>
				  <?php } ?>
					 </div>
				</div>
			
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-twitstatus"><?php echo $entry_status; ?></label>
					<div class="col-sm-10">
					  <select name="twitstatus" id="input-twitstatus" class="form-control">
						<?php if ($twitstatus) { ?>
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
			
			<div class="tab-pane" id="tab-google">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-googletitle"><?php echo $entry_title; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="googletitle" value="<?php echo $googletitle; ?>" placeholder="<?php echo $entry_title; ?>" id="input-googletitle" class="form-control" />
					</div>
				</div>
				
				
				
				<div class="form-group">
		        <label class="col-sm-2 control-label" for="input-gogleapikey"><?php echo $entry_goapikey; ?></label>  
				
				<div class="col-sm-6">
					<input type="text" name="gogleapikey" id="gogle-apikey" value="<?php echo $gogleapikey; ?>" class="form-control"/> 
		         
				 <?php if ($error_gogleapikey) { ?>
				  <div class="text-danger"><?php echo $error_gogleapikey; ?></div>
				  <?php } ?>
				  
		         </div>
				 <div class="col-sm-4">
					<?php echo $text_gogllink; ?>
		         </div>
				</div>
			
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-gogelsecretapi"><?php echo $entry_goapisecret; ?></label>  
					 
					 <div class="col-sm-10">
					 <input type="text" name="gogelsecretapi" id="gogle-secret" value="<?php echo $gogelsecretapi; ?>" class="form-control"/>
					
					<?php if ($error_goglesecret) { ?>
				  <div class="text-danger"><?php echo $error_goglesecret; ?></div>
				  <?php } ?>
				  	
					 </div>
				</div>
			
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-goglestatus"><?php echo $entry_status; ?></label>
					<div class="col-sm-10">
					  <select name="goglestatus" id="input-goglestatus" class="form-control">
						<?php if ($goglestatus) { ?>
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
			
			<div class="tab-pane" id="tab-linkedin">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-linkedintitle"><?php echo $entry_title; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="linkedintitle" value="<?php echo $linkedintitle; ?>" placeholder="<?php echo $entry_title; ?>" id="input-linkedintitle" class="form-control" />
					</div>
				</div>
				
			
				
				<div class="form-group">
		        <label class="col-sm-2 control-label" for="input-linkdinapikey"><?php echo $entry_liapikey; ?></label>  
				
				<div class="col-sm-6">
					<input type="text" name="linkdinapikey" id="linkdin-apikey" value="<?php echo $linkdinapikey; ?>" class="form-control"/> 
		         <?php if ($error_linkdinapikey) { ?>
				  <div class="text-danger"><?php echo $error_linkdinapikey; ?></div>
				  <?php } ?>
				  	  
		         </div>
				 <div class="col-sm-4">
					<?php echo $text_linkdinlink; ?>
		         </div>
			</div>
			
			 <div class="form-group">
			    <label class="col-sm-2 control-label" for="input-linkdinsecretapi"><?php echo $entry_liapisecret; ?></label>  
				 
				 <div class="col-sm-10">
				 <input type="text" name="linkdinsecretapi" id="linkdin-apisecret" value="<?php echo $linkdinsecretapi; ?>" class="form-control"/>
				
				<?php if ($error_linkdinsecret) { ?>
				  <div class="text-danger"><?php echo $error_linkdinsecret; ?></div>
				  <?php } ?>				 
				 </div>
			</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-linkstatus"><?php echo $entry_status; ?></label>
					<div class="col-sm-10">
					  <select name="linkstatus" id="input-linkstatus" class="form-control">
						<?php if ($linkstatus) { ?>
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
			
		</div>
		</div>
    </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
  <script type="text/javascript"><!--
$('#language a:first').tab('show');
//--></script>