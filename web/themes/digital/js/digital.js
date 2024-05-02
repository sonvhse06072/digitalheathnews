// // var elem = $('.views-infinite-scroll-content-wrapper');
// // var msnry = new Masonry( elem, {
// //   // options
// //   itemSelector: '.item-list',
// //   columnWidth: 200,
// //   percentPosition: true
// // });
//
// $('body');
//
//
// (function ($) {
//
//   $('.views-infinite-scroll-content-wrapper').masonry({
//     // options
//     itemSelector: '.item-list',
//     columnWidth: 200
//   });
//
// });

(function ($) {
  $('.toggle-bar').click(function (){
    $('.sidebar-menu').toggleClass('active');
    $('body').toggleClass('overflow-hidden');
  })

  $('.close-menu').click(function (){
    $('.sidebar-menu').toggleClass('active');
    $('body').toggleClass('overflow-hidden');
  })



  // Drupal.behaviors.myModuleBehavior = {
  //   attach: function (context, settings) {
  //     var elem = document.querySelector('.views-infinite-scroll-content-wrapper');
  //
  //     // var elem = $('.views-infinite-scroll-content-wrapper');
  //     // var msnry = new Masonry(elem, {
  //     //   // options
  //     //   itemSelector: '.views-view-responsive-grid',
  //     //   columnWidth: 200,
  //     //   percentPosition: true
  //     // });
  //
  //     $('.toggle-bar').click(function (){
  //       console.log('abc');
  //     })
  //
  //   }
  // };
})(jQuery);
