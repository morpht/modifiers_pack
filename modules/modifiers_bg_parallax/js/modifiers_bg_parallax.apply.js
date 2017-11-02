/**
 * @file
 * Initializes modification based on provided configuration.
 */

(function (ParallaxBgModifier, $) {

  'use strict';

  ParallaxBgModifier.apply = function (selector, media, config) {

    var element = document.querySelector(selector);
    if (!element) {
      return;
    }

    var pluginConfig = {
      imageSrc: (typeof config.parallax !== 'undefined' ? config.parallax : false),
      speed: (typeof config.speed !== 'undefined' ? config.speed : 0.2),
      zIndex: 0
    };

    $(selector).parallax(pluginConfig);

    var slider = '.parallax-slider[src="' + pluginConfig.imageSrc + '"]';
    slider = document.querySelector(slider);
    if (slider) {

      toggleDesktop(slider, media);

      window.addEventListener('resize', function () {
        toggleDesktop(slider, media);
      });
    }
    else {

      var image = element.style.backgroundImage;
      if (!image) {
        return;
      }

      toggleMobile(element, media, image);

      window.addEventListener('resize', function () {
        toggleMobile(element, media, image);
      });
    }

  };

  function toggleDesktop(element, media) {

    if (window.matchMedia(media).matches) {
      element.style.display = '';
    }
    else {
      element.style.display = 'none';
    }

  }

  function toggleMobile(element, media, image) {

    if (window.matchMedia(media).matches) {
      element.style.backgroundImage = image;
    }
    else {
      element.style.backgroundImage = '';
    }

  }

})(window.ParallaxBgModifier = window.ParallaxBgModifier || {}, jQuery);
