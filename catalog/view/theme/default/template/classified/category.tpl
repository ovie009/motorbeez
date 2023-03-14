<?php echo $header; ?>
<div class="container">
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?> browsecategory"><?php echo $content_top; ?>
      <h2><?php echo $text_categoryclssefied; ?></h2>
      <hr>
      <div class="row browse">
	  	<ul class="list-inline">
        <?php foreach ($categoryresult as $product) { ?>
			<li>
				<div class="image">
					<a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a>
				</div>
  		    	<div class="clearfix"></div>
				<div class="text-center">
				  <a href="<?php echo $product['href']; ?>">
					<p><?php echo $product['name']; ?></p>
						</a>
				</div> 
			</li>
        <?php } ?>
		</ul>
      </div>
      <?php echo $content_bottom; ?>
    </div>
    <?php echo $column_right; ?>
  </div>
</div>
<?php echo $footer; ?>
