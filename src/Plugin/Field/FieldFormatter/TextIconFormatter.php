<?php

/**
 * @file
 * Contains \Drupal\agov\Plugin\Field\FieldFormatter\TextIconFormatter.
 */

namespace Drupal\agov\Plugin\Field\FieldFormatter;

use Drupal\Component\Utility\SafeMarkup;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\Plugin\Field\FieldFormatter\StringFormatter;
use Drupal\Component\Utility\Html;

/**
 * Plugin implementation of the 'string' formatter.
 *
 * @FieldFormatter(
 *   id = "text_icon",
 *   label = @Translation("Text icon"),
 *   field_types = {
 *     "string",
 *   },
 *   quickedit = {
 *     "editor" = "plain_text"
 *   }
 * )
 */
class TextIconFormatter extends StringFormatter {

  /**
   * {@inheritdoc}
   */
  protected function viewValue(FieldItemInterface $item) {
    // @TODO, replace with FormattableMarkup() in Beta16.
    return [
      '#markup' => SafeMarkup::format('<i class="@icon"></i>', ['@icon' => $item->value]),

    ];
  }

}
