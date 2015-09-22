<?php
/**
 * @file
 * Template for article compact teasers.
 */
?>

<div class="teaser clearfix">
  <?php if (!empty($content['field_thumbnail'][0])): ?>
    <div class="teaser__image teaser__image-wide">
      <?php print drupal_render($content['field_thumbnail'][0]) ?>
    </div>
  <?php endif; ?>
  <h3 class="teaser__title"><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h3>
  <span class="teaser__submitted"><?php print $submitted; ?></span>
  <div class="teaser__content">
    <?php hide($content['field_thumbnail']); ?>
    <?php hide($content['links']); ?>
    <?php print drupal_render($content) ?>
    <?php print drupal_render($content['links']) ?>
  </div>
</div>
