/**
 * @file
 * Initializes modification based on provided configuration.
 */

(function (ImageBgModifier) {

  'use strict';

  ImageBgModifier.count = 0;

  ImageBgModifier.apply = function (context, selector, media, config) {

    var element = context.querySelector(selector);
    if (!element) {
      return;
    }
    var count = ImageBgModifier.count++;

    toggle(element, media, config, count);

    window.addEventListener('resize', function () {
      toggle(element, media, config, count);
    });

  };

  function toggle(element, media, config, count) {

    // Remove specific wrapper by counter, if exists.
    var query = '.bg-image-wrap[data-count="' + count + '"]';
    var existing = element.querySelector(query);
    if (existing) {
      existing.remove();
    }

    if (window.matchMedia(media).matches) {

      // Create a div as the background wrapper.
      var wrap = document.createElement('div');
      wrap.setAttribute('class', 'bg-image-wrap');
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
      wrap.style.backgroundImage = 'url("' + config.image + '")';
      if (typeof config.size !== 'undefined') {
        wrap.style.backgroundSize = config.size;
      }
      if (typeof config.repeat !== 'undefined') {
        wrap.style.backgroundRepeat = config.repeat;
      }
      if (typeof config.position !== 'undefined') {
        wrap.style.backgroundPosition = config.position;
      }
      if (typeof config.color !== 'undefined') {
        wrap.style.backgroundColor = config.color;
      }

      // Append wrapper to the element.
      element.style.position = 'relative';
      element.appendChild(wrap);
    }
  }

})(window.ImageBgModifier = window.ImageBgModifier || {});
