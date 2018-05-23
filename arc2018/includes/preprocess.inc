<?php

/**
 * @file
 * preprocess.inc
 */

/**
 * Implements hook_preprocess_region().
 * Override or insert variables into the region template.
 *
 * @param $variables
 *
 * @throws \Exception
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
