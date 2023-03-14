<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-ebook').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
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
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
        <div class="well classified-filter-btn">
           <div class="row">
				<div class="col-sm-5">
				  <div class="form-group">
					 <label class="control-label" for="input-customer"><?php echo $column_customer; ?></label>
					<input type="text" name="filter_coustomer" value="<?php echo $filter_coustomer?>" placeholder="<?php echo $column_customer; ?>" id="input-customer" class="form-control" />
					<input type="hidden" name="customer_id" value="<?php echo $customer_id?>" />
				  </div>
				</div>
				<div class="col-sm-5">
				   <div class="form-group">
					<label class="control-label" for="input-title"><?php echo $column_title;?></label>
					<input type="text" name="filter_title" value="<?php echo $filter_title?>" 
					placeholder="<?php echo $column_title;?>" id="input-title" class="form-control" />
				  </div>
				</div>
				<div class="col-sm-2">
					 <div class="form-group">
						<button type="button" id="button-filter" class="btn btn-primary pull-right btn-filterr"><i class="fa fa-filter"></i> <?php echo $button_filter; ?></button>
					 </div>
				</div>
            </div>
        </div>
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-ebook">
          <div class="table-responsive">
            <table class="table table-bordered table-hover hidden-xs">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left"><?php echo $column_customer;?></td>
                  <td class="text-left"><?php echo $column_title;?></td>
                  <td class="text-left"><?php echo $column_price;?></td>
                  <td class="text-left"><?php echo $column_active;?></td>
         
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($allpostlistings)){ ?>
               <?php foreach ($allpostlistings as $allpostlisting) { ?>
                <tr>
                 <td style="width: 1px;" class="text-center"><input type="checkbox"  name="selected[]" value="<?php echo $allpostlisting['classified_id']; ?>" /></td>

                  <td class="text-left"><?php echo $allpostlisting['firstname']?></td>
                  <td class="text-left"><?php echo $allpostlisting['title']?></td>
                  <td class="text-left"><?php echo $allpostlisting['price']?></td>
                  <td class="text-left"><?php echo $allpostlisting['active']?></td>
             
                 <td class="text-right">
                  <?php if(!empty($allpostlisting['approve'])){?>
                  <a href="<?php echo $allpostlisting['approve'];?>" class="btn btn-success">
                    <i class="fa fa-thumbs-o-up"></i>
                  </a>
                  <?php } else{ ?>
                    <button type="button" class="btn btn-success" disabled><i class="fa fa-thumbs-o-up"></i></button>

                  <?php } ?>
                  
                  <?php if(!empty($allpostlisting['disapprove'])){?>
                  <a href="<?php echo $allpostlisting['disapprove']?>"  data-toggle="tooltip" title="" class="btn btn-danger"><i class="fa fa-thumbs-o-down"></i></a>
                  <?php } else{ ?>
                  <button type="button" class="btn btn-danger" disabled><i class="fa fa-thumbs-o-down"></i></button>

                  <?php } ?>

                    <a href="<?php echo $allpostlisting['edit']?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary">
                      <i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
              
             <?php  } }  ?> 

                </tbody>
            </table>
			<!--- table for mobile --->
			<table class="table table-bordered table-hover hidden-sm hidden-md hidden-lg">
              <thead>
                <tr>
                  <td class="text-left"><?php echo $column_title;?></td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($allpostlistings)){ ?>
               <?php foreach ($allpostlistings as $allpostlisting) { ?>
                <tr>
                  <td class="text-left"><?php echo $allpostlisting['title']?></td>
             
                 <td class="text-right">
                  <?php if(!empty($allpostlisting['approve'])){?>
                  <a href="<?php echo $allpostlisting['approve'];?>" class="btn btn-success">
                    <i class="fa fa-thumbs-o-up"></i>
                  </a>
                  <?php } else{ ?>
                    <button type="button" class="btn btn-success" disabled><i class="fa fa-thumbs-o-up"></i></button>

                  <?php } ?>
                  
                  <?php if(!empty($allpostlisting['disapprove'])){?>
                  <a href="<?php echo $allpostlisting['disapprove']?>"  data-toggle="tooltip" title="" class="btn btn-danger"><i class="fa fa-thumbs-o-down"></i></a>
                  <?php } else{ ?>
                  <button type="button" class="btn btn-danger" disabled><i class="fa fa-thumbs-o-down"></i></button>

                  <?php } ?>

                    <a href="<?php echo $allpostlisting['edit']?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary">
                      <i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
              
             <?php  } }  ?> 

                </tbody>
            </table>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
    $('input[name=\'filter_coustomer\']').autocomplete({
    'source': function(request, response) {
    $.ajax({
    url: 'index.php?route=classified/classifiedadd/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
    dataType: 'json',
    success: function(json) {
    response($.map(json, function(item) {
    return {
    label: item['firstname'],
    value: item['customer_id']
    }
    }));
    }
    });
    },
    'select': function(item) {
    $('input[name=\'filter_coustomer\']').val(item['label']);
    $('input[name=\'customer_id\']').val(item['value']);
    }
    });
  </script>
  <script type="text/javascript">
$('#button-filter').bind('click', function() {
  var url = 'index.php?route=classified/classifiedadd&token=<?php echo $token; ?>';
  var filter_title = $('input[name=\'filter_title\']').val();
  if (filter_title) {
    url += '&filter_title=' + encodeURIComponent(filter_title);
  } 

  var filter_coustomer = $('input[name=\'filter_coustomer\']').val();
  if (filter_coustomer) {
    url += '&filter_coustomer=' + encodeURIComponent(filter_coustomer);
  } 
  location = url;
});
</script>
  <script>
$('.date').datetimepicker({
    pickTime: false
  });
</script>
<?php echo $footer; ?>