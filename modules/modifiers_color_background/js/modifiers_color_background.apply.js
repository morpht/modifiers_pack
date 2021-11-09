/**
 * @file
 * Initializes modification based on provided configuration.
 */

(function (ColorBackgroundModifier) {

  'use strict';

  ColorBackgroundModifier.count = 0;

  ColorBackgroundModifier.apply = function (context, selector, media, config) {

    var element = context.querySelector(selector);
    if (!element) {
      return;
    }
    var count = ColorBackgroundModifier.count++;

    toggle(element, media, config, count);

    window.addEventListener('resize', function () {
      toggle(element, media, config, count);
    });

  };

  function toggle(element, media, config, count) {

    // Remove specific wrapper by counter, if exists.
    var query = '.color-background-wrap[data-count="' + count + '"]';
    var existing = element.querySelector(query);
    if (existing) {
      existing.remove();
    }

    if (window.matchMedia(media).matches) {

      // Create a div as the background wrapper.
      var wrap = document.createElement('div');
      wrap.setAttribute('class', 'color-background-wrap');
      wrap.setAttribute('data-count', count);

      // Stretch the wrapper across whole parent element.
      wrap.style.display = 'block';
      wrap.style.position = 'absolute';
      wrap.style.top = '0px';
      wrap.style.right = '0px';
      wrap.style.bottom = '0px';
      wrap.style.left = '0px';
      wrap.style.zIndex = '1';

      // Set background properties.
      if (typeof config.color !== 'undefined') {
        wrap.style.backgroundColor = config.color;
      }
      if (typeof config.hover !== 'undefined') {
        var color = wrap.style.backgroundColor;
        element.addEventListener('mouseover', function () {
          wrap.style.backgroundColor = config.hover;
        });
        element.addEventListener('mouseout', function () {
          wrap.style.backgroundColor = color;
        });
      }
      if (typeof config.transition !== 'undefined') {
        wrap.style.transitionDuration = config.transition + 's';
      }

      // Append wrapper to the element.
      element.style.position = 'relative';
      element.appendChild(wrap);
    }
  }

})(window.ColorBackgroundModifier = window.ColorBackgroundModifier || {});
