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
  <!-- Include a Sidr bundled CSS theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/jquery.sidr/2.2.1/stylesheets/jquery.sidr.dark.min.css">
  <!-- Include jQuery -->
  <script src="//cdn.jsdelivr.net/jquery/2.2.0/jquery.min.js"></script>
  <!-- Include the Sidr JS -->
  <script src="//cdn.jsdelivr.net/jquery.sidr/2.2.1/jquery.sidr.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#simple-menu').sidr();
    });
  </script>
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
<a id="simple-menu" href="#superfish-1">Toggle menu</a>

<div id="sidr">
  <!-- Your content -->
  <?php
    $block = module_invoke('menu_block', 'block_view', 9);
    print render($block['content']);
  ?>
</div>
<?php print $page; ?>
<?php print $page_bottom; ?>
</body>
</html>
