<?php
/**
 * @file
 * Template for article search results.
 */
?>

<div class="teaser clearfix">
  <h3 class="teaser__title"><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h3>
  <div class="teaser__content">
    <?php print drupal_render($content) ?>
  </div>
</div>
