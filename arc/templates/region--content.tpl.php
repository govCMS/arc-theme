<?php
/**
 * @file
 * Alpha's theme implementation to display a region.
 */
//print_r(get_defined_vars());
?>

<div<?php print $attributes; ?>>
  <div<?php print $content_attributes; ?>>
    <?php if ($is_front): ?>
      <?php print '<h1 class="element-invisible">' . drupal_get_title() . '</h1>'; ?>
    <?php else: ?>
      <?php //print '<h1 class="page-title">' . drupal_get_title() . '</h1>'; ?>
    <?php endif; ?>
    <?php if ($breadcrumb): ?>
      <div id="breadcrumb"><?php print $breadcrumb; ?></div>
    <?php endif; ?>
    <?php if ($messages): ?>
      <div id="messages" class="grid-12"><?php print $messages; ?></div>
    <?php endif; ?>
    <?php if (!empty($tabs) && !$is_front && !empty($tabs['#primary'])): ?>
      <div class="tabbed-nav"><?php print render($tabs); ?></div>
    <?php endif; ?>

    <?php print $content; ?>
    <?php if (!$is_front): ?>
    <div class="content-footer">
       <?php if (isset($node)): ?>
					<p class="modified">Content Last Modified: <?php print date('d/m/y',$node->changed);?></p>
       <?php endif; ?>
					<p class="top"><a href="#top">Back to top</a></p>
		</div>
    <?php endif; ?>
  </div>
</div>
