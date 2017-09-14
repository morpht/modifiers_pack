/**
 * @file
 * Initializes modification based on provided configuration.
 */

(function (ParallaxBgModifier, $) {

  'use strict';

  ParallaxBgModifier.apply = function (selector, media, config) {

    var pluginConfig = {
      imageSrc: (config.parallax !== undefined ? config.parallax : false),
      speed: (config.speed !== undefined ? config.speed : 0.2),
      zIndex: 0
    };

    $(selector).parallax(pluginConfig);

    var slider = '.parallax-slider[src="' + pluginConfig.imageSrc + '"]';
    var element = document.querySelector(slider);

    toggle(element, media);

    window.addEventListener('resize', function () {
      toggle(element, media);
    });

  };

  function toggle(element, media) {

    if (window.matchMedia(media).matches) {
      element.style.display = '';
    }
    else {
      element.style.display = 'none';
    }

  }

})(window.ParallaxBgModifier = window.ParallaxBgModifier || {}, jQuery);
