<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-city').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-city">
		 <div class="table-responsive">
        <table class="list table table-bordered table-hover hidden-xs">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="left"><?php if ($sort == 'c.name') { ?>
                <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
                <?php } ?></td>
              <td class="left"><?php if ($sort == 'z.name') { ?>
                <a href="<?php echo $sort_zone; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_zone; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_zone; ?>"><?php echo $column_zone; ?></a>
                <?php } ?></td>
              <td class="left"><?php if ($sort == 'ct.name') { ?>
                <a href="<?php echo $sort_country; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_country; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_country; ?>"><?php echo $column_country; ?></a>
                <?php } ?></td>
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <?php
             if ($cities) { ?>
            <?php foreach ($cities as $city) { ?>
            <tr>
              <td style="text-align: center;"><?php if ($city['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $city['city_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $city['city_id']; ?>" />
                <?php } ?></td>
              <td class="left"><?php echo $city['cityname']; ?></td>
              <td class="left"><?php echo $city['zone']; ?></td>
              <td class="left"><?php echo $city['country']; ?></td>
               <td class="text-right"><a href="<?php echo $city['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
             <tr>
                  <td class="text-center" colspan="5"><?php echo $text_no_results; ?></td>
                </tr>
            <?php } ?>
          </tbody>
        </table>
		 <table class="list table table-bordered table-hover hidden-sm hidden-lg hidden-md">
          <thead>
            <tr>
              <td class="left"><?php if ($sort == 'ct.name') { ?>
                <a href="<?php echo $sort_country; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_country; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_country; ?>"><?php echo $column_country; ?></a>
                <?php } ?></td>
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <?php
             if ($cities) { ?>
            <?php foreach ($cities as $city) { ?>
            <tr>
              <td class="left"><?php echo $city['cityname']; ?></td>
               <td class="text-right"><a href="<?php echo $city['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="2"><?php echo $text_no_results; ?></td>
                </tr>
            <?php } ?>
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
<?php echo $footer; ?>