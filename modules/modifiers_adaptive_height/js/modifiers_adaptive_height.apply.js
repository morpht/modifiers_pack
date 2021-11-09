/**
 * @file
 * Initializes modification based on provided configuration.
 */

(function (AdaptiveHeightModifier) {

  'use strict';

  AdaptiveHeightModifier.apply = function (context, selector, media, config) {

    var element = context.querySelector(selector);
    if (!element) {
      return;
    }

    setHeight(element, media, config.ratio, config.limit, config.comparison);

    window.addEventListener('resize', function () {
      setHeight(element, media, config.ratio, config.limit, config.comparison);
    });

  };

  function setHeight(element, media, ratio, limit, comparison) {

    if (window.matchMedia(media).matches) {

      if (comparison === 'screen_height') {
        if (window.innerHeight > limit) {
          element.style.minHeight = (limit * parseFloat(ratio)) + 'px';
        }
        else {
          element.style.minHeight = (window.innerHeight * parseFloat(ratio)) + 'px';
        }
      }
      else {
        if (element.offsetWidth > limit) {
          element.style.minHeight = (limit * parseFloat(ratio)) + 'px';
        }
        else {
          element.style.minHeight = (element.offsetWidth * parseFloat(ratio)) + 'px';
        }
      }
    }
    else {
      element.style.minHeight = '';
    }

  }

})(window.AdaptiveHeightModifier = window.AdaptiveHeightModifier || {});
