$(document).ready(function () {

  var slider = new Swiper('.swiper-slider', {
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    }
  });

  var slider = new Swiper('.swiper-banner', {
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    },
  });

  var slider = new Swiper('#testimonial-slider', {
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    },
    slidesPerView: 2,
    breakpoints: {
      960: {
        slidesPerView: 1,
        spaceBetween: 0,
      }
    }
  });

  var slider = new Swiper('.swiper-slider-3', {
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    slidesPerView: 4,
    breakpoints: {
      1200: {
        slidesPerView: 4,
        spaceBetween: 10,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 7,
      },
      850: {
        slidesPerView: 2,
        spaceBetween: 5,
      },
      640: {
        slidesPerView: 1,
        spaceBetween: 0,
      }
    }
  });


  var slider = new Swiper('.swiper-slider-5', {
    navigation: {
      nextEl: '.swiper-btn-outside-outfit-next',
      prevEl: '.swiper-btn-outside-outfit-prev',
    },
    slidesPerView: 4,
    breakpoints: {
      1200: {
        slidesPerView: 4,
        spaceBetween: 10,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 10,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 5,
      },
      640: {
        slidesPerView: 1,
        spaceBetween: 0,
      },

    }
  });

  var slider = new Swiper('.swiper-slider-9', {
    navigation: {
      nextEl: '.swiper-btn-outside-subcategories-next',
      prevEl: '.swiper-btn-outside-subcategories-prev',
    },
    slidesPerView: 7,
    centerInsufficientSlides: true,
    breakpoints: {
      1024: {
        slidesPerView: 6,
        spaceBetween: 0,
      },
      768: {
        slidesPerView: 4,
        spaceBetween: 0,
      },
      640: {
        slidesPerView: 3,
        spaceBetween: 0,
      },
    }
  });


  var slider = new Swiper('.swiper-stories', {
    navigation: {
      nextEl: '.swiper-btn-stories-next',
      prevEl: '.swiper-btn-stories-prev',
    },
    slidesPerView: 7.5,
    breakpoints: {
      1200: {
        slidesPerView: 6.5,
        spaceBetween: 8,
      },
      1024: {
        slidesPerView: 5.5,
        spaceBetween: 6,
      },
      768: {
        slidesPerView: 4.5,
        spaceBetween: 4,
      },
      640: {
        navigation: null,
        slidesPerView: 2.5,
        spaceBetween: 1,
      },
      320: {
        navigation: null,
        slidesPerView: 1.5,
        spaceBetween: 0,
      }
    }
  });



})


var slider = new Swiper('.promo-sliders', {
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  pagination: {
    el: '.swiper-pagination',
    type: 'bullets',
    clickable: true
  },
});
