/**
 * @file
 * Initializes modification based on provided configuration.
 */

(function (ParallaxBgModifier) {

  'use strict';

  ParallaxBgModifier.apply = function (selector, media, config) {

    var element = document.querySelector(selector);
    if (!element) {
      return;
    }

    jarallax(document.querySelectorAll(selector), {
      speed: (typeof config.speed !== 'undefined' ? config.speed : 0.5)
    });

  };

})(window.ParallaxBgModifier = window.ParallaxBgModifier || {});
