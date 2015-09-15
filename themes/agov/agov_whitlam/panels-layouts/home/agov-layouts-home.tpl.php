<?php
/**
 * @file
 * Provides themed representation of the home layout.
 * @copyright Copyright(c) 2012 Previous Next Pty Ltd
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 *
 * Available variables
 * -------------------
 * $content array of panels.
 */

?>

<div class="layout-3col" <?php if (!empty($css_id)) : print "id=\"$css_id\""; endif; ?>>

  <?php if ($content['header']): ?>
    <div class="layout-3col__full region-featured-top">
      <?php print $content['header'];?>
    </div>
  <?php endif; ?>

  <?php if ($content['promo-1'] || $content['promo-2'] || $content['promo-3']): ?>
    <div class="layout-3col__full">
      <hr>
     <div class="layout-3col">

        <?php if ($content['promo-1']): ?>
          <div class="layout-3col__col-1">
            <?php print $content['promo-1'];?>
          </div>
        <?php endif; ?>

        <?php if ($content['promo-2']) : ?>
          <div class="layout-3col__col-2">
            <?php print $content['promo-2'];?>
          </div>
        <?php endif; ?>

        <?php if ($content['promo-3']): ?>
          <div class="layout-3col__col-3">
            <?php print $content['promo-3'];?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  <?php endif; ?>



  <?php if ($content['main'] || $content['right-sidebar']): ?>
    <div class="layout-3col__left-content">
      <hr>
      <?php print $content['main'];?>
    </div>
  <?php endif; ?>

  <?php if ($content['right-sidebar']): ?>
    <div class="layout-3col__right-sidebar">
      <hr>
      <?php print $content['right-sidebar'];?>
    </div>
  <?php endif; ?>

  <?php if ($content['footer-1'] || $content['footer-2'] || $content['footer-3']): ?>
    <div class="layout-3col__full">
      <hr>
      <div class="layout-3col">

        <?php if ($content['footer-1']): ?>
          <div class="layout-3col__col-1">
            <?php print $content['footer-1'];?>
          </div>
        <?php endif; ?>

        <?php if ($content['footer-2']) : ?>
          <div class="layout-3col__col-2">
            <?php print $content['footer-2'];?>
          </div>
        <?php endif; ?>

        <?php if ($content['footer-3']): ?>
          <div class="layout-3col__col-3">
            <?php print $content['footer-3'];?>
          </div>
        <?php endif; ?>

      </div>
    </div>
  <?php endif; ?>

</div>
