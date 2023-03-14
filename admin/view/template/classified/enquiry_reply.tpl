<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
	    <div class="container-fluid">
	    
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
	    <?php if ($success) { ?>
	    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
	      <button type="button" class="close" data-dismiss="alert">&times;</button>
	    </div>
	    <?php } ?>
	    <div class="panel panel-default inquiries-tab">
	      <div class="panel-heading">
	        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
	      </div>
		  <div class="panel-body">
		    <div class="response-part" id="response">	
				<div class="row">	
					<div class="col-sm-6">
						<div class="response-box">
							<h2 class="dialog-title catamaran">
							<?php echo $text_response;?>  <span> <?php echo $name;?></span>
							</h2>
							<div class="package-details-container">email:
								 <span> <?php echo $email;?></span>
							</div>
							<div class="package-details-container"><?php echo $text_date;?> <span> <?php echo $date_added;?></span>
							</div>
							
						
							<div class="clearfix"></div>
						</div>
					</div>	
					<div class="col-sm-6">
						<div class="message-customer">
							<div class="message-meta">
								<span class="message-name"><?php echo $name;?> </span><br>
							</div>
							<div class="message-content2">
								<p><?php echo $message;?></p>
							</div>	
						</div>
						
						<div class="client-review">
							<div class="message-history">
								<div class="message-meta">			
									<?php if (isset($message_info)) { ?>
				                	<?php foreach ($message_info as $inquiry_info) { ?>
									<div class="message-content">	
										<p><?php echo $inquiry_info['message']; ?></p>
									
									</div>
									</br> 
		  							 <?php } ?>
				                	<?php } ?>
		  						</div>	
		  					</div>
	 					</div>
    					<div class="form-group">
							<textarea type="text" name="message" value="" placeholder="<?php echo $entry_message; ?>" id="input-message" class="form-control summernote addpack"></textarea>
						</div>
						<div class="text"></div>
						<div class="form-group hide">
	                        <input type="text" name="id" value="<?php echo $id;?>">
						</div>
						<div class="form-group hide">
	                        <input type="text" name="post_id" value="<?php echo $post_id;?>">
						</div>
						<div class="buttons">
							<div class="pull-right">
								<button id="button-history" type="button" data-loading-text="Loading..." class="btn btn-success"> <i class="fa fa-plus-circle"> </i> <?php echo $button_send; ?></button>
							</div>
						
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
 <script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
 <link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
 <script type="text/javascript" src="view/javascript/summernote/opencart.js"></script>  
	<script>
		$('#button-history').click(function(){
			$.ajax({
				url: 'index.php?route=classified/enquiry_reply/postinquiryhistory&token=<?php echo $token; ?>',
				type:'post',
				data: $('#response textarea, #response input'),
				dataType:'json',
					beforeSend: function() {
					$('#button-history').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
				
					},
				success: function(json) {
					
					var text_success_msg = '';
					$('.data-loading-text').html(text_success_msg+json['success']);
					setTimeout(function(e){ $('.close').trigger('click');location.reload();},1000);
			
				}
			});
		});
	</script>
<?php echo $footer; ?> 
