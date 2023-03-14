<!-- footer start here -->
<footer class="footer2">
    <div class="container">
        <div class="row">
          <?php if ($informations) { ?>
          <div class="col-sm-3">
            <h5><?php echo $text_information; ?></h5>
            <ul class="list-unstyled">
              <?php foreach ($informations as $information) { ?>
              <li><a href="<?php echo $information['href']; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i><?php echo $information['title']; ?></a></li>
              <?php } ?>
            </ul>
          </div>
          <?php } ?>
          <div class="col-md-3 col-sm-3 col-xs-12">
                <h5><?php echo $text_links; ?></h5>
                <ul class="list-unstyled links">
                  <li><a href="<?php echo $dashboard; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i><?php echo $text_dashboard; ?></a></li>
                  <li><a href="<?php echo $myads; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i><?php echo $text_myads; ?></a></li>
                  <li><a href="<?php echo $mysetting; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i><?php echo $text_mysetting; ?></a></li> 
				  <li><a href="<?php echo $contact_us; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i><?php echo $text_contact; ?></a></li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <h5><?php echo $text_contact; ?></h5>
                <ul class="list-unstyled links">
                  <li><i class="fa fa-home" aria-hidden="true"></i><?php echo $name; ?></li>
                  <li><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $address; ?></li>
                  <li><i class="fa fa-mobile" aria-hidden="true"></i><?php echo $telephone; ?></li>
                  <li><i class="fa fa-envelope" aria-hidden="true"></i><?php echo $email; ?></li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="footerlogo">
                <?php if ($footerlogo) { ?>
                      <a href="<?php echo $home; ?>"><img src="<?php echo $footerlogo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
                    <?php } else { ?>
                      <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
                <?php } ?>
              </div>
                <p><?php echo $description; ?></p>
                <ul class="list-inline social">
                  <?php if($fburl){?>
                  <li class="diamond-shape"><a href="<?php echo $fburl;?>" target="new"><i class="fa fa-facebook"></i></a></li>
                  <?php } ?>
                  <?php if($twet){?>
                  <li class="diamond-shape"><a href="<?php echo $twet;?>" target="new"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                  <?php } ?>
                  <?php if($google){?>
                  <li class="diamond-shape"><a href="<?php echo $google;?>" target="new"><i class="fa fa-google" aria-hidden="true"></i></a></li>
                  <?php } ?>
                  <?php if($in){?>
                  <li class="diamond-shape"><a href="<?php echo $in;?>" target="new"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                  <?php } ?>
                  <?php if($linkdin){?>
                  <li class="diamond-shape"><a href="<?php echo $linkdin;?>" target="new"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                  <?php } ?>
                  <?php if($youtube){?>
                  <li class="diamond-shape"><a href="<?php echo $youtube;?>" target="new"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
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
