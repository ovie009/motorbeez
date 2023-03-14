    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content modal-report">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="text-center">  <?php echo $text_enquiry;?> </h4>
        </div>
        <div class="enqdiv">
			<div class="modal-body">
				<form method="post" action="" >
				<div class="input-part">
					<input name="enq_title" required="" value="" placeholder="<?php echo $text_title;?>" id="input-title" class="form-control" type="text">
					<div class="error_title"></div>
					<input name="customer_id"       value="<?php echo $customer_id?>" type="hidden">
					<input name="login_customer_id" value="<?php echo $customerlogin?>" type="hidden">
					<input name="classified_id"     value="<?php echo $classified_id?>" type="hidden">

				</div>
				<div class="input-part">
					<input name="enq_email" required="" value="" placeholder="<?php echo $text_email;?>" id="input-mail" class="form-control" type="email">
						<div class="error_email"></div>
				</div>	
				<div class="input-part">
					<textarea name="enq_discription"  cols="50"  id="enq_discription" rows="4" class="form-control"> 
					</textarea>
						<div class="error_discription"></div>
				</div>
				<div class="input-part">
					<button type="button" class="btn btn-primary pull-right enqdivbtn"><?php echo $button_submit;?></button>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="modal fade listing-model" id="getCodeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header close">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body getCode text-success" id="getCode">
					</div>
				</div>
			</div>
			</div>
			</div>
      </div>
    </div>
    <script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
   <script>

    $('.enqdivbtn').click(function() {
"use strict";		
	$.ajax({
		url: 'index.php?route=classified/myfavouriteads/enquirypopupmsg',
		type: 'post',
		dataType: 'json',
		data:$('.enqdiv input,.enqdiv hidden,.enqdiv textarea'),
		beforeSend: function() {
		$('.enqdivbtn').button('loading');
		},
		complete: function() {
		$('.enqdivbtn').button('reset');
		},
		success: function(json) {
		 if(json['success']){
			var text_success_msg = $("#getCodeModal").modal("toggle");
			$ ('.getCode').html(json['success']);
			setTimeout(function(e){ $('.close').trigger('click');location.reload();},4000);

		 	}else{
		 	$('.error_email').html('<p class="text-danger"> '+json['error_email']+'</p>');
		 	$('.error_title').html('<p class="text-danger"> '+json['error_titel']+'</p>');
		 	$('.error_discription').html('<p class="text-danger"> '+json['error_discription']+'</p>');
		 }	
		}
	  });

	});
</script>
<script type="text/javascript">
$(document ).ready(function() {
	s = document.getElementById("enq_discription").value;
	s = s.replace(/(^\s*)|(\s*$)/gi,"");
	s = s.replace(/[ ]{2,}/gi," ");
	s = s.replace(/\n /,"\n");
	document.getElementById("enq_discription").value = s;
});
</script>