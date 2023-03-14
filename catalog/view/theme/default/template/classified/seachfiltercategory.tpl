	<div class="resultshow"></div>
		<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
			<div class="row allads">
					<?php if(!empty($classifiedseachs)){ ?>
					<?php foreach ($classifiedseachs as $classifiedseach) { ?>
					<div class="product-layout product-list col-lg-12 col-md-12 col-sm-12 col-xs-12 cols">
						<div class="product-thumb">
							<?php foreach ($classifiedseach['img'] as $images) { ?>
							<div class="image">
								<a href="<?php echo $classifiedseach['view']?>"><img src="<?php echo $images['imguser']?>" alt="image" title="image" class="img-responsive"></a>
							</div>
							<?php } ?>

							<div class="caption">
								<h4><a href="<?php echo $classifiedseach['view']?>"><?php echo $classifiedseach['title']?></a></h4>
								<p class="des">Category:<?php echo $classifiedseach['categoryname']?> <?php echo $classifiedseach['subcategoryname']?> <?php echo $classifiedseach['categorynamesub']?></p>
								<ul class="list-unstyled">
									<li><i class="la la-map-marker"></i><?php echo $classifiedseach['city']?> <?php echo $classifiedseach['zonename']?> <?php echo $classifiedseach['namecountry']?></li>
									<li><i class="la la-clock-o"></i> <?php echo $classifiedseach['date_added']?></li>
					
								</ul>
								<hr>
								<p class="des"><?php echo $classifiedseach['post_description']?></p>
								<div class="pull-right sticker-img">
									<img src="<?php echo $classifiedseach['packagecolorimg'];?>" width="35">
								</div>
								<div class="myadsbtn text-center visible-sm visible-xs">
									<span><button type="button"><?php echo $classifiedseach['price']?> </button></span>
									<button type="button"><i class="la la-heart-o"></i></button>
									<a href="<?php echo $classifiedseach['view']?>"><button type="button"><i class="la la-eye"></i></button></a>
								</div>
							</div>
							<div class="myadsbtn text-center hidden-sm hidden-xs">
								<span><button type="button"><?php echo $classifiedseach['price']?></button></span>
								<?php if(!empty($customerlogin)){ ?>
								<span class="favouritediv" rel="<?php echo $classifiedseach['classified_id'];?>">
								<span class="favouritedivs<?php echo $classifiedseach['classified_id'];?>">
								<input type="hidden" name="login_customer_id" value="<?php echo $customerlogin;?>">
								<input type="hidden" name="customer_id" value="<?php echo $classifiedseach['customer_id'];?>">
								<input type="hidden" name="classified_id" value="<?php echo $classifiedseach['classified_id'];?>">
								</span>
								  <?php if(!empty($classifiedseach['favouritestatus'] == '1')){ ?>
									<button class="greencolor<?php echo $classifiedseach['classified_id'];?>" rel="<?php echo $classifiedseach['classified_id'];?>" type="button"><i class="la la-heart" 
										style="color:#04CF44;"></i></button>
										<button class="colorblocak" type="button" style="display:none;"><i class="la la-heart"></i>
										</button>
								  <?php } else {  ?>
									<button class="colorblocak<?php echo $classifiedseach['classified_id'];?>"
									 rel="<?php echo $classifiedseach['classified_id'];?>" type="button"><i class="la la-heart" style="color:#000000;"></i>
									 </button>
									<button class="greencolor<?php echo $classifiedseach['classified_id'];?>" 
										type="button" style="display:none;"><i class="la la-heart"style="color:#04CF44;"></i>
									</button>
									<?php } ?>
								</span>
								<?php }  else{ ?>
								<a href="<?php echo $accountlogin;?>"><button type="button"><i class="la la-heart"></i></button></a>
								<?php } ?>
									<a href="<?php echo $classifiedseach['view']?>">
										<button type="button">
											<i class="la la-eye"></i>
										</button>
									</a>
									<?php if(!empty($customerlogin)){ ?>
									<a data-toggle="modal" class="report" data-target=".abuse-modal"
									 href="<?php echo $classifiedseach['enquirypopup'];?>">
										<button type="button">
											<i class="la la-envelope-o"></i>
										</button>
									</a>
									<?php } else { ?>
										<a class="withtout-login" href="<?php echo $accountlogin;?>">
											<button type="button">
												<i class="la la-envelope-o"></i>
											</button>
										</a>
									<?php } ?>
							</div>
						</div>
					</div>
					<?php } ?>
					<?php } else { ?>
					 <div class="notfound col-sm-12">
						 <div class="text-center notfoundimg">
							<img src="catalog/view/theme/default/image/no-resultfoun.png" class="">
						  
						 </div>
					 </div>
				   <?php } ?>
				<div class="resultpage">
					<div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
					<div class="col-sm-6 text-right"><?php echo $results; ?></div>
				</div>				
			</div>
		</div>
<script type="text/javascript">
	$(document).on('click','.report',function(e) {
	$('.modal-report').html('<div class="loader-if centered"></div>');
	$('.abuse-modal').load($(this).attr('href'));
	window.opener.location.reload();
	});
$('.favouritediv').click(function() { 
   var classified_id=$(this).attr('rel');
$.ajax({
	url: 'index.php?route=classified/classified_view/Addfavourite&classified_id='+classified_id,
	type: 'post',
	data: $('.favouritedivs'+classified_id+' input,favouritedivs'+classified_id+' hidden').serialize(),
	dataType: 'json',
	success: function(json) {
		
	}
});
  $('.greencolor'+classified_id).click(function() { 
	var favouritestatus='0';
	var dataString ='favouritestatus='+favouritestatus;
	$.ajax({
		url: 'index.php?route=classified/classified_view/addfavouritegreen&classified_id='+classified_id,
		type: 'post',
		dataType: 'json',
		data:dataString,
		success: function(json) {
		$(".greencolor"+classified_id).hide();
		$(".colorblocak"+classified_id).show();

		}
	  });

	});
	$('.colorblocak'+classified_id).click(function() { 
	var favouritestatus='1';
	var dataString ='favouritestatus='+favouritestatus;
	$.ajax({
		url: 'index.php?route=classified/user_allad/addfavouriteblack&classified_id='+classified_id,
		type: 'post',
		dataType: 'json',
		data:dataString,
		success: function(json) {
		$(".colorblocak"+classified_id).hide();
		$(".greencolor"+classified_id).show();

		}
	  });

	});
});
</script>