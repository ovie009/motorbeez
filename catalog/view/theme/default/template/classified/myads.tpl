<?php echo $header; ?>
<div class="topimage">
	 <?php echo $content_top; ?>
</div>
<div class="commontop">
<div class="container">
	<div id="content">
	<!-- ad-single start here -->
	<div class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="dashboard">
					<div class="profile">
						<div class="col-sm-12 col-lg-3 col-md-3 col-xs-12">
								 <?php  if(!empty($profileImage)){?>
							<img class="img-responsive" src="<?php echo $profileImage;?>" alt="image" title="<?php echo $firstname;?>">
						 <?php } else { ?>
							 <img class="img-responsive" src="catalog/view/theme/default/image/profile.png" alt="image" title="image">
							<?php } ?>

						</div>
						<div class="col-sm-12 col-lg-9 col-md-9 col-xs-12 padd0">
							<h4><?php echo $firstname;?></h4>
							<div class="common">
								<p class="des"><i class="la la-map-marker"></i> <?php echo $address;?></p>
								<p class="des1"><?php echo $text_account;?> <?php echo $dateadded;?></p>
							</div>
							<ul class="list-inline">
								<li>
									<a href="<?php echo $dashboard?>">
										<i class="fa fa-tachometer" aria-hidden="true"></i><br/>
										<?php echo $text_dashboard;?>
									</a>
								</li>
								<li class="active">
									<a href="<?php echo $myads?>">
										<i class="fa fa-buysellads" aria-hidden="true"></i></i>
										<br/>
										<?php echo $text_myads;?>
									</a>
								</li>
								<li>
									<a href="<?php echo $myfavouriteads?>">
										<i class="fa fa-heart" aria-hidden="true"></i><br/>
										<?php echo $text_favads;?>
									</a>
								</li>
								<li>
									<a href="<?php echo $mymessages?>">
									<i class="fa fa-envelope" aria-hidden="true"></i> <br/>
										<?php echo $text_messages;?></a>

								</li>
								<li>
									<a href="<?php echo $mysetting?>">
										<i class="fa fa-cog" aria-hidden="true"></i> <br/>
										<?php echo $text_setting;?>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="inner-ads">
				 <?php if ($success) { ?>
				    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
				      <button type="button" class="close" data-dismiss="alert">&times;</button>
				    </div>
				    <?php } ?>
				     <?php if ($delsuccess) { ?>
				    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $delsuccess; ?>
				      <button type="button" class="close" data-dismiss="alert">&times;</button>
				    </div>
				    <?php } ?>
				    <?php if ($adsuccess) { ?>
				    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $adsuccess; ?>
				      <button type="button" class="close" data-dismiss="alert">&times;</button>
				    </div>
				    <?php } ?>
				    <?php if ($insuccess) { ?>
				    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $insuccess; ?>
				      <button type="button" class="close" data-dismiss="alert">&times;</button>
				    </div>
				    <?php } ?>
						<div class="">
							<ul class="list-inline pull-right">
							<li>
							<?php if($currentdate > $expirydate && !empty($payment_status)) { ?>
							<button type="button" data-toggle="modal"  data-target="#myModal" class="btn btn-primary">
									<?php echo $text_addclassified;?>
								</button>
								<?php } elseif($classified_limit <= $total_classified && !empty($payment_status)) { ?>
									<button type="button" data-toggle="modal"  data-target="#myModal" class="btn btn-primary">
									<?php echo $text_addclassified;?>
								</button>
								<?php } else { ?>
									<button type="button"  onclick="window.location.href='<?php echo $classifiedaddbtn;?>'" class="btn btn-primary">
									<?php echo $text_addclassified;?>
								</button>
								<?php } ?>
							</li>
				   	 	  </ul>
						</div>
						<div class="clearfix"></div>
						<form  method="post" enctype="multipart/form-data" id="form-classified">
						<?php if(!empty($myaddsinfo)){ ?>
						<?php foreach ($myaddsinfo as $myaddsinfos) { ?>
						<div class="product-layout product-list btn-layoutss ">
							<div  class="productList<?php echo $myaddsinfos['classified_id']?>">
								<div class="product-thumb cdiv1<?php echo $myaddsinfos['classified_id']?>">
									<div class="image">
                                        <img src="<?php echo $myaddsinfos['singal_post']?>" class="img-responsive">
										<?php if($myaddsinfos['active']==1){ ?>
										<div class="sticker"><?php echo $text_active;?></div>
									    <?php } else{ ?>
                                          <div class="sticker" style="background:#f32c2c;"><?php echo $text_inactive;?></div>
									    <?php } ?>
									</div>
									<div class="caption">
										<h4><a href="<?php echo $myaddsinfos['view']?>"><?php echo $myaddsinfos['title']?></a></h4>
										<p class="des">
											Category :<?php echo $myaddsinfos['categoryname']?>
											<?php echo $myaddsinfos['subcategoryname']?>
											<?php echo $myaddsinfos['categorynamesub']?>
										</p>
										<ul class="list-unstyled">
											<li><i class="la la-map-marker"></i> <?php echo $myaddsinfos['city']?> <?php echo $myaddsinfos['zonename']?> <?php echo $myaddsinfos['namecountry']?>
											</li>
											<li>
											  <i class="la la-clock-o"></i> <?php echo $myaddsinfos['date_added']?>
											</li>
										</ul>
										<hr>
										<p class="des">
											<?php echo $myaddsinfos['post_description']?>
										</p>
										<div class="pull-right sticker-img">
										</div>
										<div class="myadsbtn text-center">
											<span class="btn-price">
												<button type="button"><?php echo $myaddsinfos['price']?></button>
											</span>
						     				 <a class="hide" href="<?php echo $myaddsinfos['view']?>">
												<button type="button">
													<i class="la la-eye"></i>
												</button>
						     				 </a>
											<a  title="<?php echo $text_edit?>" href="<?php echo $myaddsinfos['href']?>"><button type="button"><i class="la la-pencil  icon-edit"></i></button></a>
											<?php if($myaddsinfos['active']==1){ ?>	
												 <a title="<?php echo $text_disapprove?>" href="<?php echo $myaddsinfos['inactive_classified']?>"> <button type="button"><i class="fa fa-thumbs-down icon-disapprove"></i></button>
											 <?php } else{ ?>
											 <a title="<?php echo $text_approve?>" href="<?php echo $myaddsinfos['active_classified']?>"> <button type="button"><i class="fa fa-thumbs-up icon-approve"></i></button>
																					
										    <?php } ?>	
										    <a title="<?php echo $text_delete?>" href="<?php echo $myaddsinfos['delete']?>"> <button type="button"><i class="la la-trash icon-ddel"></i></button>
						     				 </a>
							
										</div>
								
									</div>
								</div>
							 </div>
							<div class="clearfix"></div>		
							</div>
					<?php } } else { ?>
			                <div class="notfound">
			                <div class="text-center">
							   <?php echo $text_no_results; ?>
							</div>
			              </div>
			              <?php } ?>
			              </form>
						<div class="row">
						<div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
						<div class="col-sm-6 text-right"><?php echo $results; ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
			
 <!-- ad-single end here -->
	</div>
</div>
</div>

<!-- model -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    <div class="tab-first"></div>
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
			<?php if($currentdate > $expirydate) { ?>
			    <h3 class="modal-title"><b><?php echo $text_error_planexpiry; ?></b></h3>
			<?php } else { ?>
            <h3 class="modal-title"><b><?php echo $text_error_planrenew; ?></b></h3>
            <?php } ?>
        </div>
      </div>
    </div>
  </div>

<!-- model -->
<?php echo $footer; ?>