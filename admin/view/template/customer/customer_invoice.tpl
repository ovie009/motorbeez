<!DOCTYPE html>
<head>
<meta charset="UTF-8" />
<title><?php echo $heading_title1; ?></title>
<base href="<?php echo $base; ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="view/javascript/jquery/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="view/javascript/bootstrap/js/bootstrap.min.js"></script>
<link href="view/stylesheet/bootstrap.css" type="text/css" rel="stylesheet" />
<link href="view/javascript/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div class="container">
    <img src="<?php echo $image ?>" style="margin: 15px 0 15px 0;" />
  <div style="page-break-after: always;">
    <div class="row">
      <div class="col-sm-6"><h1><?php echo $text_invoice; ?> #<?php echo $order_id; ?></h1></div>
      <div class="col-sm-6 text-right"><button class="btn btn-info" onclick="window.print()"><i class="fa fa-print" aria-hidden="true"></i></button></div>
    </div>  
    <table class="table table-bordered">
      <tbody>
        <tr>
          <td><b><?php echo $entry_customername; ?></b></td>
          <td><?php echo $cust_name; ?></td>
        </tr>
      </tbody>
      <tbody>
        <tr>
          <td><b><?php echo $entry_email; ?></b></td>
          <td><?php echo $email; ?></td>
        </tr>
      </tbody>

      <tbody>
        <tr>
          <td><b><?php echo $entry_address; ?></b></td>
          <td><?php echo $address; ?></td>
        </tr>
      </tbody>
      
      <tbody>
        <tr>
          <td><b><?php echo $entry_plan; ?></b></td>
          <td><?php echo $package_name; ?></td>
        </tr>
      </tbody> 
      <tbody>
        <tr>
          <td><b><?php echo $entry_limit  ; ?></b></td>
          <td><?php echo $classified_limit; ?></td>
        </tr>
      </tbody>
	  
	  <?php if(!empty($price)) { ?>
	    <tbody>
        <tr>
          <td><b><?php echo $entry_price  ; ?></b></td>
          <td><?php echo $price; ?></td>
        </tr>
      </tbody>
	  <?php } ?>
	  	  <?php if(!empty($nameorder)) { ?>
	    <tbody>
        <tr>
          <td><b><?php echo $entry_orderstatus  ; ?></b></td>
          <td><?php echo $nameorder; ?></td>
        </tr>
      </tbody>
	  <?php } ?>
	  
  
      <tbody>
        <tr>
          <td><b><?php echo $entry_planstart  ; ?></b></td>
          <td><?php echo $startdate; ?></td>
        </tr>
      </tbody>

      <tbody>
        <tr>
          <td><b><?php echo $entry_planexpiry  ; ?></b></td>
          <td><?php echo $expirydate; ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</body>