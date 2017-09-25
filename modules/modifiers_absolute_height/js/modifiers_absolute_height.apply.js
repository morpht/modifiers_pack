/**
 * @file
 * Initializes modification based on provided configuration.
 */

(function (AbsoluteHeightModifier) {

  'use strict';

  AbsoluteHeightModifier.apply = function (selector, media, config) {

    var element = document.querySelector(selector);
    if (!element) {
      return;
    }

    setHeight(element, media, config.height);

    window.addEventListener('resize', function () {
      setHeight(element, media, config.height);
    });

  };

  function setHeight(element, media, height) {

    if (window.matchMedia(media).matches) {
      element.style.height = (window.innerHeight * parseFloat(height) / 100) + 'px';
    }
    else {
      element.style.height = '';
    }

  }

})(window.AbsoluteHeightModifier = window.AbsoluteHeightModifier || {});
