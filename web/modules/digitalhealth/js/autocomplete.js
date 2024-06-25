(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.autocompleteBehavior = {
    attach: function (context, settings) {
      $('#autocomplete-input', context).on('autocompleteBehavior').each(function () {
        $(this).autocomplete({
          source: function (request, response) {
            $.ajax({
              url: Drupal.url('autocomplete/suggestions'),
              dataType: 'json',
              data: {
                q: request.term
              },
              success: function (data) {
                response(data);
              }
            });
          },
          minLength: 2,
          select: function (event, ui) {
            if (ui.item && ui.item.url) {
              window.location.href = ui.item.url;
            }
          },
          open: function() {
            $(this).autocomplete('widget').css('width', $(this).outerWidth());
          }
        });
      });

      $('#search_image, #search_image_2').click(function() {
        $(this).closest('form').submit();
      });
    }
  };
})(jQuery, Drupal, drupalSettings);
