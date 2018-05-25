<?php

/**
 * @file
 * Theme implementation to display a slide node.
 */
?>
<div id="node-<?php print $node->nid; ?>"<?php print $attributes; ?>>
  <h2 class="node__title node-title slide__title"><?php print $title_link; ?></h2>

  <div class="content"<?php print $content_attributes; ?>>
    <?php
    hide($content['links']);
    print render($content);
    ?>
  </div>

  <?php print render($content['links']); ?>
</div>
