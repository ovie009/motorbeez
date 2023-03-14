<?php echo $header; ?>
<div class="topimage">
	 <?php echo $content_top; ?>
</div>
<div class="commontop">
<div class="container">
	<div id="content">
 	<!-- ad-single start here -->
	<div class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="dashboard">
					<div class="profile">
						<div class="col-sm-12 col-lg-3 col-md-3  col-xs-12">
						<?php  if(!empty($profileImage)){?>
							<img class="img-responsive" src="<?php echo $profileImage;?>" alt="image" title="<?php echo $firstname;?>">
						 <?php } else { ?>
							 <img class="img-responsive" src="catalog/view/theme/default/image/profile.png" alt="image" title="image">
							<?php
								}
							?>
						</div>
						<div class="col-sm-12  col-lg-9 col-md-9 col-xs-12 padd0">
							<h4><?php echo $firstname;?></h4>
							<div class="common">
								<p class="des"><i class="la la-map-marker"></i> <?php echo $address;?></p>
								<p class="des1"><?php echo $text_account;?> <?php echo $dateadded;?></p>
							</div>
							<ul class="list-inline">
								<li>
									<a href="<?php echo $dashboard?>">
										<i class="fa fa-tachometer" aria-hidden="true"></i><br/>
										<?php echo $text_dashboard;?>
									</a>
								</li>
								<li>
									<a href="<?php echo $myads?>">
										<i class="fa fa-buysellads" aria-hidden="true"></i></i>
										<br/>
										<?php echo $text_myads;?>
									</a>
								</li>
								<li>
									<a href="<?php echo $myfavouriteads?>">
										<i class="fa fa-heart" aria-hidden="true"></i><br/>
										<?php echo $text_favads;?>
									</a>
								</li>
								<li class="active">
									<a href="<?php echo $mymessages?>">
									<i class="fa fa-envelope" aria-hidden="true"></i> <br/>
										<?php echo $text_messages;?></a>
									
								</li>
								<li>
									<a href="<?php echo $mysetting?>">
										<i class="fa fa-cog" aria-hidden="true"></i> <br/>
										<?php echo $text_setting;?>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="inner-message">
						<div class="row">
							<div class="col-sm-12 col-xs-12">
								<div class="msg-box">
									<div class="comments">
										<h2><?php echo $firstname;?></h2>
										<?php if(!empty($messagesinfos)){ ?>
										<?php foreach($messagesinfos as $messagesinfo){ ?>
										<div class="comment">
											<img src="<?php echo $messagesinfo['customerimg']?>" class="img-responsive" alt="image" title="">
											<div class="comment-title">
												 <?php echo $messagesinfo['enqdiscription'];?>
											</div>
										</div>
										<div class="clearfix"></div>
                                     	<div class="comment1">
										<?php if(!empty($messagesinfo['replyinfo'])){ ?>
										<?php foreach ($messagesinfo['replyinfo'] as $messages) { ?>
										<img src="<?php echo $messages['profileImage']?>" class="img-responsive" alt="image" title="image">
										<div class="comment-title">
											<?php echo $messages['message'];?>
										</div>
										<?php } } ?>
										</div>
										<div class="input-group col-sm-12" id="messagesdiv<?php  echo $messagesinfo['classified_enquiry_id']?>">
											<input type="hidden" name="classified_enquiry_id" value="<?php  echo $messagesinfo['classified_enquiry_id']?>">
											<input type="hidden" name="classified_id" value="<?php  echo $messagesinfo['classified_id']?>">
											<input type="hidden" name="login_customer_id" value="<?php  echo $customerlogin;?>">
											<input type="hidden" name="customer_id" value="<?php  echo $messagesinfo['customer_id']?>">
											<input class="form-control" id="comments"  name="message" placeholder="<?php echo $text_typemassage;?>" type="text">
											<button type="button" id="sendMessage" rel="<?php  echo $messagesinfo['classified_enquiry_id']?>" class="replybtn">
											<i class="la la-paper-plane"></i></button>
										</div>
										<div class="favouritclas<?php  echo $messagesinfo['classified_enquiry_id']?>"></div>
										<?php } }  ?>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- ad-single end here -->
	</div>
</div>
</div>
	<script type="text/javascript">
	$('.replybtn').click(function() {
		"use strict";
		var classified_enquiry_id =$(this).attr('rel');
		$.ajax({
		data: $('#messagesdiv'+classified_enquiry_id +' hidden,#messagesdiv'+classified_enquiry_id +' input,#messagesdiv'+classified_enquiry_id +'textarea').serialize(),
		type:   'post',
		dataType:'json',
		url: 'index.php?route=classified/mymessages/replyMsg&classified_enquiry_id='+classified_enquiry_id,
		success: function(json) {
		if(json['success']){
			$('.favouritclas'+classified_enquiry_id).html('<div class="alert alert-success fade in alert-dismissible" style="margin-top:18px;"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><strong>'+json['success']+'</div>');
			setTimeout(function(e){ $('.close').trigger('click');location.reload();},1000);
			$('.textdemo').val('');
			}else{
			if(json['error']){
			$('.favouritclas'+classified_enquiry_id).html('<div class="alert alert-danger"><strong>Warning!</strong> '+json['error']+'</div>');
			setTimeout(function(e){ $('.close').trigger('click');},1000);
			}
		 }
	  }
   });
})

$('.noticemsg').click(function() {
	"use strict";
	$.ajax({
		dataType:'json',
		type:   'post',
		url: 'index.php?route=classified/mymessages/replyReadMsg',
		success: function(json) {
		if(json['success']){
			$('.inquerydiv').hide();

		 }
		}
	});
});
</script>
<?php echo $footer; ?>
