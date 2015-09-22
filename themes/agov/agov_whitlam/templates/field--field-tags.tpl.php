<?php
/**
 * @file
 * Returns the HTML for field.
 */
?>
<div class="tags">
  <?php if (!$label_hidden): ?>
    <span class="tags__label"<?php print $title_attributes; ?>><strong><?php print $label ?></strong>:&nbsp;</span>
  <?php endif; ?>
  <ul class="tags__items"<?php print $content_attributes; ?>>
    <?php foreach ($items as $delta => $item): ?>
      <li class="tags__item <?php print $delta % 2 ? 'odd' : 'even'; ?>"<?php print $item_attributes[$delta]; ?>><?php print render($item); ?></li>
    <?php endforeach; ?>
  </ul>
</div>
