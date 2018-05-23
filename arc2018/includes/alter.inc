<?php

/**
 * @file
 * alter.inc
 */

/**
 * Implements hook_form_FORM_ID_alter().
 */
function arc2018_form_search_api_page_search_form_default_search_alter(&$form, &$form_state, $form_id) {
  $form['#attributes']['class'][] = 'container-inline';
}
