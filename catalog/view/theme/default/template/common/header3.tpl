<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content= "<?php echo $keywords; ?>" />
<?php } ?>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/63f876b54247f20fefe25f0c/1gq18vdme';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/javascript/jquery-confirm.min.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/default/line-awesome/css/line-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/javascript/js/fastselect.min.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900" rel="stylesheet"> 


<link href="catalog/view/theme/default/stylesheet/newstyle.css" rel="stylesheet">
<link href="catalog/view/theme/default/stylesheet/ele-style.css" rel="stylesheet">
<!--theme stylesheet-->
<?php if ($themecolor=='green') { ?>
<link href="catalog/view/theme/default/stylesheet/stylesheet-green.css" rel="stylesheet">
<?php } elseif($themecolor=='blue') { ?>
<link href="catalog/view/theme/default/stylesheet/stylesheet-blue.css" rel="stylesheet">
<?php } elseif($themecolor=='sky') { ?>
<link href="catalog/view/theme/default/stylesheet/stylesheet-skyblue.css" rel="stylesheet">
<?php } elseif($themecolor=='orange') { ?>
<link href="catalog/view/theme/default/stylesheet/stylesheet-orange.css" rel="stylesheet">
<?php } elseif($themecolor=='purple') { ?>
<link href="catalog/view/theme/default/stylesheet/stylesheet-purple.css" rel="stylesheet">
<?php } elseif($themecolor=='pink') { ?>
<link href="catalog/view/theme/default/stylesheet/stylesheet-pink.css" rel="stylesheet">
<?php } elseif($themecolor=='default') { ?>
<link href="catalog/view/theme/default/stylesheet/style.css" rel="stylesheet">
<?php } else { ?>
<link href="catalog/view/theme/default/stylesheet/style.css" rel="stylesheet">
<?php } ?>
<script src="catalog/view/javascript/jquery-confirm.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/jquery/owl-carousel/owl.carousel.css" type="text/css" rel="stylesheet" media="screen" />
<link href="catalog/view/javascript/dist/css/bootstrap-select.css" rel="stylesheet">
<script src="catalog/view/javascript/dist/js/bootstrap-select.js" type="text/javascript"></script>
<script src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script src="catalog/view/javascript/classifiedjs/common.js" type="text/javascript"></script>
<link href="catalog/view/theme/default/stylesheet/responsive.css" rel="stylesheet" type="text/css"/>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<?php foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>" type="text/javascript"></script>
<?php } ?>
<?php foreach ($analytics as $analytic) { ?>
<?php echo $analytic; ?>
<?php } ?>
<!--share links code start-->
<?php if(!empty($seotitle)) { ?>
<meta property="og:title" content="<?php echo $seotitle; ?>" />

<?php } ?>

<?php if(!empty($seoshare)) { ?>
<meta property="og:url" content="<?php echo $seoshare; ?>" />
<?php } ?>
<?php if(!empty($seodescription)) { ?>
<meta property="og:description" content="<?php echo $seodescription; ?>" />
<?php } ?>
<?php if(!empty($seoimage)) { ?>
<meta property="og:image" content="<?php echo $seoimage; ?>" />
<?php } ?>
<!--share links code end-->
</head>
<body class="<?php echo $class; ?> header3">
  <div class="switch hide">Dark mode:              
        <span class="inner-switch">OFF</span>
    </div>
<!-- header start here-->
<header>
  <div class="container">
    <div class="row">

    <div class="col-md-3 col-sm-3 col-xs-12">
        <div id="logo">
          <?php if ($logo) { ?>
            <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
          <?php } else { ?>
            <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
          <?php } ?>
        </div>
      </div>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <ul class="list-inline icon">
			<li>  <?php echo $currency; ?></li>
			<li>  <?php echo $language; ?></li>
          <?php if ($logged) { ?>
          <li class="logins"><i class="la la-key"></i> <?php echo $text_logged; ?>/<a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
          <?php } else { ?>
          <li class="logins"><a href="<?php echo $login; ?>"><i class="la la-plus-square"></i> <span><?php echo $text_login; ?></span></a></li>
          <li><a href="<?php echo $register; ?>"><i class="la la-key"></i> <span><?php echo $text_register; ?></span></a></li>
          <?php } ?>
          <li>
            <div id="searchtop"><i class="icon_search" aria-hidden="true"></i></div>
				    <div class="serchdown"><?php echo $search; ?></div>
          </li>
          <li>
            <div class="opennav"><i class="fa fa-bars"></i></div>
          </li>
          <li><button class="btn-my" type="button" onclick="location.href='<?php echo $myadss; ?>'"> <i class="la la-edit"></i><span class="hidden-xs"><?php echo $text_myadss; ?></span></button></li>
        </ul>
      </div>
    </div>
  </div>
</header>
<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
	 	<ul class="list-unstyled">
        <li><a href="<?php echo $dashboard; ?>"><?php echo $text_dashboard; ?></a></li>
        <li><a href="<?php echo $mymessages; ?>"><?php echo $text_mymessages; ?></a></li>
		</ul>
</div>
<!-- header end here -->
<script>
function myFunction() {
"use strict";
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
$(document).ready(function () {
	$(".serchdown").hide();
    $("#searchtop").click(function () {
        $(".serchdown").toggle("slow");
	});
});
$('#mySidenav').hide();
    $('.opennav').on('click',function(){
        $('#mySidenav').show();
    });
    $('.closebtn').on('click',function(){
            $('#mySidenav').hide();
        });
</script>
