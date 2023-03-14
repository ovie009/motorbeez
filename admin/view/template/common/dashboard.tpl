<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<div class="dashboard-part">
	<div class="page-header">
		<div class="container-fluid">
		  <div class="dashboard-heading"><?php echo $heading_title; ?></div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
		   <div class="col-sm-3">
				<div class="report-box">
					<div class="left-report">
						<div class="icon-label line-bg1">
						<i class="fa fa-buysellads"></i>
						</div>
						<div class="sale-title">
						 <?php echo $text_classified; ?></div>
					</div>
					<div class="right-report">
						<div class="amount"> <?php echo $total_classifieds; ?></div>
						<div class="title-right"><?php echo $text_total; ?></div>
					</div>
						<div class="clearfix"></div>
					<div class="line-bottom line-bg1"></div>
				</div>
			</div>
		    <div class="col-sm-3">
				<div class="report-box">
					<div class="left-report">
						<div class="icon-label line-bg2">
							<i class="fa fa-file"></i>
						</div>
						<div class="sale-title">
							<?php echo $text_invoice; ?>					
						</div>
					</div>
					<div class="right-report">
						<div class="amount"> <?php echo $total_invoice; ?></div>
						<div class="title-right">  <?php echo $text_totalinvoice; ?></div>
					</div>
						<div class="clearfix"></div>
					<div class="line-bottom line-bg2"></div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="report-box">
					<div class="left-report">
						<div class="icon-label line-bg3">
							<i class="fa fa-user"> </i>
						</div>
						 <div class="sale-title">
						    <?php echo $text_customer; ?>
						 </div>
					</div>
					<div class="right-report">
						<div class="amount"> <?php echo $total_customers; ?></div>
						<div class="title-right"> <?php echo $text_totalcustomer; ?></div>
					</div>
						<div class="clearfix"></div>
					<div class="line-bottom line-bg3"></div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="report-box">
					<div class="left-report">
						<div class="icon-label line-bg4">
							<i class="fa fa-<?php echo $revcurreny; ?>"> </i>
						</div>
						<div class="sale-title">
						<?php echo $text_revenue; ?>				
					</div>
					</div>
					<div class="right-report">
						<div class="amount"> <?php echo $revenue_total; ?></div>
						<div class="title-right"><?php echo $text_revenu; ?></div>
					</div>
				  <div class="clearfix"></div>
					<div class="line-bottom line-bg4"></div>
				</div>
			</div>
		</div>
		<!-- chart -->
		 <div class="clearfix"></div>
		
		<div class="chart-part row">
			<div class="col-sm-8 col-xs-12">
				<canvas id="classifiedchart" class="">
				</canvas>
			</div>
			<div class="col-sm-4 col-xs-12">
				<div class="recent">
					<div class="panel panel-default">
					  <div class="panel-heading bgred">
						<h1 class="panel-title"><i class="fa fa-users"></i> <?php echo $text_recentuser; ?></h1>
					  </div>
					  <div class="table-responsive">
						<table class="table">
						  <thead>
							<tr>
							  <td class="text-center"><?php echo $column_image; ?></td>
							  <td class="text-center"><?php echo $column_name; ?></td>
							  <td class="text-center"><?php echo $column_action; ?></td>
							</tr>
						  </thead>
							<tbody>
						<?php if (!empty($recent_customers)) { ?>
						<?php foreach ($recent_customers as $result) { ?>
								<tr>
									<td class="text-center">
										<img src="<?php echo $result['custimage']; ?>" class="img-thumbnail">
									</td>
									<td class="text-center"><?php echo $result['custname']; ?></td>
									<td class="text-center">
									<a href="<?php echo $result['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
									</td>
								</tr>
							  <?php } ?>
							  <?php } ?>
							</tbody>
						</table>
					  </div>
					</div>
				  </div>	
			</div>
			<div class="clearfix"></div>
		</div>
	
	   <!-- end of chart -->
	 <!-- classified list end -->
	    
	 <!-- classified list -->
	 	<div class="row bottom-dashboard">
			<div class="col-sm-6 col-xs-12">
				<div class="recent">
					<div class="panel panel-default">
					  <div class="panel-heading bgblue">
						<h1 class="panel-title"><i class="fa fa-buysellads"></i> <?php echo $text_recentlisting; ?></h1>
					  </div>
					  <div class="table-responsive">
						<table class="table">
						  <thead>
							<tr>
							  <td class="text-center"><?php echo $column_image; ?></td>
							   <td class="text-center"><?php echo $column_name; ?></td>
							  <td class="text-center"><?php echo $column_action; ?></td>
							</tr>
						  </thead>
							<tbody>
									<?php if (!empty($recent_classifieds)) { ?>
						<?php foreach ($recent_classifieds as $result) { ?>
								<tr>
									<td class="text-center">
										<img src="<?php echo $result['classified_image']; ?>" class="img-thumbnail">
									</td>
									<td class="text-center"><?php echo $result['classified_title']; ?></td>
									<td class="text-center">
									<a href="<?php echo $result['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
									</td>
								</tr>
							  <?php } ?>
							  <?php } ?>
									
							</tbody>
						</table>
					  </div>
					</div>
				  </div>	
			</div>
			<div class="col-sm-6 col-xs-12">
				<div class="recent">
					<div class="panel panel-default">
					  <div class="panel-heading bgsky">
						<h1 class="panel-title"><i class="fa fa-file"></i> <?php echo $text_recentinvoice; ?></h1>
					  </div>
					  <div class="table-responsive">
						<table class="table">
						  <thead>
							<tr>
							  <td class="text-center"><?php echo $column_image; ?></td>
							   <td class="text-center"><?php echo $column_name; ?></td>
							  <td class="text-center"><?php echo $column_action; ?></td>
							</tr>
						  </thead>
							<tbody>
					<?php if (!empty($recent_invoices)) { ?>
						<?php foreach ($recent_invoices as $result) { ?>
								<tr>
									<td class="text-center">
										<img src="<?php echo $result['invoice_image']; ?>" class="img-thumbnail">
									</td>
									<td class="text-center"><?php echo $result['invoice_name']; ?></td>
									<td class="text-center">
									<a href="<?php echo $result['view']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
									</td>
								</tr>
							  <?php } ?>
							  <?php } ?>								
							</tbody>
						</table>
					  </div>
					</div>
				  </div>	
			</div>
		</div>
   	 </div>
   </div>
</div>
<script type="text/javascript" src="view/javascript/chaart-min.js"></script>
<script>
$(document).ready(function(){
	"use strict";
  $.ajax({
     url: 'index.php?route=common/dashboard/monthlydata&token=<?php echo $token; ?>',
    method: "GET",
    success: function(data) {
      var month = [];
      var total_customer = [];
      for(var i in data) {
      	 month.push("" + data[i].month);
        total_customer.push(data[i].total_customer);
      }

      var chartdata = {
		labels: month,
        datasets : [
          {
			label: "Customers",
            backgroundColor: 'rgba(105, 0, 132, .2)',
            borderColor: 'rgba(0, 10, 130, .7)',
            borderWidth: 2,
            data: total_customer
          }
        ]
      };

	 	  var ctxL = document.getElementById("classifiedchart").getContext('2d');

      	var myclassifiedchart = new Chart(ctxL, {

        type: 'line',
        data: chartdata
      });

    },
options: {
		responsive: true
	  }
  
  });
});
</script>
<?php echo $footer; ?>