/**
 * @file
 * Initializes modification based on provided configuration.
 */

(function (CustomRadialGradientModifier) {

  'use strict';

  CustomRadialGradientModifier.count = 0;

  CustomRadialGradientModifier.apply = function (context, selector, media, config) {

    var element = context.querySelector(selector);
    if (!element) {
      return;
    }
    var count = CustomRadialGradientModifier.count++;

    toggle(element, media, config, count);

    window.addEventListener('resize', function () {
      toggle(element, media, config, count);
    });

  };

  function toggle(element, media, config, count) {

    // Remove specific wrapper by counter, if exists.
    var query = '.custom-radial-gradient-wrap[data-count="' + count + '"]';
    var existing = element.querySelector(query);
    if (existing) {
      existing.remove();
    }

    if (window.matchMedia(media).matches) {

      // Create a div as the background wrapper.
      var wrap = document.createElement('div');
      wrap.setAttribute('class', 'custom-radial-gradient-wrap');
      wrap.setAttribute('data-count', count);

      // Stretch the wrapper across whole parent element.
      wrap.style.display = 'block';
      wrap.style.position = 'absolute';
      wrap.style.top = '0px';
      wrap.style.right = '0px';
      wrap.style.bottom = '0px';
      wrap.style.left = '0px';
      wrap.style.zIndex = '1';

      // Set background based on colors.
      if (config.colors.length > 1) {
        wrap.style.backgroundImage = 'radial-gradient('
          + config.shape + ' ' + config.size + ' at ' + config.x + '% '
          + config.y + '%,' + config.colors.join() + ')';
      }
      else {
        wrap.style.backgroundColor = config.colors[0];
      }

      // Append wrapper to the element.
      element.style.position = 'relative';
      element.appendChild(wrap);
    }
  }

})(window.CustomRadialGradientModifier = window.CustomRadialGradientModifier || {});
