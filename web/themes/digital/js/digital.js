(function ($, Drupal) {

  let elem = document.querySelector('.list-item');
  if (elem) {
    new Masonry(elem, {
      itemSelector: '.list-item .col-12',
    });
  }

  Drupal.behaviors.myModuleBehavior = {
    attach: function (context, settings) {
      $('.load-more').click(function (e) {
        e.preventDefault();
        let page = $(this).data('page') ?? 1;
        $.ajax({
          url: '/load-article/ajax',
          method: 'POST',
          data: JSON.stringify({page}),
          success: function (data) {

            // Loop through each command
            $.each(data, function (index, command) {

              switch (command.command) {
                case 'add_js':
                  $.each(command.data, function (index, js) {
                    $('body').append('<script src="' + js.src + '"></script>');
                  });
                  break;
                case 'insert':
                  if (command.selector === '.load-more') {
                    if (command.data === -1) {
                      $(command.selector).hide();
                    } else {
                      $(command.selector).data('page', command.data);
                    }
                  } else {
                    $(command.selector).append(command.data);
                  }
                  break;
                default:
                  console.error('Unsupported command:', command.command);
              }

              const interval = setInterval(() => {
                var elem = document.querySelector('.list-item');
                new Masonry(elem, {
                  itemSelector: '.list-item .col-12',
                });
                clearInterval(interval);
              }, 10)

            });

          }
        });
      });

      $('.toggle-bar').click(function () {
        $('.sidebar-menu').toggleClass('active');
        $('body').toggleClass('overflow-hidden');
      })

      $('.close-menu').click(function () {
        $('.sidebar-menu').toggleClass('active');
        $('body').toggleClass('overflow-hidden');
      })

      $('.sort-by').change(function () {
        let key = '';
        $('.search-input').each(function () {
          if ($(this).val()) {
            key = $(this).val();
          }
        })
        window.location.href = window.location.pathname + '?keyword=' + key + '&sort_by=created&sort_order=' + $(this).val();
      })


    }
  };
})(jQuery, Drupal);
