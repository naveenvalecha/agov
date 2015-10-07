(function ($) {
  Drupal.behaviors.agov_whitlam_primary_navigation = {
    attach: function (context, settings) {
      $('.primary-navigation', context).once().each(function() {
        var $menu = $(this);
        $menu.find('.primary-navigation__title').click(function() {
          $menu.toggleClass('primary-navigation--expanded');
        })
      });
    }
  };
})(jQuery);
