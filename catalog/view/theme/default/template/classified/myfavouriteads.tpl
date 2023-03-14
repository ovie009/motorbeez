<?php echo $header; ?>
<div class="topimage">
	 <?php echo $content_top; ?>
</div>
<div class="commontop">
<div class="container">
	<div id="content">
		<div class="maincategory">
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
								<li class="active">
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
					 <?php if ($favsuccess) { ?>
				    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $favsuccess; ?>
				      <button type="button" class="close" data-dismiss="alert">&times;</button>
				    </div>
				    <?php } ?>

					    <div class="row allads">
					    	<?php if(!empty($favouritesinfo)){?>
					    	<?php foreach ($favouritesinfo as $useralladinfo) { ?>
					    		<div  class="productList<?php echo $useralladinfo['classified_id']?>">
					    		<div class="product-layout product-list col-lg-12 col-md-12 col-sm-12 col-xs-12 cols">
								<div class="product-thumb">
								<div class="image">
									<img src="<?php echo $useralladinfo['singal_post']?>" alt="image" title="image" class="img-responsive">
								</div>
									<div class="caption">
										<h4><a href="<?php echo $useralladinfo['view']?>"><?php echo $useralladinfo['title']?></a></h4>
										<p class="des"><?php echo $text_category;?> <?php echo $useralladinfo['categoryname']?> <?php echo $useralladinfo['subcategoryname']?> <?php echo $useralladinfo['categorynamesub']?></p>
										<ul class="list-unstyled">
											<li><i class="la la-map-marker"></i><?php echo $useralladinfo['city']?> <?php echo $useralladinfo['zonename']?> <?php echo $useralladinfo['namecountry']?></li>
											<li><i class="la la-clock-o"></i> <?php echo $useralladinfo['date_added']?></li>
										</ul>
										<hr>
										<p class="des"><?php echo $useralladinfo['post_description']?></p>
										<div class="pull-right sticker-img">
										    <img src="<?php echo $useralladinfo['packagecolorimg'];?>" width="35">
										</div>
										<div class="button-group text-center visible-sm visible-xs">
											<span class="btn-price"> <button type="button"><?php echo $useralladinfo['price']?> </button></span>
											<button type="button"><i class="la la-heart-o"></i></button>
											<a href="<?php echo $useralladinfo['view']?>"><button type="button"><i class="la la-eye"></i></button>
											</a>
										</div>
									</div>
									<div class="button-group text-center hidden-sm hidden-xs">
										<span class="btn-price">
											<button type="button"><?php echo $useralladinfo['price']?></button>
										</span>
										<a href="<?php echo $useralladinfo['view']?>"><button type="button">
											<i class="la la-eye"></i></button>
										</a>
										<a data-toggle="modal" class="report" data-target=".abuse-modal" href="	<?php echo $useralladinfo['enquirypopup']?>">
												<button type="button"><i class="la la-envelope-o"></i></button>
										</a>
										<a href="<?php echo $useralladinfo['delete']?>"> <button type="button"><i class="la la-trash"></i></button>
										</a>	
									</div>
								</div>
										
							 </div>
					
							</div>
					
					    	<?php }  } else { ?>
			               <div class="notfound">
			                <div class="text-center">
							   <?php echo $text_no_results; ?>
							</div>
			              </div>
						  	
			              <?php } ?>
						  
						<div class="row">
						<div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
						<div class="col-sm-6 text-right"><?php echo $results; ?></div>
						</div>
							<div class="clearfix"></div>
					</div>
				  </div>
				</div>
			</div>
	    </div>
	</div>
  </div>
</div>
<div class="modal fade abuse-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<script type="text/javascript">
$(document).on('click','.report',function(e) {
	 $('.modal-report').html('<div class="loader-if centered"></div>');
   $('.abuse-modal').load($(this).attr('href'));
   	window.opener.location.reload();

 });
</script>
<?php echo $footer; ?>