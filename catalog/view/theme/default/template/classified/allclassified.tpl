<?php echo $header; ?>
<div class="maincategory">
<div class="container">
  <div class="breadcrumb">
    <div class="pull-left">
        <ul class="list-inline matter">
          <?php foreach ($breadcrumbs as $breadcrumb) { ?>
          <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
          <?php } ?>
        </ul>
    </div>
    <div class="pull-right">
				<h2><?php echo $heading_title; ?></h2>
		</div>
  </div>
    <div id="content">
	  <!-- content start here -->

			<div class="col-sm-2 catlist">
				  <div class="row">
					<div class="Categories">
						<h3><?php echo $text_categories;?></h3>
					</div>
					<!-- 11 12 2017 -->
					<div id="column-left">
						<div class="sidebar cat-list">
						<ul class="list-unstyled">	

					 <?php if(!empty($allcategories)) { ?>
						  <?php foreach ($allcategories as $allcategory) { ?>
						  <li>
							<a href="<?php echo $allcategory['searchlink'];?>">
							 <img src="<?php echo $allcategory['category_image'];?>">
							 <span> <?php echo $allcategory['name'];?>  </span>
							</a>
							  </li>
								<?php } ?>
							<?php } ?>
						 </ul>
						</div>
					</div>
					<!-- 11 12 2017 -->
				</div>
			</div>
     <div class="col-sm-10 padd0">
		<div class="resultshow"></div>
				<div class="allads alladdserch">
			      <?php if(!empty($classifieds)){ ?>
					<?php foreach ($classifieds as $classifiedseach) { ?>
					<div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="product-thumb">
						<div class="image">
						<a href="<?php echo $classifiedseach['view']?>">
							<img src="<?php echo $classifiedseach['singal_post']?>" alt="<?php echo $classifiedseach['title']?>" title="<?php echo $classifiedseach['title']?>" class="img-responsive">
				        </a>
						<div class="onhover"> <?php echo $classifiedseach['price']?></div>
						</div>
							<div class="caption">
							<h4><a href="<?php echo $classifiedseach['view']?>"><?php echo $classifiedseach['title']?></a></h4>
								<p class="descp"><?php echo $text_category ?> : <?php echo $classifiedseach['categoryname']?> <?php echo $classifiedseach['subcategoryname']?> <?php echo $classifiedseach['categorynamesub']?></p>
								<ul class="list-unstyled">
									<li><i class="la la-map-marker"></i><?php echo $classifiedseach['city']?> <?php echo $classifiedseach['zonename']?> <?php echo $classifiedseach['namecountry']?></li>
									<li><i class="la la-clock-o"></i> <?php echo $classifiedseach['date_added']?></li>
								</ul>
							</div>
						</div>
					</div>
				<?php }  } else { ?>
				<div class="clearfix"></div>
			     <div class="notfound col-sm-12">
			         <div class="text-center notfoundimg">
						<img src="catalog/view/theme/default/image/no-resultfoun.png" class="">
					 </div> 
			     </div>
			    <?php } ?>
				<div class="clearfix"></div>
				<div class="col-sm-12">
				  <div class="resultpage">
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
		$('.alert-success, .alert-danger').remove();
		if (json['success']) {
		$('.breadcrumb').after('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				$('html, body').animate({ scrollTop: 0 }, 'slow');

		}
	}
});
});
 </script>



<script>
  $('document').ready(function(){
  $('.list_grid').change(function(){
    var grd= $(this).val();
  if(grd==1){
    $('.grid_view').hide();
    $('.list_view').show();
  }else{
    $('.list_view').hide();
    $('.grid_view').show();
  }
  })
})
</script>
<?php echo $footer; ?>
