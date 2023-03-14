<?php echo $header; ?>
<div class="classified_plan">
	<div class="container">
      <div class="row m-auto text-center">
        <div class="tab-first"></div>
        <?php foreach ($membershipsall as $membership) { ?>
        <div class="col-sm-4 princing-item green">
          <div class="pricing-divider">
              <h3 class="text-light"><?php echo $membership['package_name']?></h3>
            <h4 class="my-0 display-2 text-light font-weight-normal mb-3"><span class="h3"></span> <?php echo $membership['price']; ?> </h4>
          </div>
          <div class="card-body bg-white mt-0 shadow">
            <ul class="list-unstyled mb-5 position-relative">
           
              <li><b><?php echo $membership['classified_limit']?></b> <?php echo $text_classified?> </li>
              <li><b><?php echo $membership['no_of_day']?></b> <b><?php echo $membership['type']?></b> <?php echo $text_validity?> </li>
            </ul>
              <div class="renewplan<?php echo $membership['package_id']?>">
              <?php if(!empty($customer_id)){ ?>
			     <a type="button" class="btn btn-lg btn-primary addplans" rel="<?php echo $membership['package_id']?>">
			   <?php echo $text_buynow; ?>
                <input type="hidden" name="package_id" value="<?php echo $membership['package_id']?>"/></a>
			  <?php } else{  ?>
			     <a href="<?php echo $login; ?>" class="btn btn-lg btn-primary addplans">
			       <?php echo $text_buynow; ?></a>
			  <?php } ?>			
              </div>
          </div>
        </div>
        <?php } ?>
    </div>
</div>
<?php echo $footer; ?>

<script type="text/javascript">
$(document).hover('click','.addplans',function() {
"use strict";	
var package_id = $(this).attr('rel');
$.ajax({
url: 'index.php?route=classified/renewplans/renewcustomerplan',
type: 'post',
data: $('.renewplan'+package_id+' input[type=\'hidden\']'),
dataType: 'json',
beforeSend: function(){
},
complete: function(){

},
  success: function(json){
    $('.alert, .text-danger').remove();
    if (json['redirec']) {
      window.location.href = ''+json['redirec']+'';
    }
  },
  error: function(xhr, ajaxOptions, thrownError) {
    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
  }
});

});
</script>
