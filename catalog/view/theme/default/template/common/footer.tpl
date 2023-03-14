<!-- footer start here -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <?php if ($footerlogo) { ?>
                      <a href="<?php echo $home; ?>"><img src="<?php echo $footerlogo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
                    <?php } else { ?>
                      <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
                <?php } ?>
                <p><?php echo $description; ?></p>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <h5><?php echo $text_links; ?></h5>
        <ul class="list-unstyled links">
          <li><a href="<?php echo $dashboard; ?>"><?php echo $text_dashboard; ?></a></li>
          <li><a href="<?php echo $myads; ?>"><?php echo $text_myads; ?></a></li>
                    <li><a href="<?php echo $mysetting; ?>"><?php echo $text_mysetting; ?></a></li>
					  <li><a href="<?php echo $contact_us; ?>"><?php echo $text_contact; ?></a></li>
                </ul>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <h5><?php echo $text_contact; ?></h5>
        <ul class="list-inline social">
                    <?php if($fburl){?>
          <li><a href="<?php echo $fburl;?>" target="new"><i class="fa fa-facebook"></i></a></li>
          <?php } ?>
                    <?php if($twet){?>
          <li><a href="<?php echo $twet;?>" target="new"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
          <?php } ?>
                    <?php if($google){?>
          <li><a href="<?php echo $google;?>" target="new"><i class="fa fa-google" aria-hidden="true"></i></a></li>
          <?php } ?>
                    <?php if($in){?>
          <li><a href="<?php echo $in;?>" target="new"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
          <?php } ?>
                    <?php if($linkdin){?>
          <li><a href="<?php echo $linkdin;?>" target="new"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
          <?php } ?>
                    <?php if($youtube){?>
          <li><a href="<?php echo $youtube;?>" target="new"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
          <?php } ?>
                </ul>
            </div>
        </div>
    </div>
  <div class="powered">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-xs-12 text-center">
          <p><?php echo $powered; ?></p>
        </div>
      </div>
    </div>
  </div>
   <script>
	$( ".inner-switch" ).on("click", function() {
    if( $( "body" ).hasClass( "dark" )) {
      $( "body" ).removeClass( "dark" );
      $( ".inner-switch" ).text( "OFF" );
    } else {
      $( "body" ).addClass( "dark" );
      $( ".inner-switch" ).text( "ON" );
    }
});
	</script>
</footer>
<!-- footer end here -->

</body></html>