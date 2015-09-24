<?php

/**
 * @file
 * aGov profile global changes.
 */

use Drupal\Core\Form\FormStateInterface;

/**
 * Implements hook_form_FORM_ID_alter().
 */
function agov_form_contact_message_contact_form_alter(&$form, FormStateInterface $form_state) {
  $form['actions']['preview']['#access'] = FALSE;
}
