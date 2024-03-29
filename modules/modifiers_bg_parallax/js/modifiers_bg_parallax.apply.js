/**
 * @file
 * Initializes modification based on provided configuration.
 */

(function (ParallaxBgModifier) {

  'use strict';

  ParallaxBgModifier.count = 0;

  ParallaxBgModifier.apply = function (context, selector, media, config) {

    var element = context.querySelector(selector);
    if (!element) {
      return;
    }
    var count = ParallaxBgModifier.count++;

    toggle(element, media, config, count);

    window.addEventListener('resize', function () {
      toggle(element, media, config, count);
    });

  };

  function toggle(element, media, config, count) {

    // Remove specific wrapper by counter, if exists.
    var query = '.bg-parallax-wrap[data-count="' + count + '"]';
    var existing = element.querySelector(query);
    if (existing) {
      jarallax(existing, 'destroy');
      existing.remove();
    }

    if (window.matchMedia(media).matches) {

      // Create a div as the background wrapper.
      var wrap = document.createElement('div');
      wrap.setAttribute('class', 'bg-parallax-wrap');
      wrap.setAttribute('data-count', count);

      // Stretch the wrapper across whole parent element.
      wrap.style.display = 'block';
      wrap.style.position = 'absolute';
      wrap.style.top = '0px';
      wrap.style.right = '0px';
      wrap.style.bottom = '0px';
      wrap.style.left = '0px';
      wrap.style.zIndex = '1';

      var image = document.createElement('img');
      image.setAttribute('src', config.image);
      image.setAttribute('id', 'bg-parallax-image-' + count);
      image.setAttribute('alt', '');
      wrap.appendChild(image);

      // Set background color and parallax.
      if (typeof config.color !== 'undefined') {
        wrap.style.backgroundColor = config.color;
      }
      var pluginConfig = {
        imgElement: '#' + 'bg-parallax-image-' + count,
        speed: (typeof config.speed !== 'undefined' ? config.speed : 0.5),
      };
      jarallax(wrap, pluginConfig);

      // Append wrapper to the element.
      element.style.position = 'relative';
      element.appendChild(wrap);
    }
  }

})(window.ParallaxBgModifier = window.ParallaxBgModifier || {});
