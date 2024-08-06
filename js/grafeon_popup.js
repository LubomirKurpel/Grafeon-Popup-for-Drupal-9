(function ($, Drupal) {
  Drupal.behaviors.grafeonPopup = {
    attach: function (context, settings) {
      // Retrieve the version from Drupal settings.
      var version = settings.grafeonPopup.version || 'default';
      // Construct the cookie name with the version.
      var cookieName = 'grafeonPopupDismissed_' + version;

      console.log('grafeonPopup behavior attached.');

      // Check if the cookie is already set.
      if (document.cookie.indexOf(cookieName + '=true') === -1) {
        console.log('Popup should be visible because the cookie is not set.');

        // Show the popup.
        $('#grafeon-popup', context).once('grafeon-popup').show();

        // Use .on() to bind click events after ensuring elements are present.
        $('#grafeon-popup .close-popup', context).once('close-popup').on('click', function () {
          console.log('Close button clicked.');

          // Hide the popup.
          $('#grafeon-popup').hide();

          // Retrieve the configured number of days from Drupal settings.
          var days = settings.grafeonPopup.cookieDays || 30;

          // Set a cookie for the configured number of days to remember the dismissal.
          var date = new Date();
          date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
          document.cookie = cookieName + "=true; expires=" + date.toUTCString() + "; path=/";

          console.log('Cookie set: ' + cookieName);
        });
      } else {
        console.log('Cookie already set, popup will not be shown.');
      }
    }
  };
})(jQuery, Drupal);
