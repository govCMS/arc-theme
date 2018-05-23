/**
 * @file
 * A JavaScript file for the Site.
 */

(function ($, Drupal) {

  'use strict';

  Drupal.behaviors.responsiveSlides = {
    attach: function (context, settings) {
      $(".view-slideshow ul:not(.contextual-links)").responsiveSlides({
        "auto": false,
        "pager": true,         // Boolean: Show pager, true or false
        "pauseButton": false   // Boolean: Create Pause Button
      });
    }
  };

  Drupal.behaviors.arc2018 = {
    attach: function (context, settings) {
      // Site scripts.
    }
  };

})(jQuery, Drupal);
