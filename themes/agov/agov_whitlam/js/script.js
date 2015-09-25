/**
 * @file
 * A JavaScript file for the theme.
 */

(function ($, Drupal, window, document) {

  'use strict';

  Drupal.behaviors.agov_whitlam_menu = {
    attach: function (context, settings) {

      // Create an icon for toggling the menu.
      var $navigation = $('.navigation');
      var $open_icon = $('<div/>')
            .addClass('menu-icon')
            .addClass('open')
            .addClass('active')
            .html('menu<i class="fa fa fa-bars"></i>')
            .prependTo($navigation);
      var $close_icon = $open_icon.clone();

      $close_icon
          .html('close<i class="fa fa fa-close"></i>')
          .removeClass('active')
          .prependTo($navigation);

      // Find the open icon, hide it and show the close icon.
      $open_icon.click(function () {
        $open_icon.removeClass('active');
        $close_icon.addClass('active');
        $navigation.find('ul').addClass('active');
      });

      // Find the close icon, hide it and show the open icon.
      $close_icon.click(function () {
        $close_icon.removeClass('active');
        $open_icon.addClass('active');
        $navigation.find('ul').removeClass('active');
      });
    }
  };

})(jQuery, Drupal, this, this.document);
