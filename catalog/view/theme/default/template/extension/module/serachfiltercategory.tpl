	<div class="resultshow"></div>
			<div class="">
			<div class="allads mycatads">
					<?php if(!empty($classifiedseachs)){ ?>
					<?php foreach ($classifiedseachs as $classifiedseach) { ?>
					<div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="product-thumb">
							<div class="image">
							<a href="<?php echo $classifiedseach['view']?>">
							<img src="<?php echo $classifiedseach['singal_post']?>" alt="image" title="image" class="img-responsive">
							</a>
							<div class="onhover"> <?php echo $classifiedseach['price']?></div>
							</div>
						    <h4 style="font-size:20px;color:#2E3F47; padding:5px; text-transform:capitalize"><a style="color:#2E3F47" href="<?php echo $classifiedseach['view']?>"><?php echo $classifiedseach['title']?></a></h4>
							<div class="caption">
								<p class="des"><?php echo $text_category ?> : <?php echo $classifiedseach['categoryname']?> <?php echo $classifiedseach['subcategoryname']?> <?php echo $classifiedseach['categorynamesub']?></p>
								<ul class="list-unstyled">
									<li><i class="la la-map-marker"></i><?php echo $classifiedseach['city']?> <?php echo $classifiedseach['zonename']?> <?php echo $classifiedseach['namecountry']?></li>
									<li><i class="la la-clock-o"></i> <?php echo $classifiedseach['date_added']?></li>
								</ul>
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
			url: 'index.php?route=classified/user_allad/Addfavourite&classified_id='+classified_id,
			type: 'post',
			data: $('.favouritedivs'+classified_id+' input,favouritedivs'+classified_id+' hidden').serialize(),
			dataType: 'json',
			success: function(json) {
				$('.alert-success, .alert-danger').remove();
				if (json['success']) {
					$('.breadcrumb').after('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
					$('html, body').animate({ scrollTop: 0 }, 'slow');
				}
			}
		});
	});
	</script>
	