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
<div class="contactus">
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>">
    
    <div class="row">
      <div class="col-sm-9 col-xs-12">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
          <fieldset>
            <h5><?php echo $text_contact; ?></h5>
            <hr>
            <div class="form-group required">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="name" value="<?php echo $name; ?>" id="input-name" class="form-control" placeholder="<?php echo $entry_name; ?>"/>
                <?php if ($error_name) { ?>
                <div class="text-danger"><?php echo $error_name; ?></div>
                <?php } ?>
             </div>
             <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="email" value="<?php echo $email; ?>" id="input-email" class="form-control" placeholder="<?php echo $entry_email; ?>"/>
                <?php if ($error_email) { ?>
                <div class="text-danger"><?php echo $error_email; ?></div>
                <?php } ?>
            </div>
          </div>
          <div class="form-group required">
             <div class="col-sm-12 col-xs-12">
                <textarea name="enquiry" rows="10" id="input-enquiry" class="form-control" placeholder="<?php echo $entry_enquiry; ?>"><?php echo $enquiry; ?></textarea>
                <?php if ($error_enquiry) { ?>
                <div class="text-danger"><?php echo $error_enquiry; ?></div>
                <?php } ?>
              </div>
            </div>
     
          </fieldset>
          <div class="buttons">
            <input class="btn btn-primary" type="submit" value="<?php echo $button_submit; ?>" />
          </div>
        </form>
      </div>
    <div class="col-sm-3 col-xs-12">
      <div class="address mar-b">
        <h3><?php echo $text_store; ?></h3>
        <p><?php echo $store; ?></p>
      </div>
      <div class="address">
					<h3><?php echo $text_location; ?></h3>
					<ul class="list-unstyled">
						<li><span><?php echo $text_address; ?> : </span><p> <?php echo $address; ?></p></li>
						<li><span><?php echo $text_email; ?> : </span><p><?php echo $emails; ?></p></li>
						<li><span><?php echo $text_telephone; ?>: </span><p><?php echo $telephone; ?></p></li>
						<li><?php if ($image) { ?>
            <img src="<?php echo $image; ?>" alt="<?php echo $store; ?>" title="<?php echo $store; ?>" class="img-thumbnail" />
            <?php } ?></li>
					</ul>
			</div>
    </div>
    </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
</div>
<?php echo $footer; ?>
