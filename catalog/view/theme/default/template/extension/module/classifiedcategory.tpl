<div id="column-left-category" class="list-group">
    <h2><?php echo $heading_title; ?></h2>
	<form name="form">
	   <div class="list-group">
			<ul class="list-unstyled">
				<li>
			 <label class="control-label" for="input-status"><?php echo $text_country; ?></label>
				<select name="country_id" id="country_id" class="form-control  classified_search_data">
					<option value=""><?php echo $text_selectcountry; ?></option>
				    <?php foreach ($countries as $countrie) { ?>
					<option value="<?php echo $countrie['country_id']?>"><?php echo $countrie['name']?></option>
				<?php } ?>
				</select>
				</li>
				<li>
				 <label class="control-label" for="input-status"><?php echo $text_state; ?></label>
				<select name="zone_id" id="input-zone" class="form-control classified_search_data">
					<option value=""><?php echo $text_selectstate; ?></option>
				</select>
				</li>

			

				<li>
				<label class="control-label" for="input-status"><?php echo $text_subcategory; ?></label>
				<select id="inputState" class="form-control classified_search_data" name="sub_category_id">
				    <option value=""><?php echo $text_selectcategory; ?></option>
					<?php foreach ($sub_subcategory as $subsubcategory) { ?>
					<option value="<?php echo $subsubcategory['classified_category_id']; ?>"><?php echo $subsubcategory['name']; ?>
					</option>
				   <?php } ?>

				</select>
				</li>
				<li>
					<label class="control-label" for="input-status"><?php echo $text_ssubcategory; ?></label>
					<select id="subcategory" class="form-control classified_search_data" name="sub_sub_category_id">
						<option value=""><?php echo $text_selectscategory; ?></option>
					</select>

				</li>

				<span class="postcategory"></span>
		    </ul>
		</div>
    </form>
</div>
<script type="text/javascript">
    $('document').ready(function(){
          classifiedcategoryid();
    })

$('select[name=\'country_id\']').on('change', function() {

  $.ajax({
    url: 'index.php?route=extension/module/classifiedcategory/country&country_id=' + this.value,
    dataType: 'json',
    beforeSend: function() {
      $('select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
    },
    complete: function() {
      $('.fa-spin').remove();
    },
    success: function(json) {
      if (json['postcode_required'] == '1') {
        $('input[name=\'postcode\']').parent().parent().addClass('required');
      } else {
        $('input[name=\'postcode\']').parent().parent().removeClass('required');
      }
      html = '<option value=""><?php echo $text_selectstate	; ?></option>';
      if (json['zone'] && json['zone'] != '') {
        for (i = 0; i < json['zone'].length; i++) {
          html += '<option value="' + json['zone'][i]['zone_id'] + '"';

          if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
            html += ' selected="selected"';
          }

          html += '>' + json['zone'][i]['name'] + '</option>';
        }
      } else {
        html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
      }

      $('select[name=\'zone_id\']').html(html);
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});
$('select[name=\'country_id\']').trigger('change');
</script>
<script type="text/javascript">
$('select[name=\'zone_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=extension/module/classifiedcategory/zone&zone_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'zone_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
		},
		complete: function() {
			$('.fa-spin').remove();

		},
		success: function(json) {

		html = '<option value=""><?php echo $text_select; ?></option>';

		if (json['city'] && json['city'] != '') {
		for (i = 0; i < json['city'].length; i++) {
		  html += '<option value="' + json['city'][i]['city_id'] + '"';

		  if (json['city'][i]['city_id'] == '<?php echo $city_id; ?>') {
		    html += ' selected="selected"';
		  }

		  html += '>' + json['city'][i]['cityname'] + '</option>';
		}
		} else {
		html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
		}

		$('select[name=\'city_id\']').html(html);

		},

		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
</script>
<script>
$('select[name=\'sub_category_id\']').on('change', function() {
  $.ajax({
    url: 'index.php?route=extension/module/classifiedcategory/subcategory&classified_category_id=' + this.value,
    dataType: 'json',
    beforeSend: function() {
      $('select[name=\'sub_category_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
    },
    complete: function() {
      $('.fa-spin').remove();
    },
    success: function(json) {
      html = '<option value=""><?php echo $text_select; ?></option>';
      if (json['sub_subcategory'] && json['sub_subcategory'] != '') {
        for (i = 0; i < json['sub_subcategory'].length; i++) {
          html += '<option value="' + json['sub_subcategory'][i]['classified_category_id'] + '"';
          if (json['sub_subcategory'][i]['classified_category_id'] == '<?php echo $sub_sub_category_id; ?>') {
            html += 'selected="selected"';
          }
           html += '>' + json['sub_subcategory'][i]['name'] + '</option>';
        }
      } else {
        html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
      }
      $('select[name=\'sub_sub_category_id\']').html(html);
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});
$('select[name=\'classified_category_id\']').trigger('change');
</script>
<script>
function classifiedcategoryid(json) {
  $.ajax({
  	  url: 'index.php?route=extension/module/classifiedcategory/categoryclassifiedseach&classified_id=<?php echo $classified_category_id;?>&classified_category_id=<?php echo $classified_category_id;?>',
    dataType: 'html',
      success: function(html) {
      $('.postcategory').html(html);
     //$('.subcategoryid').show();
    },
  });
}
</script>
<script>
$(document).on('change','.classified_search_data',function() {
	$.ajax({
	url: 'index.php?route=extension/module/classifiedcategory/seach_filter_category&classified_category_id=<?php echo $classified_category_id;?>',
	data:$('form').serialize(),
	type:     'post',
	dataType:     'html',
      success: function(html) {
     	 $('.resultshow').html(html);
     	 $('.alladdserch').hide();
      },
  });
});
</script>
