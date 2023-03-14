<div class="form-horizontal row category"  id="formsearch">
  <div class="form-group">
    
    <div class="col-sm-3 paddright">
      <select class="selectpicker form-control bs-select-hidden classified_searchdata" name="classified_category_id">
        <option value=""><?php echo $text_selectcat;?></option>
        <?php foreach ($categories as $category) { ?>
          <?php if ($category['classified_category_id'] == $classified_category_id) { ?>
          <option value="<?php echo $category['classified_category_id']?>"selected="selected"><?php echo $category['name']?></option>
             <?php } else { ?>
        <option value="<?php echo $category['classified_category_id']?>"><?php echo $category['name']?></option>
        <?php } ?>
        <?php } ?>
      </select>
    </div>
    <div class="col-sm-9 search">
      <div id="search" class="input-group">
        <input id="serch-input" type="text" name="filter_name" value="<?php echo $filter_name; ?>" placeholder="<?php echo $text_search; ?>" class="form-control input-lg" />
        <span class="input-group-btn">
          <button  class="btn btn-default btn-lg  searchbtn" type="button" id="findsearch" ><i class="icon_search"></i> </button>
        </span>
      </div>
    </div>
  </div>
</div>

  <script type="text/javascript">
$(document).on('click','.searchbtn',function() {

    url= 'index.php?route=classified/classified_search';
 
  var filter_name = $('input[name=\'filter_name\']').val();
  if (filter_name) {
    url += '&filter_name=' + encodeURIComponent(filter_name);
  }
  
  var classified_category_id = $('select[name=\'classified_category_id\']').val();
  if (classified_category_id) {
    url += '&classified_category_id=' + encodeURIComponent(classified_category_id);
  } 

  location = url;
});

    $('#serch-input').on('keydown', function(e) {
    if (e.keyCode == 13) {
      $('.searchbtn').trigger('click');
    }
});

 </script> 