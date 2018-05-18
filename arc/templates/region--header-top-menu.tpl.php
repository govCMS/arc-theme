<?php

/**
 * @file
 * Header menu template.
 */
?>

<div<?php print $attributes; ?>>
  <div<?php print $content_attributes; ?>>
    <!-- We donot need to show this area-->
    <!--
    <ul id="skip-to-content" class="menu">
      <li>
        <a href="#region-content">
          <?php //print t('Skip to content'); ?>
        </a>
      </li>
    </ul>
    -->
    <?php print $content; ?>
  </div>
</div>
