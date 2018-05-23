<?php

/**
 * @file
 * template.php
 */

// Auto-rebuild the theme registry during theme development.
if (theme_get_setting('arc_rebuild_registry') && !defined('MAINTENANCE_MODE')) {
  // Rebuild .info data.
  system_rebuild_theme_data();
  // Rebuild theme registry.
  drupal_theme_rebuild();
}

/**
 * Implements HOOK_theme().
 */
function arc2018_theme(&$existing, $type, $theme, $path) {
  include_once './' . drupal_get_path('theme', 'arc2018') . '/includes/registry.inc';

  return _arc_theme($existing, $type, $theme, $path);
}

/**
 * Clear any previously set element_info() static cache.
 *
 * If element_info() was invoked before the theme was fully initialized, this
 * can cause the theme's alter hook to not be invoked.
 *
 * @see https://www.drupal.org/node/2351731
 */
drupal_static_reset('element_info');

/**
 * Include hook_preprocess_*() hooks.
 */
include_once './' . drupal_get_path('theme', 'arc2018') . '/includes/preprocess.inc';
