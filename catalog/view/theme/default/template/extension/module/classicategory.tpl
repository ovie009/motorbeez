<!-- browse start here -->
<div class="browse">
		<h2><?php echo $heading_title; ?></h2>
		<hr/>
		<div class="row">
          <?php if (!empty($categoryresult)) { ?>
          <?php foreach ($categoryresult as $product) { ?>
			<div class="col-sm-3 col-md-2 col-xs-6 padd3">
                <div class="browse-box">
                    <div class="image">
                        <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a>
                     </div>
                      <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
                </div>
            </div>
          <?php } ?>
          <?php } ?>
		</div>
</div>
<!-- browse end here -->
