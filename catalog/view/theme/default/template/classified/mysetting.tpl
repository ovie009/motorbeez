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
						<div class="col-sm-3 col-xs-12">
						 <?php  if(!empty($profileImage)){?>
							<img class="img-responsive" src="<?php echo $profileImage;?>" alt="image" title="<?php echo $firstname;?>">
						 <?php } else { ?>
							 <img class="img-responsive" src="catalog/view/theme/default/image/profile.png" alt="image" title="image">
							<?php
								}
							?>
						</div>
						<div class="col-sm-9 col-xs-12 padd0">
							<h4><?php echo $customername;?></h4>
							<div class="common">
								<p class="des"><i class="la la-map-marker"></i>  <?php echo $address;?></p>
								<p class="des1"><?php echo $text_account;?> <?php echo $dateadded;?></p>
							</div>
							<ul class="list-inline">
								<li>
									<a href="<?php echo $dashboard?>">
										<i class="fa fa-tachometer" aria-hidden="true"></i><br/>
										<?php echo $text_dashboard;?>
									</a>
								</li>
								<li>
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
								<li class="active">
									<a href="<?php echo $mysetting?>">
										<i class="fa fa-cog" aria-hidden="true"></i> <br/>
										<?php echo $text_setting;?>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="inner-setting">
						 <?php if ($error_warning) { ?>
  						<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning;?>
      						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						</div>
  						<?php } ?>

  						 <?php if ($success) { ?>
  						<div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> <?php echo $success; ?>
					      <button type="button" class="close" data-dismiss="alert">&times;</button>
  						</div>
  						<?php } ?>
						<div class="panel-group" id="accordion">
							<div class="panel panel-default">
								<div class="panel-heading">
									<a data-toggle="collapse"><h4 class="panel-title"> <?php echo $text_changeprofile;?></i></h4></a>
								</div>
								<div id="collapse4" class="panel-collapse ">
									<div class="panel-body">
										<div class="col-sm-2"></div>
										<div class="col-sm-8">
											<form action="<?php echo $action;?>" class="form-horizontal" method="post">
											  <div class="form-group required">
									            <label class="col-sm-2 control-label" for="input-firstname"><?php echo $entry_firstname; ?> </label>
									            <div class="col-sm-10">
									              <input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="<?php echo $entry_firstname; ?>" id="input-firstname" class="form-control" />
									              <?php if ($error_firstname) { ?>
									              <div class="text-danger"><?php echo $error_firstname; ?></div>
									              <?php } ?>
									            </div>
									          </div>

										 <div class="form-group required">
								            <label class="col-sm-2 control-label" for="input-lastname"><?php echo $entry_lastname; ?></label>
								            <div class="col-sm-10">
								              <input type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder="<?php echo $entry_lastname; ?>" id="input-lastname" class="form-control" />
								              <?php if ($error_lastname) { ?>
								              <div class="text-danger"><?php echo $error_lastname; ?></div>
								              <?php } ?>
								            </div>
								          </div>
								          <div class="form-group required">
								            <label class="col-sm-2 control-label" for="input-email"><?php echo $entry_email; ?></label>
								            <div class="col-sm-10">
								              <input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
								              <?php if ($error_email) { ?>
								              <div class="text-danger"><?php echo $error_email; ?></div>
								              <?php } ?>
								            </div>
								          </div>
								           <div class="form-group required">
								            <label class="col-sm-2 control-label" for="input-telephone"><?php echo $entry_telephone; ?></label>
								            <div class="col-sm-10">
								              <input type="tel" name="telephone" value="<?php echo $telephone; ?>" placeholder="<?php echo $entry_telephone; ?>" id="input-telephone" class="form-control" />
								            </div>
								          </div>

								            <div class="form-group required">
								            <label class="col-sm-2 control-label" for="input-telephone"><?php echo $entry_address; ?></label>
								            <div class="col-sm-10">
								              <input type="tel" name="address" value="<?php echo $address; ?>" placeholder="<?php echo $entry_address; ?>" id="input-telephone" class="form-control" />
								            </div>
								          </div>

								           <div class="form-group required">
							            <label class="col-sm-2 control-label" for="input-password"><?php echo $entry_password; ?></label>
							            <div class="col-sm-10">
							              <input type="password" name="password" value="" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />
							              <?php if ($error_password) { ?>
							              <div class="text-danger"><?php echo $error_password; ?></div>
							              <?php } ?>
							            </div>
							          </div>
							          <div class="form-group required">
							            <label class="col-sm-2 control-label" for="input-confirm"><?php echo $entry_confirm; ?></label>
							            <div class="col-sm-10">
							              <input type="password" name="confirm" value="" placeholder="<?php echo $entry_confirm; ?>" id="input-confirm" class="form-control" />
							              <?php if ($error_confirm) { ?>
							              <div class="text-danger"><?php echo $error_confirm; ?></div>
							              <?php } ?>
							            </div>
							          </div>

												<div class="form-group">
												<label class="col-sm-2 control-label" for="input-vendor-image">
														<?php echo $text_image;?>
												</label>
												<div class="col-md-3 col-sm-12 col-xs-12 file text-center ">
												<div class="imagebox">
													<span id="thumb-image">
														<img src="<?php echo $profileImage;?>" data-placeholder="<?php echo $placeholder; ?>" class="thumb">
													</span>
												</div>
												<button type="button" id="button-upload" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default btn-block"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
												<input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
												</div>
												</div>
										        <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
												<div class="form-group">
												<label class="col-sm-2 control-label" for="input-package-title">
													<?php echo $text_descriptions; ?></label>
												<div class="col-sm-10 mydiscription">
												<textarea name="profile_text" cols="10" rows="3" id="input-meta_description"
												class="form-control">
												<?php echo $profile_text; ?>
												</textarea>
												</div>
												</div>
												<div class="form-group">
													<div class="col-sm-2"></div>
														<div class="col-sm-8">
															<div class="buttons">
																<input class="btn btn-primary" value="<?php echo $text_submit; ?>" type="submit">
															</div>
														</div>
													<div class="col-sm-2"></div>
												</div>

											</form>
										</div>
										<div class="col-sm-2"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- ad-single end here -->
	</div>
  </div>
 </div>
<script type="text/javascript"><!--
	$('button[id^=\'button-upload\']').bind('click', function() {
		var node = this;
		$('#form-upload').remove();
		$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');
		$('#form-upload input[name=\'file\']').trigger('click');
		if (typeof timer != 'undefined') {
			clearInterval(timer);
		}
		timer = setInterval(function() {
			if ($('#form-upload input[name=\'file\']').val() != '') {
				clearInterval(timer);
				$.ajax({
					url: 'index.php?route=classified/mysetting/profileupload',
					type: 'post',
					dataType: 'json',
					data: new FormData($('#form-upload')[0]),
					cache: false,
					contentType: false,
					processData: false,
					beforeSend: function() {
						$(node).button('loading');
					},

					complete: function() {
						$(node).button('reset');
					},
					success: function(json) {
						$('.text-danger').remove();

						if (json['error']) {
							$(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
						}

						if (json['success']) {
							var imageurl="<?php echo str_replace('http:','',HTTP_SERVER)?>";
							$("#thumb-image").html('<img src="'+imageurl+"image/"+json['location1']+'" alt="" title="" width="100"/>');
							$("#input-image").val(json['location1']);
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			}
		}, 500);
	});
	$('.noticemsg').click(function() {
		"use strict";
		$.ajax({
			dataType:'json',
			type:   'post',
			url: 'index.php?route=classified/mymessages/replyReadMsg',
			success: function(json) {
			if(json['success']){
				$('.inquerydiv').hide();

			 }
			}
		});
	});
	</script>
<?php echo $footer; ?>
