<?php
/**
 * @file
 * Template for article teasers.
 */
?>


  <div class="teaser">
  <?php if (!empty($content['field_image'])): ?>
  <div class="teaser--image">
    <a href="<?php print $node_url; ?>"><?php print drupal_render($content['field_image']) ?></a>
  </div>
  <?php endif; ?>
  <h3 class="teaser__title"><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h3>
  <div class="teaser__content">
    <?php print drupal_render($content['field_description']) ?>
  </div>
 </div>
