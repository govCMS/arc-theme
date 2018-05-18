<?php
/**
 * @file
 * Page layout template.
 */
?>
<!DOCTYPE html>
<!--[if IEMobile 7]>
<html class="iem7" <?php print $html_attributes; ?>><![endif]-->
<!--[if lte IE 6]>
<html class="lt-ie9 lt-ie8 lt-ie7" <?php print $html_attributes; ?>><![endif]-->
<!--[if (IE 7)&(!IEMobile)]>
<html class="lt-ie9 lt-ie8" <?php print $html_attributes; ?>><![endif]-->
<!--[if IE 8]>
<html class="lt-ie9" <?php print $html_attributes; ?>><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)]><!-->
<html <?php print $html_attributes . $rdf_namespaces; ?>><!--<![endif]-->
<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <?php print $scripts; ?>
  <!--[if lt IE 9]>
  <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <!--[if IE]>
  <link rel="stylesheet" href="/profiles/agov/themes/arc/css/ie.css" type="text/css" media="screen"/>
  <![endif]-->
  <!--[if lte IE 8]>
  <link type="text/css" rel="stylesheet" media="all" href="/profiles/agov/themes/arc/css/ie8-and-below.css"/>
  <![endif]-->
</head>
<body<?php print $attributes; ?>>
<!-- temporary notice -->
<?php /*
<div class="notice-arc" style="position:absolute; top:500px; height:150px; line-height:150px; font-weight:bold; background:red; color:white; font-family:Arial; width:100%; z-index:9999; text-align:center;">
<p style="font-size:16px;">Migration in progress. Do not make any content update to this website. It will be lost!</p>
</div>
*/?>
<?php print $page_top; ?>
<?php print $page; ?>
<?php print $page_bottom; ?>
</body>
</html>

