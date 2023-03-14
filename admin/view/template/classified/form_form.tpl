<?php echo $header; ?><?php echo $column_left; ?>
<?php $form_option_row = 0; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
			
        <button type="submit" form="form-form" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-form" class="form-horizontal">
			<ul class="nav nav-tabs first">
				<li class="active"><a href="#tab-language" data-toggle="tab"> <?php echo $text_title; ?></a></li>
			
				<li><a href="#tab-formfield" data-toggle="tab"><i class="fa fa-square" aria-hidden="true"></i> <?php echo $tab_formfield; ?></a></li>
				<li><a href="#tab-link" data-toggle="tab"><i class="fa fa-link" aria-hidden="true"></i> <?php echo $tab_link; ?></a></li>
			</ul>
			<div class="tab-content">
            <div class="tab-pane active" id="tab-language">
		
					<div class="tab-pane">	
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-title"><?php echo $entry_title; ?></label>
								<div class="col-sm-10">
									<input type=""text name="title" value="<?php echo $title;?>" placeholder="<?php echo $entry_title; ?>" id="input-title" class="form-control"/>
								<?php if($error_title){  ?>
								<div class="text-danger"><?php echo $error_title; ?></div>
								<?php } ?>
								
								</div>
							</div>
							<div class="form-group hide">
								<label class="col-sm-2 control-label" for="input-title"><?php echo $entry_status; ?></label>
								<div class="col-sm-10">
									<select name="status" id="input-form_status" class="form-control">
									<?php if ($status) { ?>
									<option value="1" selected="selected"><?php echo $text_enable; ?></option>
									<option value="1"><?php echo $text_disable; ?></option>
									<?php } else { ?>
									<option value="1"><?php echo $text_enable; ?></option>
									   <option value="0" selected="selected"><?php echo $text_disable; ?></option>
									<option>
										<?php } ?>
									</select>	
								
								</div>
							</div>
						</div>
		
				</div>
				<div class="tab-pane" id="tab-link">
				
				<div class="form-group">
                <label class="col-sm-2 control-label" for="input-category"><span data-toggle="tooltip" title="<?php echo $help_category; ?>"><?php echo $entry_category; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="category" value="" placeholder="<?php echo $entry_category; ?>" id="input-category" class="form-control" />
                  <div id="form_category" class="well well-sm" style="height: 150px; overflow: auto;">
				   <?php if(isset($categories)) {
                    foreach ($categories as $category) { ?>
                    <div id="form_category<?php echo $category['classified_category_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $category['name']; ?>
                      <input type="hidden" name="category_post[]" value="<?php echo $category['classified_category_id']; ?>" />
                    </div>
                    <?php } 
				   } ?>
                  </div>
                </div>
              </div>
			</div>
<!-- Form Field Start -->
<div class="tab-pane" id="tab-formfield">
	<div class="row">
		<div class="col-sm-2">
			<ul class="nav nav-pills nav-stacked" id="formfield">
				<?php $form_row = 0; ?>
					<?php foreach ($optionfieldss as $option_fields) { ?>
					<li><a href="#tab-formfield<?php echo $form_row; ?>" data-toggle="tab"><i class="fa fa-minus-circle delete" rel="<?php echo $option_fields['field_id']; ?>" onclick="$('#formfield a:first').tab('show'); $('#formfield a[href=\'#tab-formfield<?php echo $form_row; ?>\']').parent().remove(); $('#tab-formfield<?php echo $form_row; ?>').remove();"></i> <?php if(!empty($option_fields['form_field_description'][1]['field_name'])) { ?><?php echo $option_fields['form_field_description'][1]['field_name']; ?>
					<?php } else { ?>
					<?php echo $tab_option.$form_row; 
					} ?>
					</a></li>
					<?php $form_row++; ?>
				<?php } ?>
					<li id="formfield-add"><a onclick="addFormfield();" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?php echo $button_address_add; ?></a></li>
			</ul>
		</div>
		<div class="col-sm-10">
            <div class="tab-content one">
				<?php $form_row = 0; ?>
					<?php if(isset($optionfieldss)) { ?>
						<?php foreach ($optionfieldss as $option_fields) { ?>
				<div class="tab-pane active" id="tab-formfield<?php echo $form_row; ?>">
					<ul class="nav nav-tabs fieldslanguage" id="forms_fields<?php echo $form_row; ?>">
						<?php foreach ($languages as $language) { ?>
							<li><a href=".fieldslanguage<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
						<?php } ?>
					</ul>
					<div class="tab-content">
					<input type="hidden" name="option_fields[<?php echo $form_row; ?>][field_id]" value="<?php echo $option_fields['field_id']?>">
						<?php foreach ($languages as $language) { ?>
							<div class="tab-pane fields fieldslanguage<?php echo $language['language_id']; ?>" id="forms_fields<?php echo $language['language_id']; ?>">
								<div class="form-group">
									<label class="control-label col-sm-2" for="input-field_name<?php echo $form_row; ?>"><span data-toggle="tooltip" title="<?php echo $help_fieldname; ?>"><?php echo $entry_fieldname;?></span></label>
									<div class="col-sm-10">
									<input type="text" name="option_fields[<?php echo $form_row; ?>][form_fields][<?php echo $language['language_id']; ?>][field_name]" value="<?php echo isset($option_fields['form_field_description'][$language['language_id']]) ? $option_fields['form_field_description'][$language['language_id']]['field_name'] : ''; ?>" placeholder="<?php echo $entry_fieldname; ?>" id="input-field_name<?php echo $form_row; ?>" class="form-control" />
									</div>	
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="input-help_text<?php echo $form_row; ?>"><span data-toggle="tooltip" title="<?php echo $help_helptext; ?>"><?php echo $entry_helptext; ?></span></label>
									<div class="col-sm-10">
									<input type="text" name="option_fields[<?php echo $form_row; ?>][form_fields][<?php echo $language['language_id']; ?>][help_text]" value="<?php echo isset($option_fields['form_field_description'][$language['language_id']]) ? $option_fields['form_field_description'][$language['language_id']]['help_text'] : ''; ?>" placeholder="<?php echo $entry_helptext; ?>" id="input-help_text<?php echo $form_row; ?>" class="form-control" />
									</div>	
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="input-placeholder<?php echo $form_row; ?>"><span data-toggle="tooltip" title="<?php echo $help_placeholder; ?>"><?php echo $entry_placeholder; ?></span></label>
									<div class="col-sm-10">
									<input type="text" name="option_fields[<?php echo $form_row; ?>][form_fields][<?php echo $language['language_id']; ?>][placeholder]" value="<?php echo isset($option_fields['form_field_description'][$language['language_id']]) ? $option_fields['form_field_description'][$language['language_id']]['placeholder'] : ''; ?>" placeholder="<?php echo $entry_placeholder; ?>" id="input-placeholder<?php echo $form_row; ?>" class="form-control" />
									</div>	
								</div>
								<div class="form-group hide">
									<label class="control-label col-sm-2" for="input-error_message<?php echo $form_row; ?>"><span data-toggle="tooltip" title="<?php echo $help_error; ?>"><?php echo $entry_error; ?></span></label>
									<div class="col-sm-10">
										<input type="text" name="option_fields[<?php echo $form_row; ?>][form_fields][<?php echo $language['language_id']; ?>][error_message]" value="<?php echo isset($option_fields['form_field_description'][$language['language_id']]) ? $option_fields['form_field_description'][$language['language_id']]['error_message'] : ''; ?>" placeholder="<?php echo $entry_error; ?>" id="input-error_message<?php echo $form_row; ?>" class="form-control" />
									</div>	
								</div>
								</div>
								<?php } ?>
								<div class="form-group">
									<label class="control-label col-sm-2" for="input-form_status"><?php echo $entry_status; ?></label>
									<div class="col-sm-10">
										<select name="option_fields[<?php echo $form_row; ?>][form_status]" id="input-form_status" class="form-control">
										<?php if ($option_fields['form_status']) { ?>
										<option value="1" selected="selected"><?php echo $text_enable; ?></option>
										<option value="0"><?php echo $text_disable; ?></option>
										<?php } else { ?>
										<option value="1"><?php echo $text_enable; ?></option>
										<option value="0" selected="selected"><?php echo $text_disable; ?></option>
										<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group hide">
									<label class="control-label col-sm-2" for="input-required"><?php echo $entry_required; ?></label>
									<div class="col-sm-10">
										<select name="option_fields[<?php echo $form_row; ?>][required]" id="input-required" class="form-control">
										<?php if ($option_fields['required']) { ?>
										<option value="1" selected="selected"><?php echo $text_yes; ?></option>
										<option value="0"><?php echo $text_no; ?></option>
										<?php } else { ?>
										<option value="1"><?php echo $text_yes; ?></option>
										<option value="0" selected="selected"><?php echo $text_no; ?></option>
										<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="input-sortorder<?php echo $form_row; ?>"><span data-toggle="tooltip" title="<?php echo $help_error; ?>"><?php echo $entry_sortorder; ?></span></label>
									<div class="col-sm-10">
										<input type="text" name="option_fields[<?php echo $form_row; ?>][sort_order]" value="<?php echo $option_fields['sort_order']; ?>" placeholder="<?php echo $entry_sortorder; ?>" id="input-sortorder<?php echo $form_row; ?>" class="form-control" />
									</div>	
								</div>
								<div class="form-group">	
									<label class="control-label col-sm-2" for="input-type"><?php echo $entry_type; ?></label>			 
									<div class="col-sm-10">						
									<select name="option_fields[<?php echo $form_row; ?>][type]" id="input-type[<?php echo $form_row; ?>]" class="form-control typeoptions" rel="<?php echo $form_row; ?>">									 
									<optgroup label="<?php echo $text_choose; ?>">
									<?php if ($option_fields['type'] == 'select') { ?>		<option value="select" selected="selected"><?php echo $text_selects; ?></option>
									<?php } else { ?>							  
										<option value="select"><?php echo $text_selects; ?></option>
									<?php } ?>
									<?php if ($option_fields['type'] == 'radio') { ?>		<option value="radio" selected="selected"><?php echo $text_radio; ?></option>	
									<?php } else { ?>							 
										<option value="radio"><?php echo $text_radio; ?></option>	
									<?php } ?>
								
									
									
									</optgroup>										 
									<optgroup label="<?php echo $text_input; ?>">
									<?php if ($option_fields['type'] == 'text') { ?>	<option value="text" selected="selected"><?php echo $text_text; ?></option>
									<?php } else { ?>
									<option value="text"><?php echo $text_text; ?></option>
									<?php } ?>
									<?php if ($option_fields['type'] == 'textarea') { ?>
										<option value="textarea" selected="selected"><?php echo $text_textarea; ?></option>
									<?php } else { ?>
										<option value="textarea"><?php echo $text_textarea;?></option>
									<?php } ?>
									<?php if ($option_fields['type'] == 'number') { ?>
										<option value="number" selected="selected"><?php echo $text_number; ?></option>
									<?php } else { ?>
										<option value="number"><?php echo $text_number; ?></option>
									<?php } ?>
										<?php if ($option_fields['type'] == 'telephone') { ?>
											<option value="telephone" selected="selected"><?php echo $text_telephone; ?></option>
											<?php } else { ?>
											<option value="telephone"><?php echo $text_telephone; ?></option>	
										<?php } ?>
									</optgroup>				 
									</select>									 
								</div>										 
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<div class="table-responsive" id="form_option<?php echo $form_row; ?>" 
									<?php if(empty($option_fields['form_field_options'])) { ?>
									style="display:none"
									<?php } ?>>
										<table id="tab-formfield<?php echo $form_row; ?>" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
											<td class="text-left"><?php echo $entry_option_value; ?></td>
											<td class="text-left hide"><?php echo $entry_image; ?></td>
											<td class="text-right"><?php echo $entry_sort_order; ?></td>
											<td></td>
											</tr>
										</thead>
										<tbody>
											<?php if(!empty($option_fields['form_field_options'])) {
												foreach($option_fields['form_field_options'] as $option_type) {  ?>
												<tr id="form_option-row<?php echo $form_option_row?>">	
													<td class="text-left"><input type="hidden" name="option_fields[<?php echo $form_row?>][option_type][<?php echo $form_option_row?>][form_id]" value="" />
													<?php foreach ($languages as $language) { ?>
													<div class="input-group">
														<span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></span><input type="text" name="option_fields[<?php echo $form_row?>][option_type][<?php echo $form_option_row?>][option_value_description][<?php echo $language['language_id']; ?>][name]" value="<?php echo $option_type['name'][$language['language_id']]?>" placeholder="<?php echo $entry_option_value; ?>" class="form-control" />
													</div>
													<?php } ?>
													</td>
													<td class="text-left hide"><a href="" id="thumb-image<?php echo $form_option_row?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo  $option_type['thumb']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="option_fields[<?php echo $form_row?>][option_type][<?php echo $form_option_row?>][image]" value="<?php echo $option_type['image']?>" id="input-image<?php echo $form_option_row?>" /></td>
													<td class="text-right"><input type="text" name="option_fields[<?php echo $form_row?>][option_type][<?php echo $form_option_row?>][sort_order]"  value="<?php echo $option_type['sort_order']?>" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>
													<td class="text-left"><button type="button" onclick="$('#form_option-row<?php echo $form_option_row?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
												</tr>
											<?php $form_option_row++; } } ?>
											</tbody>
											<tfoot>
												<tr>
													<td colspan="2"></td>
													<td class="text-left"><button type="button" onclick="addFormOption('<?php echo $form_row; ?>');" data-toggle="tooltip" title="<?php echo $button_option_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
												</tr>
											</tfoot>
										</table>
									</div>	
							</div>			
							</div>
					</div>
				</div>
				<?php $form_row++; ?>
				<?php } ?>	
				<?php } ?>
			</div>
		</div>
	</div>
    </div>
	</div>		
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
  <link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
  <script type="text/javascript" src="view/javascript/summernote/opencart.js"></script>
<script type="text/javascript"><!--
var form_option_row = <?php echo $form_option_row; ?>;
var form_row = <?php echo $form_row; ?>;

function addFormfield() {
	html  = ' <div class="tab-pane active" id="tab-formfield' + form_row + '">';
	html += ' <ul class="nav nav-tabs fieldslanguage fieldslanguaget' + form_row + '" id="forms_fields' + form_row + '">';
	<?php foreach ($languages as $language) { ?>
	html += ' <li><a href="#forms_fields_' + form_row + '_<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>';
	<?php } ?>
	html += ' </ul>';
	html += '<div class="tab-content">';
	<?php foreach ($languages as $language) { ?>
	
	html += '<div class="tab-pane fields fieldslanguage<?php echo $language['language_id']; ?>" id="forms_fields_' + form_row + '_<?php echo $language['language_id']; ?>">';
	html += '  <input type="hidden" name="option_fields[' + form_row + '][form_id]" value="" />';
	html += ' <div class="form-group">';
	html += '    <label class="control-label col-sm-2" for="input-field_name<?php echo $language['language_id']; ?>' + form_row + '"><span data-toggle="tooltip" title="<?php echo $help_fieldname; ?>"><?php echo $entry_fieldname;?></span></label><div class="col-sm-10">';										 
	html += '    <input type="text" name="option_fields[' + form_row + '][form_fields][<?php echo $language['language_id']; ?>][field_name]" value="" id="input-fieldname' + form_row + '" placeholder="<?php echo $entry_fieldname; ?>" class="form-control"></div>';
    html += ' </div>';
   		
	html += ' <div class="form-group">';
	html += '    <label class="control-label col-sm-2" for="input-help_text<?php echo $language['language_id']; ?>' + form_row + '"><span data-toggle="tooltip" title="<?php echo $help_helptext; ?>"><?php echo $entry_helptext;?></span></label><div class="col-sm-10">';										 
	html += '    <input type="text" name="option_fields[' + form_row + '][form_fields][<?php echo $language['language_id']; ?>][help_text]" value="" id="input-help_text<?php echo $language['language_id']; ?>' + form_row + '" placeholder="<?php echo $entry_helptext; ?>" class="form-control"></div>';
    html += ' </div>';
	
	html += ' <div class="form-group">';
	html += '    <label class="control-label col-sm-2" for="input-placeholder<?php echo $language['language_id']; ?>' + form_row + '"><span data-toggle="tooltip" title="<?php echo $help_placeholder; ?>"><?php echo $entry_placeholder;?></span></label><div class="col-sm-10">';										 
	html += '    <input type="text" name="option_fields[' + form_row + '][form_fields][<?php echo $language['language_id']; ?>][placeholder]" value="" id="input-placeholder<?php echo $language['language_id']; ?>' + form_row + '" placeholder="<?php echo $entry_placeholder; ?>" class="form-control"></div>';
    html += ' </div>';										 
		
	html += ' <div class="form-group hide">';
	html += '   <label class="control-label col-sm-2" for="input-error_message<?php echo $language['language_id']; ?>' + form_row + '"><span data-toggle="tooltip" title="<?php echo $help_error; ?>"><?php echo $entry_error;?></span></label> <div class="col-sm-10">';										 
	html += '    <input type="text" name="option_fields[' + form_row + '][form_fields][<?php echo $language['language_id']; ?>][error_message]" value="" id="input-error_message<?php echo $language['language_id']; ?>' + form_row + '" placeholder="<?php echo $entry_error; ?>" class="form-control"></div>';
    html += ' </div>';										 
    html += ' </div>';										 
	<?php } ?>	
	html += '<div class="form-group">';										 
	html += '		<label class="control-label col-sm-2" for="input-form_status' + form_row + '"><?php echo $entry_status; ?></label>';
	html += '	<div class="col-sm-10">';										 
											 
	html += '		<select name="option_fields[' + form_row + '][form_status]" id="input-form_status" class="form-control">';
						<?php if ($form_status) { ?>										 
	html += '			<option value="1" selected="selected"><?php echo $text_enable; ?></option>';										 
	html += '			<option value="0"><?php echo $text_disable; ?></option>';
						<?php } else { ?>						 
	html += '			<option value="1"><?php echo $text_enable; ?></option>';										 
	html += '			<option value="0" selected="selected"><?php echo $text_disable; ?></option>';
						<?php } ?>			  
	html += '		</select>';										 
	html += '	</div>';										 
	html += '</div>';
											 
	html += '<div class="form-group hide">';										 
	html += '		<label class="control-label col-sm-2" for="input-required' + form_row + '"><span data-toggle="tooltip" title="<?php echo $help_required; ?>"><?php echo $entry_required;?></span></label>';html += '	<div class="col-sm-10">';										 
											 
	html += '		<select name="option_fields[' + form_row + '][required]" id="input-required" class="form-control">';
						<?php if ($required) { ?>										 
	html += '			<option value="1" selected="selected"><?php echo $text_yes; ?></option>';										 
	html += '			<option value="0"><?php echo $text_no; ?></option>';
						<?php } else { ?>						 
	html += '			<option value="1"><?php echo $text_yes; ?></option>';										 
	html += '			<option value="0" selected="selected"><?php echo $text_no; ?></option>';
						<?php } ?>			  
	html += '		</select>';										 
	html += '	</div>';										 
	html += '</div>';										 
	

	html += ' <div class="form-group">';
	html += ' <label class="control-label col-sm-2" for="input-sortorder<?php echo $language['language_id']; ?>' + form_row + '"><?php echo $entry_sortorder;?></label><div class="col-sm-10">';										 
	html += '    <input type="text" name="option_fields[' + form_row + '][sort_order]" value="" id="input-sortorder' + form_row + '" placeholder="<?php echo $entry_sortorder; ?>" class="form-control"></div>';
    html += ' </div>';	
	html += '<div class="form-group">';	
	html += '		<label class="control-label col-sm-2" for="input-type"><?php echo $entry_type; ?></label>';html += '	<div class="col-sm-10">';										 
	html += '		<select name="option_fields[' + form_row + '][type]" id="input-type' + form_row + '" class="form-control typeoptions" rel="'+form_row+'">';										 
	html += '			<optgroup label="<?php echo $text_choose; ?>">';
						<?php if ($type == 'select') { ?>					 
	html += '			<option value="select" selected="selected"><?php echo $text_selects; ?></option>';
						<?php } else { ?>							  
	html += '			<option value="select"><?php echo $text_selects; ?></option>';
						<?php } ?>
						<?php if ($type == 'radio') { ?>			  
	html += '			<option value="radio" selected="selected"><?php echo $text_radio; ?></option>';	
						<?php } else { ?>							 
	html += '			<option value="radio"><?php echo $text_radio; ?></option>';	
						<?php } ?>
	html += '			</optgroup>';										 
	html += '			<optgroup label="<?php echo $text_input; ?>">';
						<?php if ($type == 'text') { ?>				 
	html += '			<option value="text" selected="selected"><?php echo $text_text; ?></option>';
						<?php } else { ?>
	html += '			<option value="text"><?php echo $text_text; ?></option>';
						<?php } ?>
						<?php if ($type == 'textarea') { ?>
	html += '			<option value="textarea" selected="selected"><?php echo $text_textarea; ?></option>';
						<?php } else { ?>
	html += '			<option value="textarea"><?php echo $text_textarea; ?></option>';
						<?php } ?>
						<?php if ($type == 'number') { ?>
	html += '			<option value="number" selected="selected"><?php echo $text_number; ?></option>';
						<?php } else { ?>
	html += '			<option value="number"><?php echo $text_number; ?></option>';
						<?php } ?>
						<?php if ($type == 'telephone') { ?>
	html += '			<option value="telephone" selected="selected"><?php echo $text_telephone; ?></option>';
						<?php } else { ?>
	html += '			<option value="telephone"><?php echo $text_telephone; ?></option>';	
						<?php } ?>
	html += '			</optgroup>';				 
	html += '		    </select>';										 
	html += '	</div>';										 
	html += '</div>';	
	html += '		<div class="form-group">';
	html += '		<div class="col-sm-12">';
	html += '		<div class="table-responsive" id="form_option'+form_row+'">';
	html += '		<table id="tab-formfield'+form_row+'" class="table table-striped table-bordered table-hover">';
	html += '		<thead>';
	html += '		<tr>';
	html += '		<td class="text-left"><?php echo $entry_option_value; ?></td>';
	html += '		<td class="text-left hide"><?php echo $entry_image; ?></td>';
	html += '		<td class="text-right"><?php echo $entry_sort_order; ?></td>';
	html += '		<td></td>';
	html += '		</tr>';
	html += '		</thead>';
	html += '		<tbody>';
		
	html += '		<tr id="form_option-row<?php echo $form_option_row; ?>">';
		
	html += '		</tr>';
			
	html += '		</tbody>';
	html += '		<tfoot>';
	html += '		<tr>';
	html += '		<td colspan="2"></td>';
	html += '		<td class="text-left"><button type="button" onclick="addFormOption('+form_row+');" data-toggle="tooltip" title="<?php echo $button_option_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>';
	html += '		</tr>';
	html += '		</tfoot>';
	html += '		</table>';
	html += '		</div>';
	html += '		</div>';
	html += '		</div></div>';										 
	html += ' </div>';
	
		$('#tab-formfield .one').append(html);
		$('.fieldslanguaget'+form_row+' a:first').tab('show');
		
	$('#formfield-add').before('<li><a href="#tab-formfield' + form_row + '" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$(\'#formfield a:first\').tab(\'show\'); $(\'a[href=\\\'#tab-formfield' + form_row + '\\\']\').parent().remove(); $(\'#tab-formfield' + form_row + '\').remove();"></i> <?php echo $tab_option; ?> ' + form_row + '</a></li>');

	$('#formfield a[href=\'#tab-formfield' + form_row + '\']').tab('show');
		
	$('#tab-formfield' + form_row + ' .form-group[data-sort]').detach().each(function() {
		if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('#tab-formfield' + form_row + ' .form-group').length) {
			$('#tab-formfield' + form_row + ' .form-group').eq($(this).attr('data-sort')).before(this);
		}

		if ($(this).attr('data-sort') > $('#tab-formfield' + form_row + ' .form-group').length) {
			$('#tab-formfield' + form_row + ' .form-group:last').after(this);
		}

		if ($(this).attr('data-sort') < -$('#tab-formfield' + form_row + ' .form-group').length) {
			$('#tab-formfield' + form_row + ' .form-group:first').before(this);
		}
	});

	form_row++;
		
}
</script>
<script type="text/javascript"><!--
$('body').delegate('.typeoptions', 'click', function(e) {
	rel=$(this).attr('rel');
	if (this.value == 'select' || this.value == 'radio' || this.value == 'checkbox' || this.value == 'image') {
		$('#form_option'+rel).show();
	} else {
		$('#form_option'+rel).hide();
	}
});
	
function addFormOption(mainid) {
	html  = '<tr id="form_option-row' + form_option_row + '">';	
    html += '  <td class="text-left"><input type="hidden" name="option_fields[' + mainid + '][option_type][' + form_option_row + '][form_id]" value="" />';
	<?php foreach ($languages as $language) { ?>
	html += '    <div class="input-group">';
	html += '      <span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></span><input type="text" name="option_fields[' + mainid + '][option_type][' + form_option_row + '][option_value_description][<?php echo $language['language_id']; ?>][name]" value="" placeholder="<?php echo $entry_option_value; ?>" class="form-control" />';
    html += '    </div>';
	<?php } ?>
	html += '  </td>';
    html += '  <td class="text-left hide"><a href="" id="thumb-image' + form_option_row + '" data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="option_fields[' + mainid + '][option_type][' + form_option_row + '][image]" value="" id="input-image' + form_option_row + '" /></td>';
	html += '  <td class="text-right"><input type="text" name="option_fields[' + mainid + '][option_type][' + form_option_row + '][sort_order]" value="" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#form_option-row' + form_option_row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';	
	
	$('#form_option'+mainid+' tbody').append(html);
	
	form_option_row++;
}	
</script>	
<script>
    $(function() {
        $('#input-assign-product').change(function(){
            $('.colors').hide();
            $('#' + $(this).val()).show();
        });
		$('#'+$('#input-assign-product option:selected').val()).show();
    });
$(document).on('click','.delete',function() {
	var field_id = $(this).attr('rel');
	$.ajax({
	url: 'index.php?route=classified/form/fielddelete&token=<?php echo $token;?>&field_id='+field_id,
	type:'post',
	dataType:'json',
		beforeSend: function() {
	},
	success: function(json) {
		
	}
});
});
</script>	
<script type="text/javascript">
$('#language a:first').tab('show');
$('.language a:first').tab('show');
</script>
<script type="text/javascript">
$('#language1 a:first').tab('show');
</script>
<script type="text/javascript">
$('.customer_language a:first').tab('show');
</script>
<script type="text/javascript">
$('.fieldslanguage a:first').tab('show');
$('.admin_language a:first').tab('show');
$('#tab-formfield a:first').tab('show');
</script>	
<script type="text/javascript"><!--
$('input[name=\'category\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=classified/classified_category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['classified_category_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'category\']').val('');

		$('#form_category' + item['value']).remove();

		$('#form_category').append('<div id="form_category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="category_post[]" value="' + item['value'] + '" /></div>');
	}
});

$('#form_category').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
</script></div>

<?php echo $footer; ?>

