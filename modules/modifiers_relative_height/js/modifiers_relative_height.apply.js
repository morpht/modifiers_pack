/**
 * @file
 * Initializes modification based on provided configuration.
 */

(function (RelativeHeightModifier) {

  'use strict';

  RelativeHeightModifier.apply = function (selector, config) {

    var element = document.querySelector(selector);

    setHeight(element, config.media, config.ratio);

    window.addEventListener('resize', function () {
      setHeight(element, config.media, config.ratio);
    });

  };

  function setHeight(element, media, ratio) {

    if (window.matchMedia(media).matches) {

      if (ratio.indexOf('%') !== -1) {
        element.style.height = (window.innerHeight * parseFloat(ratio) / 100) + 'px';
      }
      else {
        element.style.height = (element.offsetWidth / parseFloat(ratio)) + 'px';
      }
    }
    else {
      element.style.height = '';
    }

  }

})(window.RelativeHeightModifier = window.RelativeHeightModifier || {});
