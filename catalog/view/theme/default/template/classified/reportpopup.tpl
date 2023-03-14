<div class="modal-dialog">
<div class="modal-content modalreports">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="text-center">  <?php echo $text_report;?> </h4>
        </div>
			<div class="modal-body">
				<div class="reportsdiv">
				<div class="input-part">
					<input type="hidden" value="<?php echo $customer_id?>" name="customer_id"> 
					<input type="hidden" value="<?php echo $classified_id;?>" name="classified_id"> 
					<input type="hidden" value="<?php echo $customerlogin;?>" name="login_customer_id"> 
					<?php foreach ($reports as $report) { ?>
					<label for="sold">
						<input type="radio" value="<?php echo $report['value']?>" name="report"> <?php echo $report['value']?>
					</label>
					<br>
					<div class="errorreport"></div>
					<?php } ?>
			
				</div>	
				
				<div class="input-part">
					<button type="button" id="reportbtn" class="btn btn-primary pull-right"><?php echo $text_submit;?></button>
				</div>
				</div>	
				<div class="clearfix"></div>
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
    $('#reportbtn').click(function() { 
	$.ajax({
		url : 'index.php?route=classified/classified_view/reportssubmit',
		type: 'post',
		dataType: 'json',
		data:$('.reportsdiv input[type=\'hidden\'],.reportsdiv input[type=\'radio\']:checked'),
		beforeSend: function() {
		$('#reportbtn').button('loading');
		},
		complete: function() {

		$('#reportbtn').button('reset');
		},
		success: function(json) {
		 if(json['success']){
			var text_success_msg = $("#getCodeModal").modal("toggle");
			$ ('.getCode').html(json['success']);
			setTimeout(function(e){ $('.close').trigger('click');location.reload();},4000);
		 	}else{
		 	$('.errorreport').html('<p class="text-danger"> '+json['error_report']+'</p>');
		
		 }	
		}
	  });

	});

</script>