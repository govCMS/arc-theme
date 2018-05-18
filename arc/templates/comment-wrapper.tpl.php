<?php
/**
 * @file
 * Bartik's theme implementation to provide an HTML container for comments.
 *
 * Available variables:
 * - $content: The array of content-related elements for the node. Use
 *   render($content) to print them all, or
 *   print a subset such as render($content['comment_form']).
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default value has the following:
 *   - comment-wrapper: The current template type, i.e., "theming hook".
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * The following variables are provided for contextual information.
 * - $node: Node object the comments are attached to.
 * The constants below the variables show the possible values and should be
 * used for comparison.
 * - $display_mode
 *   - COMMENT_MODE_FLAT
 *   - COMMENT_MODE_THREADED
 *
 * Other variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess_comment_wrapper()
 * @see theme_comment_wrapper()
 */
?>
<?php
  global $base_url;
?>
<div id="comments"<?php print $attributes; ?>>
  <?php if ($content['comments'] && $node->type != 'forum'): ?>
		<div id="comment-wrapper-header" class="clearfix">
    	<?php print render($title_prefix); ?>
    	<h2 class="title"><?php print t('Comments (!count)', array('!count' => $node->comment_count)); ?></h2>
    	<?php print render($title_suffix); ?>
			<div class="add-new-link">
				<?php if (user_is_logged_in()) : ?>
					<a href="#add-new-comment"><?php print t('Add a comment'); ?></a>
				<?php else : ?>
					
					<p><a href="<?php print $base_url . '?q=user'; ?>">Log in</a> or <a href="<?php print $base_url . '?q=user/register'; ?>">register</a> to post comments</p>
				<?php endif; ?>	
			</div>
		</div> <!-- #comment-wrapper-header -->
  <?php endif; ?>

  <?php print render($content['comments']); ?>

  <?php if ($content['comment_form']): ?>
		<div id="add-new-comment">
    	<h2 class="title comment-form"><?php print t('Add new comment'); ?></h2>
    	<?php print render($content['comment_form']); ?>
		</div> <!-- #add-new-comment -->
  <?php endif; ?>
</div>
