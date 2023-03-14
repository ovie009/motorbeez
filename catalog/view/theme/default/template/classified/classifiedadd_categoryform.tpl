 			<div id="formbuilder">
				<input type="hidden" name="form_id" value="<?php echo $form_id; ?>"/>
				<?php if ($tmdform_fields) { ?>
				<?php foreach ($tmdform_fields as $optionfield) { ?>
				<?php if ($optionfield['type'] == 'select') { ?>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-formfields<?php echo $optionfield['field_id']; ?>">
						<?php if(!empty($optionfield['help_text'])) { ?><span data-toggle="tooltip" title="<?php echo $optionfield['help_text']; ?>"> <?php }?>
						<?php echo $optionfield['field_name']; ?>
						<?php if(!empty($optionfield['help_text'])) { ?> <i class="fa fa-question-circle" aria-hidden="true"></i> </span><?php } ?>
						</label>
						<div class="col-sm-10">
							<div id="input-formfields<?php echo $optionfield['field_id']; ?>">
							<select name="formfields[<?php echo $optionfield['field_id']; ?>]"  class="form-control">
								<option value="">--Please Select--</option>
								<?php foreach ($optionfield['form_field_option'] as $option_value) { ?>
								<?php if($optionfield['value'] ==$option_value['name']) { ?>
								<option value="<?php echo $option_value['name']; ?>" selected="selected"><?php echo $option_value['name']; ?></option>
								<?php } else { ?>
								<option value="<?php echo $option_value['name']; ?>"><?php echo $option_value['name']; ?></option>

								<?php } }?>
							</select>
						</div>
						</div>
					</div>
				<?php } ?>
				<?php if ($optionfield['type'] == 'radio') { ?>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php if(!empty($optionfield['help_text'])) { ?><span data-toggle="tooltip" title="<?php echo $optionfield['help_text']; ?>"> <?php }?>
					<?php echo $optionfield['field_name']; ?>
					<?php if(!empty($optionfield['help_text'])) { ?> <i class="fa fa-question-circle" aria-hidden="true"></i> </span><?php } ?>
					</label>
					<div class="col-sm-10">
						<div id="input-formfields<?php echo $optionfield['field_id']; ?>">
							<?php foreach ($optionfield['form_field_option'] as $option_value) { ?>
									<?php if(!empty($optionfield['value']== $option_value['name'])) { ?>
								<div class="radio-inline">
								  <input  id="checkLabel<?php echo $option_value['name']; ?>"  class="checkbox-radio" checked="checked" type="radio" name="formfields[<?php echo $option_value['field_id']; ?>]" value="<?php echo $option_value['name']; ?>"/><?php echo $option_value['name']; ?>
									<label  for="checkLabel<?php echo $option_value['name']; ?>" class="radio-inline">
									</label>
								</div>
								<?php } else { ?>
								<div class="radio-inline">
								  <input  id="checkLabel<?php echo $option_value['name']; ?>"  class="checkbox-radio"  type="radio" name="formfields[<?php echo $option_value['field_id']; ?>]" value="<?php echo $option_value['name']; ?>"/><?php echo $option_value['name']; ?>
									<label  for="checkLabel<?php echo $option_value['name']; ?>" class="radio-inline">
									</label>
								</div>
								<?php } ?>

							<?php }  ?>
						</div>
					</div>
				</div>
				<?php } ?>
				<?php if ($optionfield['type'] == 'checkbox') { ?>
				<div class="form-group">
				  <label class="col-sm-2 control-label">
				  <?php if(!empty($optionfield['help_text'])) { ?><span data-toggle="tooltip" title="<?php echo $optionfield['help_text']; ?>"> <?php }?>
				  <?php echo $optionfield['field_name']; ?>
				  <?php if(!empty($optionfield['help_text'])) { ?> <i class="fa fa-question-circle" aria-hidden="true"></i> </span><?php } ?>
				  </label>
				  <div class="col-sm-10">
				  <div id="input-formfields<?php echo $optionfield['field_id']; ?>">
					<?php foreach ($optionfield['form_field_option'] as $option_value) { ?>
					<div class="checkbox-inline">
					  <label>
						<input type="checkbox" name="formfields[<?php echo $optionfield['field_id']; ?>][]" value="<?php echo $option_value['name']; ?>" />
						<?php echo $option_value['name']; ?>

					  </label>
					</div>
					<?php } ?>
				  </div>
				  </div>
				</div>
				<?php } ?>
				<?php if ($optionfield['type'] == 'text') { ?>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-formfields<?php echo $optionfield['field_id']; ?>">
						<?php if(!empty($optionfield['help_text'])) { ?><span data-toggle="tooltip" title="<?php echo $optionfield['help_text']; ?>"> <?php }?> <?php echo $optionfield['field_name']; ?>
					   <?php if(!empty($optionfield['help_text'])) { ?> <i class="fa fa-question-circle" aria-hidden="true"></i> </span><?php } ?>
					</label>
					<div class="col-sm-10">
						<input type="text" name="formfields[<?php echo $optionfield['field_id']; ?>]" value="<?php echo $optionfield['value']; ?>" placeholder="<?php echo $optionfield['placeholder']; ?>" id="input-formfields<?php echo $optionfield['field_id']; ?>" class="form-control" />
					</div>
				</div>
				<?php } ?>
				<?php if ($optionfield['type'] == 'textarea') { ?>
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="input-formfields<?php echo $optionfield['field_id']; ?>">
				  <?php if(!empty($optionfield['help_text'])) { ?><span data-toggle="tooltip" title="<?php echo $optionfield['help_text']; ?>"> <?php }?>
				  <?php echo $optionfield['field_name']; ?>
					<?php if(!empty($optionfield['help_text'])) { ?> <i class="fa fa-question-circle" aria-hidden="true"></i> </span><?php } ?>
				  </label>
				  <div class="col-sm-10">
				  <textarea name="formfields[<?php echo $optionfield['field_id']; ?>]" rows="5" placeholder="<?php echo $optionfield['placeholder']; ?>" id="input-formfields<?php echo $optionfield['field_id']; ?>" class="form-control"><?php echo $optionfield['value']; ?></textarea>
				  </div>
				</div>
				<?php } ?>

				<?php if ($optionfield['type'] == 'number') { ?>
				<div class="form-group">
				<label class="col-sm-2  control-label" for="input-formfields<?php echo $optionfield['field_id']; ?>">
					<?php if(!empty($optionfield['help_text'])) { ?><span data-toggle="tooltip" title="<?php echo $optionfield['help_text']; ?>"> <?php }?>
					<?php echo $optionfield['field_name']; ?>
					<?php if(!empty($optionfield['help_text'])) { ?> <i class="fa fa-question-circle" aria-hidden="true"></i> </span><?php } ?>
				</label>
					<div class="col-sm-10">
						<input type="text" name="formfields[<?php echo $optionfield['field_id']; ?>]" value="" placeholder="<?php echo $optionfield['placeholder']; ?>" id="input-option<?php echo $optionfield['field_id']; ?>" class="form-control" />
					</div>
				</div>
				<?php } ?>

				<?php if ($optionfield['type'] == 'telephone') { ?>
				<div class="form-group">
				<label class="col-sm-2  control-label" for="input-formfields<?php echo $optionfield['field_id']; ?>">
					<?php if(!empty($optionfield['help_text'])) { ?><span data-toggle="tooltip" title="<?php echo $optionfield['help_text']; ?>"> <?php }?>
					<?php echo $optionfield['field_name']; ?>
					<?php if(!empty($optionfield['help_text'])) { ?> <i class="fa fa-question-circle" aria-hidden="true"></i> </span><?php } ?>
				</label>
					<div class="col-sm-10">
						<input type="text" name="formfields[<?php echo $optionfield['field_id']; ?>]" value="" placeholder="<?php echo $optionfield['placeholder']; ?>" id="input-formfields<?php echo $optionfield['field_id']; ?>" class="form-control" />
					</div>
				</div>
				<?php } ?>


				<?php } ?>
				<?php } ?>
				<!-- captcha start end-->
			</div>
