$(document).ready(function () {
  $('select.select2').select2();
  $("select.select2tags").select2({
    tags: true,
    tokenSeparators: [',', ' ']
  })


  // Show/Hide Scroll to Top Button
  $(document).on('scroll', function () {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });


  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function (e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });

  // Scroll to Top Button Action
  $(document).on('click', 'a.scroll-to-top-responsive', function (e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });


  // Image inject svg
  $('.image-svg').svgInject();

  // $('input').iCheck({
  //   checkboxClass: 'icheckbox_square-blue',
  //   radioClass: 'iradio_square-blue',
  //   increaseArea: '20%' // optional
  // });


  // Checkout loading state in button
  // $('#payOrderButton').on('click', function (ev) {
  // console.log(ev);
  // $(this).text('Pagando...').prop('disabled', true)
  // $('#payOrderAddCardButton').prop('disabled', true)
  // $('#payOrderForm').submit();
  // return true
  // });


  // Make sidebar small button
  // $(".btn-menu-responsive").click(function () {

  //   $("#accordionSidebar").css("display", "block");
  //   $(".btn-menu-responsive-close").css("display", "block");
  //   $("#overlay-blue").css("display", "block");
  //   $(".btn-menu-responsive").css("display", "none");
  //   $(".cont-menu-responsive").css("background", "none");


  //   // Quitar scroll del body
  //   $('body').addClass("lock-scroll");


  // });



  // Set sidebar links active state
  var current = window.location.href.split('?')[0];

  // Parent level
  $('.sidebar li.nav-item a').each(function () {
    var $this = $(this);
    // if the current path is like this link, make it active
    if ($this.attr('href').search(current) !== -1) {
      $this.parent().addClass('active');
    }
  })

  // Children level
  $('.sidebar a.nav-item').each(function () {
    var $this = $(this);
    // if the current path is like this link, make it active
    if ($this.attr('href').search(current) !== -1) {
      $this.addClass('active');
      // console.log('collapsed parents', $this.closest('.collapsed'), $this.closest('.collapse'));
      $this.closest('.collapsed').removeClass('collapsed');
      $this.closest('.collapse').addClass('show');
    }

  })



  // $('.btn-menu-responsive-close').on('click', function () {

  //   $('body').removeClass("lock-scroll");
  //   open = false;
  //   $("#accordionSidebar").css("display", "none");
  //   $(".btn-menu-responsive-close").css("display", "none");
  //   $("#overlay-blue").css("display", "none");
  //   $(".btn-menu-responsive").css("display", "block");
  //   $(".cont-menu-responsive").css("background", "url('/images/fnd_menu_responsive.png') no-repeat top center");

  // });



  // Load swiper in tab show event to prevent bug
  $('.nav-tabs').find('a').on('shown.bs.tab', function () {
    // Some code you want to run after the tab is shown (callback)
    var swipers = $('.tab-pane').find('.swiper-container')
    if (swipers.length) swipers[0].swiper.update()
  });





  // SB Admin JS Code


  // sidebarToggle
  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on('click', function (e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    $(".sidebar-false").toggleClass("toggle-content");
    $("#cont-menu-sidebar").toggleClass("mh-100");
    $(".nav-text-span-collased__d-none").toggleClass('d-none');
    $(".icon-toggle__scale").toggleClass("icon-toggle__scale_up");
    $(".style-subitem-on-collapse").toggleClass("style-subitem-on-collapse__active");
    $(".logo-no-collapse").toggleClass("d-none");
    $(".logo-collapse").toggleClass("d-none");



    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    };
  });


  // // Close any open menu accordions when window is resized below 768px
  // $(window).resize(function() {
  //   if ($(window).width() < 768) {
  //     $('.sidebar .collapse').collapse('hide');
  //   };
  // });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function (e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });


});





// Helper used in Dashboards
function dataURLToBlob(dataURL) {
  var BASE64_MARKER = ';base64,';
  if (dataURL.indexOf(BASE64_MARKER) == -1) {
    var parts = dataURL.split(',');
    var contentType = parts[0].split(':')[1];
    var raw = parts[1];

    return new Blob([raw], {
      type: contentType
    });
  } else {
    var parts = dataURL.split(BASE64_MARKER);
    var contentType = parts[0].split(':')[1];
    var raw = window.atob(parts[1]);
    var rawLength = raw.length;

    var uInt8Array = new Uint8Array(rawLength);

    for (var i = 0; i < rawLength; ++i) {
      uInt8Array[i] = raw.charCodeAt(i);
    }

    return new Blob([uInt8Array], {
      type: contentType
    });
  }
}


// Dashboard upload graph as image
async function uploadGraphAsImage(chart, fileName) {
  var image = chart.toBase64Image()
  var formData = new FormData();
  var blob = dataURLToBlob(image, 'image/png');

  formData.set('file', blob)
  formData.set('name', fileName)

  return axios.post('/api/dashboard/images/store', formData, {
    headers: {
      'Accept': 'application/json',
      'Content-Type': `multipart/form-data`,
    }
  })
}






// // Detects if device is on iOS
// var isIos = () => {
//   var userAgent = window.navigator.userAgent.toLowerCase();
//   return /iphone|ipad|ipod/.test(userAgent);
// }
// // Detects if device is in standalone mode
// var isInStandaloneMode = () => ('standalone' in window.navigator) && (window.navigator.standalone);

// // Checks if should display install popup notification:
// if (isIos() && !isInStandaloneMode()) {
//   alert('Para agregar al escritorio, pulsa en el botón de "compartir" y selecciona la opción "Add to homescreen"');
// }
