/**
 * @file
 * Initializes modification based on provided configuration.
 */

(function (ScrollRevealModifier) {

  'use strict';

  ScrollRevealModifier.apply = function (context, selector, media, config) {

    var element = context.querySelector(selector);
    if (!element || window.scroll_was_run) {
      return;
    }

    window.scroll_was_run = true;

    var pluginConfig = {
      origin: (typeof config.origin !== 'undefined' ? config.origin : 'bottom'),
      distance: (typeof config.distance !== 'undefined' ? config.distance : '20px'),
      duration: (typeof config.duration !== 'undefined' ? config.duration : 500),
      delay: (typeof config.delay !== 'undefined' ? config.delay : 0),
      opacity: (typeof config.opacity !== 'undefined' ? config.opacity : 0),
      scale: (typeof config.scale !== 'undefined' ? config.scale : 0.9),
      mobile: (typeof config.mobile !== 'undefined' ? config.mobile : false),
      interval: (typeof config.interval !== 'undefined' ? config.interval : 0),
    };

    if (typeof window.sr === 'undefined') {
      window.sr = ScrollReveal();
    }

    if (typeof config.selector !== 'undefined') {
      sr.reveal(selector + ' ' + config.selector, pluginConfig);
    }
    else {
      sr.reveal(selector, pluginConfig);
    }

  };

})(window.ScrollRevealModifier = window.ScrollRevealModifier || {});
