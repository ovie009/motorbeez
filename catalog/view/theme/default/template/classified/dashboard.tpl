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
						<div class="col-sm-12 col-lg-3  col-md-3 col-xs-12">
						 <?php  if(!empty($profileImage)){?>
							<img class="img-responsive" src="<?php echo $profileImage;?>" alt="image" title="<?php echo $firstname;?>">
						 <?php } else { ?>
							 <img class="img-responsive" src="catalog/view/theme/default/image/profile.png" alt="image" title="image">
							<?php
								}
							?>
						</div>
						<div class="col-sm-12 col-md-9 col-lg-9 col-xs-12 padd0">
							<h4><?php echo $firstname;?></h4>
							<div class="common">
								<p class="des"> <i class="la la-map-marker"></i>
									<?php echo $address;?>
								</p>
							
								<p class="des1"><?php echo $text_account;?> <?php echo $dateadded;?></p>
							</div>
							<ul class="list-inline">
								<li class="active">
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
								<li>
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
					<div class="inner">
						<h2 class="text-left"> <?php echo $text_about;?></h2>
						<p><?php echo $profile_text;?> </p>
					</div>
					<ul class="list-inline icons">
						<li>
							<a href="<?php echo $myads?>">
								<div class="img">
									<img src="catalog/view/theme/default/image/dashboard/cardboard.png" alt="image" title="<?php echo $text_myads;?>" />
								</div>
								<p><?php echo $text_myads;?></p>
								<p> <?php echo $totalCust_classified;?></p>
							</a>
						
						</li>
						<li>
							<a href="<?php echo $mymessages?>">
								<div class="img"><img src="catalog/view/theme/default/image/dashboard/messages.png" alt="image" title="<?php echo $text_messages;?>" /></div><p><?php echo $text_messages;?></p>
							
								<p> <?php echo $totalMsg_classified;?></p>
							</a>
						

						</li>
						<li>
							<a href="<?php echo $myfavouriteads?>">
								<div class="img">
									<img src="catalog/view/theme/default/image/dashboard/like.png" alt="image" title="<?php echo $text_favads;?>" />
								</div>
									<p>
										<?php echo $text_favads;?>
									</p>	
									<p>
										<?php echo $totalFav_classified;?>
									</p>
							</a>
						

						</li>
						<?php  if(!empty($payment_status)){ ?>
						<li class="plannew">
							<a href="<?php echo $renewplan?>">
								<div class="img">
									<img src="catalog/view/theme/default/image/dashboard/cardboard.png" alt="image" title="<?php echo $text_renew;?>" />
								</div>
								<p><?php echo $text_renew;?></p>
								<p><?php echo $text_planad;?></p>
							</a>
						</li>
						<?php } ?>
						
					<?php  if(!empty($custpayment_status)){ ?>
						<li class="plannew">
							<a target="_blank" href="<?php echo $custinvoice?>">
								<div class="img">
									<img src="catalog/view/theme/default/image/dashboard/messages.png" alt="image" title="<?php echo $text_printinvoice;?>" />
								</div>
								<p><?php echo $text_printinvoice;?></p>
								<p> <?php echo $text_planrend;?></p>
							</a>
						</li>
				<?php } ?>
					</ul>
				</div>
			</div>
	</div>
<!-- ad-single end here -->
	</div>
</div>
</div>
<script type="text/javascript">
$('.noticemsgg').click(function() {
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
