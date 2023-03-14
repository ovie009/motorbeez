<form class="form-horizontal">
	<div id="formbuilder">
		<input type="hidden" name="form_id" value="<?php echo $form_id; ?>"/>
		<?php if ($tmdform_fields) { ?>
		<?php foreach ($tmdform_fields as $optionfield) { ?>
		<?php if ($optionfield['type'] == 'select') { ?>
			<div class="form-group">
				<label class="col-sm-12 control-label" for="input-formfields<?php echo $optionfield['field_id']; ?>">
				<?php if(!empty($optionfield['help_text'])) { ?><span data-toggle="tooltip" title="<?php echo $optionfield['help_text']; ?>"> <?php }?>
				<?php echo $optionfield['field_name']; ?>
				<?php if(!empty($optionfield['help_text'])) { ?> <i class="fa fa-question-circle" aria-hidden="true"></i> </span><?php } ?>
				</label>
				<div class="col-sm-12">	
					<div id="input-formfields<?php echo $optionfield['field_id']; ?>">
					<select name="formfields[<?php echo $optionfield['field_id']; ?>]"  class="form-control classified_search_data">
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
			<label class="col-sm-12 control-label"><?php if(!empty($optionfield['help_text'])) { ?><span data-toggle="tooltip" title="<?php echo $optionfield['help_text']; ?>"> <?php }?>
			<?php echo $optionfield['field_name']; ?>					
			<?php if(!empty($optionfield['help_text'])) { ?> <i class="fa fa-question-circle" aria-hidden="true"></i> </span><?php } ?>
			</label>					
			<div class="col-sm-12">	
				<div id="input-formfields<?php echo $optionfield['field_id']; ?>">
					<select name="formfields[<?php echo $optionfield['field_id']; ?>]"  class="form-control classified_search_data">
						
						<?php foreach ($optionfield['form_field_option'] as $option_value) { ?>	
						<?php if($optionfield['value'] ==$option_value['name']) { ?>	
						<option value="">--Please Select--</option>						
						<option value="<?php echo $option_value['name']; ?>" selected="selected"><?php echo $option_value['name']; ?></option>
						<?php } else { ?> 
						<option value="<?php echo $option_value['name']; ?>" style="background-color:<?php if(!empty($option_value['name'])){echo $option_value['name'];}?>"><?php echo $option_value['name']; ?></option>
						<?php } }?>
					</select>
				</div>			
			</div>			
		</div>
		<?php } ?>
		<?php if ($optionfield['type'] == 'checkbox') { ?>
		<div class="form-group">
		  <label class="col-sm-12 control-label">
		  <?php if(!empty($optionfield['help_text'])) { ?><span data-toggle="tooltip" title="<?php echo $optionfield['help_text']; ?>"> <?php }?>
		  <?php echo $optionfield['field_name']; ?>
		  <?php if(!empty($optionfield['help_text'])) { ?> <i class="fa fa-question-circle" aria-hidden="true"></i> </span><?php } ?>
		  </label>
		  <div class="col-sm-12">
		  <div id="input-formfields<?php echo $optionfield['field_id']; ?>">
			<?php foreach ($optionfield['form_field_option'] as $option_value) { ?>
			<div class="checkbox">
			  <label>
				<input type="checkbox" name="formfields[<?php echo $optionfield['field_id']; ?>][]"  class="classified_search_data" value="<?php echo $option_value['value']; ?>" />    
				<?php echo $option_value['name']; ?>
			  </label>
			</div>
			<?php } ?>
		  </div>
		  </div>
		</div>
		<?php } ?>
		<?php } ?>
		<?php } ?>	
	   </div>
</form>