<div class="col-sm-6 mylogins hidden-xs hidden-sm">
	<?php if ($warning) { ?>
	<div class="alert alert-warning"><i class="fa fa-check-circle"></i> <?php echo $warning; ?></div>
	<?php } ?>
  
        	<h2><?php echo $text_loginvia; ?></h2>
	   <ul class="list-unstyled">	
	<?php if($fbstatus){?>
	<li>
	<a class="fb"  href="<?php echo $fblink; ?>" target="_blank"><i class="fa fa-facebook"></i>
	<?php echo $fbtitle; ?>
	</a>
	</li>
	<?php } ?>
	<?php if($twitstatus){?>
	<li>
	<a class="tw"  href="<?php echo $twitlink; ?>" target="_blank"><i class="fa fa-twitter"></i>
	<?php echo $twittertitle; ?>
	</a>
	</li>
	<?php } ?>
	<?php if($goglestatus){?>
	<li>	
	<a class="fb"  href="<?php echo $goglelink; ?>" target="_blank"><i class="fa fa-google-plus"></i>
	<?php echo $googletitle; ?>
	</a>
	</li>
	<?php } ?>
	<?php if($linkstatus){?>
		<li><a class="tw"  href="<?php echo $linkdinlink; ?>" target="_blank"><i class="fa fa-linkedin-square"></i>
		<?php echo $linkedintitle; ?>
	   </a></li>
	<?php } ?>
	</ul>
</div>


