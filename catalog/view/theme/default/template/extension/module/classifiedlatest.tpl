<div class="browse">
<h2><?php echo $heading_title; ?></h2>
<hr/>
</div>
<div class="row">
<div class="allads alladdserch">
    <!-- one day box ---->
      <?php if(!empty($classifiedseachs)){ ?>
    <div id="classified-latest" class="owl-carousel">
       <?php foreach ($classifiedseachs as $classifiedseach) { ?>
       <div class="product-layout col-lg-12 col-md-12 col-sm-12 col-xs-12">
		 
                <div class="product-thumb">
               <div class="image">
							<a href="<?php echo $classifiedseach['view']?>"><img src="<?php echo $classifiedseach['singal_post']?>" alt="image" title="image" class="img-responsive">
						</a>
						<div class="onhover"> <?php echo $classifiedseach['price']?></div>	
					   </div>
                             
                  <div class="caption">
                    <h4><a href="<?php echo $classifiedseach['view']?>"><?php echo $classifiedseach['title']?></a></h4>
                    <p class="des">Category : <?php echo $classifiedseach['categoryname']?> <?php echo $classifiedseach['subcategoryname']?> <?php echo $classifiedseach['categorynamesub']?></p>
                    <ul class="list-unstyled">
                      <li><i class="la la-map-marker"></i><?php echo $classifiedseach['city']?> <?php echo $classifiedseach['zonename']?> <?php echo $classifiedseach['namecountry']?></li>
                      <li><i class="la la-clock-o"></i> <?php echo $classifiedseach['date_added']?></li>
              
                    </ul>
                
                  
                   
                  </div>
                 
                </div>
              </div>
                <?php } ?>
    </div>
                <?php } ?>
        
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
    
  }
});
  $('.greencolor'+classified_id).click(function() { 
  var favouritestatus='0';
  var dataString ='favouritestatus='+favouritestatus;
  $.ajax({
    url: 'index.php?route=classified/user_allad/addfavouritegreen&classified_id='+classified_id,
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

<script type="text/javascript">
$('#button-filter').on('click', function() {
  var url = 'index.php?route=classified/classified_search&classified_category_id=<?php echo $classifiedcategoryid; ?>';
  var filter_name = $('input[name=\'filter_name\']').val();
  if (filter_name) {
    url += '&filter_name=' + encodeURIComponent(filter_name);
  } 
  
  location = url;
});
</script>
<script type="text/javascript">
$('#classified-latest').owlCarousel({
	items : 4,
    itemsDesktop : [1199, 3],
    itemsDesktopSmall : [979, 3],
    itemsTablet : [768, 2],
    itemsMobile : [479, 1],
	autoPlay: 3000,
	navigation: true,
	navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
	pagination: false
});
</script>