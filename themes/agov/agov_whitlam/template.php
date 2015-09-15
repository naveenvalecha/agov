<?php

/**
 * Implements hook_preprocess_html().
 */
function agov_whitlam_preprocess_html(&$variables, $hook) {
  // Add google fonts.
  drupal_add_html_head_link(array(
    "href" => "//fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700",
    "rel" => "stylesheet",
    "type" => "text/css",
  ));
}

/**
 * Override or insert variables into the node templates.
 *
 * @param array $variables
 *   Variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("node" in this case.)
 */
function agov_whitlam_preprocess_node(&$variables, $hook) {
  $node = $variables['node'];
  $variables['date'] = format_date($node->created, 'custom', 'j M Y');
  $variables['submitted'] = t('By !username on !datetime', array('!username' => $variables['name'], '!datetime' => $variables['date']));

  // Optionally, run node-type-specific preprocess functions, like
  // agov_whitlam_preprocess_node_page() or
  // agov_whitlam_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }

  if ($variables['type'] == 'footer_teaser' &&  $variables['teaser'] == TRUE) {
    $field_reference_path = $variables['field_reference'][0]['entity']->path['alias'];

    if (isset($field_reference_path)) {
      $variables['node_url'] = check_url($field_reference_path);
      unset($variables['content']['field_reference']);
    }
  }
}

/**
 * Override or insert variables into the comment templates.
 *
 * @param array $variables
 *   Variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
function agov_whitlam_preprocess_comment(&$variables, $hook) {
  $comment = $variables['comment'];
  $variables['submitted'] = t('<span class="field author">!username</span> - <span class="field date-month">!date</span>',
    array(
      '!username' => $variables['author'],
      '!date' => format_date($comment->created, 'custom', 'l d M, Y'),
    ));
  if (variable_get('comment_subject_field_' . $variables['node']->type, 1) == 0) {
    $variables['title'] = '';
  }
}

/**
 * Implements hook_preprocess_comment_wrapper().
 */
function agov_whitlam_preprocess_comment_wrapper(&$variables, $hook) {
  if ($variables['node']->comment_count) {
    $variables['total_comments_in_node'] = $variables['node']->comment_count;
  }
  else {
    $variables['total_comments_in_node'] = 0;
  }
}

/**
 * Override or insert variables into the block templates.
 *
 * @param array $variables
 *   Variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("block" in this case.)
 */
function agov_whitlam_preprocess_block(&$variables, $hook) {
  $block = $variables['elements']['#block'];

  // Add a border to all the blocks in the sidebar_second region.
  if ($block->region === 'sidebar_second') {
    $variables['classes_array'][] = 'divider';
  }

  if ($block->delta === 'menu-quick-links') {
    $variables['classes_array'][] = 'nav-menu__wrapper';
  }
}

/**
 * Override variables into the icon_block bean templates.
 *
 * @param array $variables
 *   Variables to pass to the theme template.
 */
function agov_whitlam_preprocess_entity(&$variables) {
  $entity_type = $variables['elements']['#entity_type'];
  $entity = $variables['elements']['#entity'];

  if ($entity_type == 'bean' && $entity->type == 'icon_block') {
    $icon = field_get_items($entity_type, $entity, 'field_icon');
    $variables['box_icon'] = isset($icon[0]['value']) ? $icon[0]['value'] : NULL;

    $link_to = field_get_items($entity_type, $entity, 'field_link_to');
    if (isset($link_to[0]['url'])) {
      $variables['box_link_to'] = array(
        '#type' => 'link',
        '#href' => $link_to[0]['url'],
        '#title' => isset($link_to[0]['title']) ? $link_to[0]['title'] : $link_to[0]['url'],
      );
    }
    else {
      $variables['box_link_to'] = NULL;
    }

    $text = field_get_items($entity_type, $entity, 'field_bean_text');
    $variables['box_text'] = isset($text[0]['value']) ? $text[0]['value'] : NULL;

    // Create a custom theme hook suggestion for beans on the front page.
    if ($variables['is_front'] == TRUE) {
      $variables['theme_hook_suggestions'][] = 'bean__icon_block__front';
    }
  }
}

/**
 * Implements hook_form_alter().
 */
function agov_whitlam_form_alter(&$form, &$form_state, $form_id) {
  if ($form_id == 'search_api_page_search_form') {
    $form['form']['keys_1']['#placeholder'] = t('Enter your keywords');
    $form['#prefix'] = '<div class="search__wrapper">';
    $form['#suffix'] = '</div>';
    unset($form['form']['keys_1']['#title']);
  }
}
