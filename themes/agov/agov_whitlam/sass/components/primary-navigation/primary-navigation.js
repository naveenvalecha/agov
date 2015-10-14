(function ($) {
  Drupal.behaviors.agov_whitlam_primary_navigation = {
    attach: function (context, settings) {
      $('.primary-navigation', context).once().each(function () {
        var $menu = $(this),
          $title = $menu.find('.primary-navigation__title');
        var toggle = true;
        $title.click(function () {
          if (toggle) {
            $menu.addClass('primary-navigation--expanded');
            $title.text('Close');
            toggle = false;
          }
          else {
            $menu.removeClass('primary-navigation--expanded');
            $title.text('Menu');
            toggle = true;
          }
        });
      });
    }
  };
})(jQuery);
