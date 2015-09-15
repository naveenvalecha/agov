<?php
/**
 * @file
 * Returns the HTML for a wrapping container around comments.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728230
 */

// Render the comments and form first to see if we need headings.
$comments = render($content['comments']);
$comment_form = render($content['comment_form']);
?>
<section
  class="comment__section <?php print $classes; ?>"<?php print $attributes; ?>
  id="comments">
  <?php print render($title_prefix); ?>
  <?php if ($comments && $node->type != 'forum'): ?>
    <?php if ($total_comments_in_node == 1): ?>
      <h2 class="comment__section-title"><?php print t('!comments Comment', array('!comments' => $total_comments_in_node)); ?></h2>
    <?php else: ?>
      <h2 class="comment__section-title"><?php print t('!comments Comments', array('!comments' => $total_comments_in_node)); ?></h2>
    <?php endif; ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php print $comments; ?>

  <?php if ($comment_form): ?>
    <h2 class="comment__form-title"><?php print t('Add new comment'); ?></h2>
    <?php print $comment_form; ?>
  <?php endif; ?>
</section>
