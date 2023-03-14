<?php echo $header; ?>
<div class="container">
	<div id="content">
		<!-- ad-single start here -->
		<div class="bread-crumb">
			<div class="matter">
				<div class="pull-left">
					<ul class="list-inline">
						<li><a href="#"><?php echo $categoryname?></a></li>
						<li><a href="#"><?php echo $subcategoryname?> <?php echo $subcategoryname?></a></li>
					</ul>
				</div>
				<div class="pull-right">
					<h2><?php echo $categoryname?></h2>
				</div>
			</div>
		</div>
		<!-- breadcrumb end here -->
		<div class="commontop">
				<div class="row">
				<div class="col-sm-9 col-xs-12">
				 <h2 class="title-singleads"><?php echo $title;?></h2>
					<div class="tabheading">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="row">
								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active "><a href="#photos" aria-controls="home" role="tab" data-toggle="tab"><?php echo $text_photos?></a></li>
									<li role="presentation"><a class="" href="#adsmap" aria-controls="profile" role="tab" data-toggle="tab"><?php echo $text_map?></a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="row pull-right">
							<div class="time-location hidden-xs">
								<i class="la la-clock-o"></i> <?php echo $date_added?>
							</div>
							<div class="advertise-id">
							 <?php echo $text_adid?> : #<?php echo $classified_id?>
							</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active margin-map" id="photos">
							<div id="ad-singlephotos">
							  <?php if(!empty($slidersbigimg)){ ?>
								 <?php foreach ($slidersbigimg as $slider) { ?>
										<div class="bigimages">
										<img src="<?php echo $singal_post;?>" alt="image" title="image" class="img-responsive" />
									</div>
									<?php } ?>
								<!-- gallery images ---->
								<div  id="additional" class="ads-photos owl-carousel">
							    <?php foreach ($sliderssmall as $slider) { ?>
									<div class="item" id="">
										<img src="<?php echo $slider['sliders']?>" alt="image" title="image" class="img-responsive" />
									</div>
									<?php } ?>
								</div>
							  <?php } else{  ?>
							  	<img src="<?php echo $singal_post?>" alt="image" title="image" class="img-responsive" />
						      <?php } ?>
								<!-- gallery images end ---->
							</div>
						</div>
						<div role="tabpanel" class="tab-pane margin-map" id="adsmap">
							<div class="map">
							 <div id="map"></div>
							</div>
						</div>
						
					</div>
					<div class="details-single">
						<div class="title-detail">
						  <?php echo $text_additiondetail; ?>
						</div>
						<ul class="clearfix">
							<li><div class="listing-details"><span class="label"><?php echo $text_adid?></span><span class="desc"> : #<?php echo $classified_id?></span></div></li>
							<li><div class="listing-details"><span class="label"><?php echo $text_postedon; ?></span><span class="desc"><i class="la la-clock-o"></i> <?php echo $date_added?></span></div></li>
						</ul>
						<div class="clearfix"></div>
						<div class="title-detail">
						 <?php echo $text_desc;?>
						</div>
						<p>
						 <?php echo $postdescription;?>
						</p>
						<div class="clearfix"></div>
						<div class="title-detail">
						 <?php echo $text_location;?>
						</div>	
							<ul class="clearfix location-list">
							<?php if(!empty($city)){ ?>
								<li><div class="listing-details"><span class="label"><?php echo $text_city; ?></span><span class="desc"> : <?php echo $city;?></span></div></li>
							<?php } ?>
							<?php if(!empty($zonename)){ ?>
								<li><div class="listing-details"><span class="label"><?php echo $text_zone; ?></span><span class="desc"> : <?php echo $zonename;?></span></div></li>
							<?php } ?>
							<?php if(!empty($namecountry)){ ?>
								<li><div class="listing-details"><span class="label"><?php echo $text_country; ?></span><span class="desc">: <?php echo $namecountry;?></span></div></li>
							<?php } ?>
							<?php if(!empty($address)){ ?>
								<li><div class="listing-details"><span class="label"><?php echo $text_address; ?></span><span class="desc">: <?php echo $address;?></span></div></li>
							<?php } ?>
		
							</ul>	
							
							
							<div class="clearfix"></div>
						<?php if(!empty($uploadvideourl)){ ?>
							<div class="title-detail"><?php echo $text_video;?></div>	
							<ul class="clearfix location-list">
							<iframe width="100%" height="400px" src="<?php echo $uploadvideourl;?>" frameborder="0" allowfullscreen>
							</iframe>
							</ul>
						<?php } ?>


							
						<div class="clearfix"></div>
					<?php if (!empty($classifiedform)) { ?>
						

					    <div id="ad-single">
							<?php foreach ($classifiedform as $form) { ?>
							  <?php if (!empty($form['value'])) { ?>							
								<div class="listing-caption">
									<h3><?php echo $form['field_name'];?></h3>
									<p>
									<div>
									<?php echo $form['value'];?></div>
									</p>
							    </div>
							  <?php } ?>

							<?php } ?>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="col-sm-3 col-xs-12">
					<div class="rightside">
						<p class="price"><?php echo $price?></p>
						<div class="profile text-center">
							<div class="image">
							<?php  if(!empty($profileImage)){?>
							<img class="img-responsive" src="<?php echo $profileImage;?>" alt="image" title="<?php echo $firstname;?>">
								<?php } else { ?>
								<img class="img-responsive" src="catalog/view/theme/default/image/profile.png" alt="image" title="image">
							<?php } ?>
							</div>
							<h4><?php echo $firstname?></h4>
							<span>(<?php echo $dateadded?>)</span>
						</div>
						<ul class="list-inline">
						<li>
							<?php if(!empty($customerlogin)){ ?>
							<a data-toggle="modal" class="report btn" data-target=".abuse-modal" href="<?php echo $enquirypopup?>">
								<i class="la la-envelope-o"></i>
							</a>
                          <?php } else{ ?>
								<a class="btn" href="<?php echo $accountlogin;?>"><i class="la la-envelope-o"></i></a>
								<?php } ?>
							</li>
							<li>
							<?php if(!empty($customerlogin)){ ?>
							<span class="favouritediv" rel="<?php echo $classifiedid;?>">
							<span class="favouritedivs<?php echo $classifiedid;?>">
							<input type="hidden" name="login_customer_id" value="<?php echo $customerlogin;?>">
							<input type="hidden" name="customer_id"       value="<?php echo $customer_id;?>">
							<input type="hidden" name="classified_id"     value="<?php echo $classifiedid;?>">
							</span>
							  <?php if(!empty($favouritestatus == '1')){ ?>
								<button class="greencolor<?php echo $classifiedid;?>" rel="<?php echo $classifiedid;?>" type="button"><i class="la la-heart" style="color:#04CF44;"></i></button>
								<button class="colorblocak" type="button" style="display:none;"><i class="la la-heart"></i>
								</button>
							  <?php } else {  ?>
								<button class="colorblocak<?php echo $classifiedid;?>" rel="<?php echo $classifiedid;?>" type="button"><i class="la la-heart" style="color:black;"></i>
								</button>
								<button class="greencolor<?php echo $classifiedid;?>"
									type="button" style="display:none;"><i class="la la-heart"style="color:#04CF44;"></i>
								</button>
							  <?php } ?>
							</span>
							<?php } else{ ?>
							<a class="btn" href="<?php echo $accountlogin;?>"><i class="la la-heart-o"></i></a>
							<?php } ?>
							</li>
						</ul>
						<?php if(!empty($telephone)){ ?>
						<div class="phone">
							<i class="la la-phone"></i>
							 <?php echo $telephone;?>
						</div>
						<?php } ?>
						<div class="safety">
							    <h4>
									<?php echo $text_seller;?>
									<a href="<?php echo $userallad;?>">
										<?php echo $firstname;?>
									</a>
							    </h4>
						<div class="reportdata favouritclaspoverlap"></div>
							<a data-toggle="modal" class="addreports" data-target=".abusereport" href="<?php echo $reportspopup		?>">
							  <?php echo $text_report;?>
							</a>
						</div>
			<!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style" data-url=""><a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_pinterest_pinit"></a> <a class="addthis_counter addthis_pill_style"></a></div>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e"></script>
             <!-- AddThis Button END -->
					</div>
				</div>
			</div>
		</div>
		<?php if(!empty($classified_icon)){ ?>
		<div class="banner10">
			<div class="row">
				<div class="col-sm-12">
					<img src="<?php echo $classified_icon; ?>" class="img-responsive" alt="image" title="title">
				</div>
			</div>
		</div>
		<?php } ?>
		
	 </div>
	 <?php echo $content_bottom; ?>
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
<div class="modal fade abusereport" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<script type="text/javascript">
$(document).on('click','.addreports',function(e) {
	 $('.modalreports').html('<div class="loader-if centered"></div>');
     $('.abusereport').load($(this).attr('href'));
  window.opener.location.reload();
});
</script>
<script>
	// Initialize and add the map
	function initMap() {
	// The location of Uluru

	  var myLatLng = {lat: <?php echo $lat?>, lng: <?php echo $lng?>};
	// The map, centered at Uluru
	var map = new google.maps.Map(
	  document.getElementById('map'), {zoom: 13, center: myLatLng});
	// The marker, positioned at Uluru
	var marker = new google.maps.Marker({position: myLatLng, map: map});
	}
 </script>
<script async defer
	src="https://maps.googleapis.com/maps/api/js?key=<?php echo $classified_mapkey;?>callback=initMap">
</script>
	
<script>
$('.favouritediv').click(function() {
	"use strict";
   var classified_id=$(this).attr('rel');
$.ajax({
	url: 'index.php?route=classified/user_allad/Addfavourite&classified_id='+classified_id,
	type: 'post',
	data: $('.favouritedivs'+classified_id+' input,favouritedivs'+classified_id+' hidden').serialize(),
	dataType: 'json',
	success: function(json) {
	 if (json['success']) {
		$('.bread-crumb').after('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				$('html, body').animate({ scrollTop: 0 }, 'slow');

		}
	}
});

});
</script>
<script type="text/javascript">
$('#additional').owlCarousel({
	items : 7,
    itemsDesktop : [1199, 5],
    itemsDesktopSmall : [979, 3],
    itemsTablet : [768, 2],
    itemsMobile : [479, 1],
	autoPlay: false,
	navigation: true,
	navigationText: ['<i class="fa fa-caret-left" aria-hidden="true"></i>','<i class="fa fa-caret-right" aria-hidden="true"></i>'],
	pagination: false
});
</script>
<script type="text/JavaScript">
jQuery(document).ready(function() {
	jQuery("#additional .item img").click(function(){
		jQuery('.bigimages  img').attr('src',jQuery(this).attr('src'));
	});
	var imgSwap = [];
	 jQuery("#additional .item img").each(function(){
		imgUrl = this.src.replace();
		imgSwap.push(imgUrl);
	});
	jQuery(imgSwap).preload();
});
jQuery.fn.preload = function() {
    this.each(function(){
        jQuery('<img/>')[0].src = this;
    });
}
</script>
<?php echo $footer; ?>
