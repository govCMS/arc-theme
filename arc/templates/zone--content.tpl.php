<?php if ($wrapper): ?><div<?php print $attributes; ?>><?php endif; ?>
  <div<?php print $content_attributes; ?>>
    <div class = "head_title_print">
      <div class="head_title"><?php print '<h1 class="page-title">' . drupal_get_title() . '</h1>'; ?></div>
      <div class="head_print">
        <?php if (!$is_front): ?>
        <?php
          $block = module_invoke('agov_text_resize', 'block_view', 'text_resize');
          print render($block['content']);
        ?>
        <div class="print_link">
        <?php
          $block = module_invoke('print', 'block_view', 'print-links');
          print render($block['content']);
        ?>
        </div>
        <?php endif; ?>
      </div>
      </div>
    <?php //if ($messages): ?>
      <!-- <div id="messages" class="grid-<?php //print $columns; ?>"><?php //print $messages; ?></div> -->
    <?php //endif; ?>
    <?php print $content; ?>
  </div>
<?php if ($wrapper): ?></div><?php endif; ?>