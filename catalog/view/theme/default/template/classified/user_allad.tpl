<?php echo $header; ?>
<div class="container">
	  <div class="breadcrumb">
  </div>
   <div id="content">
	  <div class="maincategory">
         <div class="topbar col-sm-12">
		     <div class="row">
				<?php if(!empty($useralladinfos)){ ?>
				<?php foreach ($useralladinfos as $useralladinfo) { ?>
				<div class="product-layout product-list col-lg-12 col-md-12 col-sm-12 col-xs-12 cols">
				   <div class="product-thumb">
					 <div class="image">
						<a href="<?php echo $useralladinfo['view']?>">
							<img src="<?php echo $useralladinfo['singal_post']?>" alt="image" title="image" class="img-responsive" />
						</a>
					</div>
				  
                   <div class="caption">
					  <h4><a href="<?php echo $useralladinfo['view']?>"><?php echo $useralladinfo['title']?></a></h4>
					  <p class="des"><?php echo $text_category; ?> <?php echo $useralladinfo['categoryname']?> <?php echo $useralladinfo['subcategoryname']?> <?php echo $useralladinfo['categorynamesub']?></p>
					  <ul class="list-unstyled">
					     <li><i class="la la-map-marker"></i><?php echo $useralladinfo['city']?> <?php echo $useralladinfo['zonename']?> <?php echo $useralladinfo['namecountry']?></li>
						 <li><i class="la la-clock-o"></i> <?php echo $useralladinfo['date_added']?></li>
				      </ul>
					  <p class="des"><?php echo $useralladinfo['post_description']?></p>
					  <div class="pull-right sticker-img">
					  </div>
  		              <div class="myadsbtn text-center hidden-sm hidden-xs hidden-lg hidden-md  ">
                          <span><button type="button"><?php echo $useralladinfo['price']?></button> </span>
						<button type="button"><i class="la la-heart-o"></i></button>
						<a href="<?php echo $useralladinfo['view']?>"><button type="button"><i class="la la-eye"></i></button></a>
				      </div>
					</div>
					<div class="button-group text-center hidden-sm hidden-xs">
                        <span><button type="button"><?php echo $useralladinfo['price']?></button></span>
						<?php if(!empty($customerlogin)){ ?>
							<span class="favouritediv" rel="<?php echo $useralladinfo['classified_id'];?>">
							<span class="favouritedivs<?php echo $useralladinfo['classified_id'];?>">
							<input type="hidden" name="login_customer_id" value="<?php echo $customerlogin;?>">
							<input type="hidden" name="customer_id" value="<?php echo $useralladinfo['customer_id'];?>">
							<input type="hidden" name="classified_id" value="<?php echo $useralladinfo['classified_id'];?>">
						    </span>
						    <?php if(!empty($useralladinfo['favouritestatus'] == '1')){ ?>
							   <button class="greencolor<?php echo $useralladinfo['classified_id'];?>" rel="<?php echo $useralladinfo['classified_id'];?>" type="button"><i class="la la-heart" style="color:#04CF44;"></i></button>
											    <button class="colorblocak" type="button" style="display:none;"><i class="la la-heart"></i>
                                                </button>
										  <?php } else {  ?>
											<button class="colorblocak<?php echo $useralladinfo['classified_id'];?>"
											 rel="<?php echo $useralladinfo['classified_id'];?>" type="button"><i class="la la-heart" style="color:black;"></i>
											 </button>
											<button class="greencolor<?php echo $useralladinfo['classified_id'];?>" 
												type="button" style="display:none;"><i class="la la-heart"style="color:#04CF44;"></i>
											</button>
											<?php } ?>
										</span>
										<?php }  else{ ?>
                                        <a href="<?php echo $accountlogin;?>"><button type="button"><i class="la la-heart"></i></button></a>
										<?php } ?>
											<a href="<?php echo $useralladinfo['view']?>"><button type="button">
												<i class="la la-eye"></i>
											</button>
											</a>
									  	<?php if(!empty($customerlogin)) { ?>
											<a data-toggle="modal" class="report" data-target=".abuse-modal" href="<?php echo $useralladinfo['enquirypopup'];?>">
                                                <button type="button"><i class="la la-envelope-o"></i></button>
											</a>
											<?php } else{ ?>
										<a href="<?php echo $accountlogin;?>" class="withtout-login"><button type="button"><i class="la la-envelope-o"></i></button></a>

										<?php } ?>
									</div>
								</div>
							</div>

					    	<?php }  } else { ?>
			              <tr>
			                <td class="text-center" colspan="6"><?php echo $text_no_results; ?></td>
							
			              </tr>
			              <?php } ?>
						<div class="row">
						<div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
						<div class="col-sm-6 text-right"><?php echo $results; ?></div>
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
<script>
$('.favouritediv').click(function() {
   var classified_id=$(this).attr('rel');
$.ajax({
	url: 'index.php?route=classified/user_allad/Addfavourite&classified_id='+classified_id,
	type: 'post',
	data: $('.favouritedivs'+classified_id+' input,favouritedivs'+classified_id+' hidden').serialize(),
	dataType: 'json',
	success: function(json) {
		if (json['success']) {
		$('.breadcrumb').after('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				$('html, body').animate({ scrollTop: 0 }, 'slow');

		}
	}
});
});
 </script>
<?php echo $footer; ?>