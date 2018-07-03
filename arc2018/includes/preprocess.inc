<?php

/**
 * @file
 * preprocess.inc
 */

/**
 * Implements hook_preprocess_html().
 */
function arc2018_preprocess_html(&$variables) {
  // Set common variables.
  $variables['base_path'] = base_path();
  $variables['path_to_arc'] = drupal_get_path('theme', 'arc2018');
}

/**
 * Implements hook_preprocess_region().
 */
function arc2018_preprocess_region(&$variables) {
  // Get theme settings.
  $theme = alpha_get_theme();
  // Get site name.
  $site_name = variable_get('site_name', '');
  // Set site logo.
  $theme->page['logo'] = drupal_get_path('theme', 'arc2018') . '/img/logo.svg';
  // Build logo html.
  $logo_img = theme('image', [
    'path' => $theme->page['logo'],
    'alt' => 'Home, ' . check_plain($site_name) . ', Australian Government - logo',
  ]);
  // Set logo variable.
  $variables['logo'] = l($logo_img, '<front>', ['html' => TRUE]);
}

/**
 * Implements hook_preprocess_node().
 */
function arc2018_preprocess_node(&$variables) {

  // Slides get a special read more link.
  if ($variables['type'] == 'slide') {
    if (!empty($variables['field_read_more'][0]['url'])) {
      $variables['title_link'] = l($variables['title'], $variables['field_read_more'][0]['url']);
    }
    else {
      $variables['title_link'] = check_plain($variables['title']);
    }
  }
}

/**
 * Implements hook_preprocess_search_api_page_result()
 */
function arc2018_preprocess_search_api_page_result(&$variables) {
  $item = $variables['item'];

  $info = [];
  if (!empty($item->created)) {
    $info['date'] = format_date($item->created, 'govcms_month_day_year');
  }
  // Provide separated and grouped meta information.
  $variables['info_split'] = $info;
  $variables['info'] = implode(' - ', $info);
}
