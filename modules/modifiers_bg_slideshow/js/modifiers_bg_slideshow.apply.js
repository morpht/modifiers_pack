/**
 * @file
 * Initializes modification based on provided configuration.
 */

(function (SlideshowBgModifier) {

  'use strict';

  SlideshowBgModifier.apply = function (selector, media, config) {

    var element = document.querySelector(selector);
    if (!element) {
      return;
    }

    var pluginConfig = {
      slide: config.slides,
      delay: config.delay,
      transition_duration: config.transition_duration,
      transition_timing: config.transition_timing
    };

    easy_background(selector, pluginConfig);

  };

})(window.SlideshowBgModifier = window.SlideshowBgModifier || {});
