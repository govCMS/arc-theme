<?php

/**
 * @file
 * Provides preprocess for arc.
 */

$theme = alpha_get_theme();
$site_name = variable_get('site_name', '');

// Build logo for light style themes.
$colour_scheme = theme_get_setting('colour_scheme');
$colour_toggle = theme_get_setting('colour_toggle');
if (strpos($theme->page['logo'], 'themes/arc/logo.png')) {
  if ($colour_toggle == '0' || $colour_scheme == 'reid') {
    $theme->page['logo'] = drupal_get_path('theme', 'arc') . '/images/logo-alt.png';
  }
}
// Build logo html.
$logo_img = theme('image', array(
  'path' => $theme->page['logo'],
  'alt' => 'Home, ' . check_plain($site_name) . ', Australian Government - logo'
));
$vars['logo'] = l($logo_img, '<front>', array('html' => TRUE));

// Vars for content region.
if ($vars['elements']['#region'] == 'content') {
  $vars['tabs'] = render($theme->page['tabs']);
}

// Adds ARIA roles.
if ($vars['attributes_array']['id'] == 'region-content') {
  $vars['attributes_array']['role'] = 'main';
}

if ($vars['attributes_array']['id'] == 'region-sidebar') {
  $vars['attributes_array']['role'] = 'complementary';
}

if ($vars['attributes_array']['id'] == 'region-header-logo') {
  $vars['attributes_array']['role'] = 'banner';
}

if ($vars['attributes_array']['id'] == 'region-header-main-menu') {
  $vars['attributes_array']['role'] = 'navigation';
}

if ($vars['elements']['#region'] == 'content') {
    $vars['breadcrumb'] = $theme->page['breadcrumb'];
}

if ($vars['elements']['#region'] == 'content') {
    $vars['messages'] = $theme->page['messages'];
}
if(isset($theme->page['node']))
	$vars['node'] = $theme->page['node'];

/*
 * Implement hook_alpha_preprocess_region()
 *
 */
/*
function arc_alpha_preprocess_region(&$vars) {
  $theme = alpha_get_theme();
  if ($vars['elements']['#region'] == 'content') {
    $vars['breadcrumb'] = $theme->page['breadcrumb'];
  }
}
 *
 */


