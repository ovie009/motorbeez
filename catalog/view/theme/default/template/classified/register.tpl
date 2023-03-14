<?php echo $header; ?>
<div class="topimage">
	 <?php echo $content_top; ?>
</div>
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
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="commontop row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?> login">
      <div class="col-md-6 col-sm-6 col-xs-12 bor hidden-xs">
          <div class="donot"><?php echo $text_account_already; ?>
          </div>
          <p><?php echo $text_andstart; ?></p>
		  	<div class="or hide">
				<span>or</span>
				<hr>
			</div>
      </div>
      <div class="col-sm-6 col-xs-12 border-left">
        <h1><?php echo $text_Login1; ?></h1>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <fieldset id="account">
          <div class="form-group required">
		  <label class="control-label"><?php echo $entry_firstname;?></label> <br/>
            <i class="la la-user"></i>
            <input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="<?php echo $entry_firstname; ?>" id="input-firstname" class="form-control" />
              <?php if ($error_firstname) { ?>
              <div class="text-danger"><?php echo $error_firstname; ?></div>
              <?php } ?>
          </div>
          <div class="form-group required">
		   <label class="control-label"><?php echo $entry_lastname;?></label> <br/>
              <i class="la la-user"></i>
              <input type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder="<?php echo $entry_lastname; ?>" id="input-lastname" class="form-control" />
              <?php if ($error_lastname) { ?>
              <div class="text-danger"><?php echo $error_lastname; ?></div>
              <?php } ?>
          </div>
          <div class="form-group required">
		     <label class="control-label"><?php echo $entry_email;?></label> <br/>
              <i class="la la-envelope-o"></i>
              <input type="email" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
              <?php if ($error_email) { ?>
              <div class="text-danger"><?php echo $error_email; ?></div>
              <?php } ?>
          </div>
        </fieldset>
        <fieldset>
          <div class="form-group required">
		   <label class="control-label"><?php echo $entry_password;?></label> <br/>
            <i class="la la-unlock"></i>
              <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />
              <?php if ($error_password) { ?>
              <div class="text-danger"><?php echo $error_password; ?></div>
            <?php } ?>
          </div>
          <div class="form-group required">
		    <label class="control-label"><?php echo $entry_confirm;?></label> <br/>
            <i class="la la-unlock"></i>
              <input type="password" name="confirm" value="<?php echo $confirm; ?>" placeholder="<?php echo $entry_confirm; ?>" id="input-confirm" class="form-control" />
              <?php if ($error_confirm) { ?>
              <div class="text-danger"><?php echo $error_confirm; ?></div>
              <?php } ?>
          </div>

           <?php if (!empty($payment_status)) { ?>
          <div class="form-group">
            <div class="col-sm-9">
			<div class="row">
              <select name="package_id" id="input-package_id" class="form-control">
                <?php if ($plans) { ?>
               <?php foreach ($plans as $plan) { ?>
              <option value="<?php echo $plan['package_id']; ?>"><?php echo $plan['package_name']; ?></option>
              <?php } ?>
              <?php } ?>
             </select>
           </div> 
           </div>
             <div class="col-sm-3 hidden-xs">
		       <button type="button" class="btn btn-plan pull-right" data-toggle="modal" data-target="#myModal">Package</button>
             </div>
          </div>
           <?php } ?>
                 <?php if (!empty($error_package)) { ?>
              <div class="text-danger"><?php echo $error_package; ?></div>
              <?php } ?>

        <?php if ($text_agree) { ?>
        <div class="buttons">
          <div class="form-group">
            <?php if ($agree) { ?>
            <input type="checkbox" name="agree" value="1" checked="checked" />
            <?php } else { ?>
            <input type="checkbox" name="agree" value="1" />
            <?php } ?>
			<?php echo $text_agree; ?>
            &nbsp; 
            <input type="submit" value="<?php echo $button_continue; ?>" class="btn btn-primary" />
          </div>
        </div>
        <?php } else { ?>
        <div class="buttons">
          <div class="form-group">
            <input type="submit" value="<?php echo $button_continue; ?>" class="btn btn-primary" />
          </div>
        </div>
        <?php } ?>
        </form>
		 </div>
			<?php echo $content_bottom; ?> 
			<div  class="clearfix"></div> 
	  
	  </div>
    <?php echo $column_right; ?></div>
</div>
 <!-- model plans start-->
       <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
          <!-- Modal content-->
          <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
          <div class="classified_plan">
            <div class="row m-auto text-center">
              <?php foreach ($membershipsall as $membership) { ?>
              <div class="col-sm-4 princing-item green">
                <div class="pricing-divider">
                  <h3 class="text-light"><?php echo $membership['package_name']?></h3>

                  <h4 class="my-0 display-2 text-light font-weight-normal mb-3"><?php echo $membership['price']?></h4>
                </div>
                <div class="card-body bg-white mt-0 shadow">
                  <ul class="list-unstyled mb-5 position-relative">
                   <li><?php echo $membership['classified_limit']?> <b><?php echo $text_classified?></b>  </li>
                   <li><?php echo $membership['no_of_day']?> <?php echo $membership['type']?>  <b> <?php echo $text_validity?></b></li>
				 </ul>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
		  <div class="clearfix"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $text_close?></button>
          </div>
          </div>
    
        </div>
	
        </div>
			
<?php echo $footer; ?>
