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
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
  <?php } ?>
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
            <h2><?php echo $text_new_customer; ?></h2>
            <div class="donot"><?php echo $text_register; ?>
              <a href="<?php echo $register; ?>"><?php echo $button_continue; ?></a>
			</div>
            <p><?php echo $text_register_account; ?></p>
			<div class="or hide">
				<span>or</span>
				<hr>
			</div>
		</div>
        <div class="col-sm-6 col-xs-12 border-left">
            <h1><?php echo $text_returning_customer; ?></h1>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
              <div class="form-group required">
			    <label class="control-label"><?php echo $entry_email;?></label> <br/>
                <i class="la la-envelope-o"></i>
                <input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
				   <?php if ($error_email) { ?>
              <div class="text-danger"><?php echo $error_email; ?></div>
              <?php } ?>
              </div>
              <div class="form-group required">
			   <label class="control-label"><?php echo $entry_password;?></label> <br/>
                <i class="la la-unlock"></i>
                <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />
				    <?php if ($error_password) { ?>
              <div class="text-danger"><?php echo $error_password; ?></div>
            <?php } ?>
				
             </div>
             <div class="links">
                <a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a>
              </div>
              <input type="submit" value="<?php echo $button_login; ?>" class="btn btn-primary" />
              <?php if ($redirect) { ?>
              <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
              <?php } ?>
            </form>
        </div>
   <?php echo $content_bottom; ?>
    <div class="clearfix"></div>

  </div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
