/**
 * @file
 * Initializes modification based on provided configuration.
 */

(function (VideoBgModifier) {

  'use strict';

  VideoBgModifier.apply = function (selector, media, config) {

    var element = document.querySelector(selector);
    var id = element.getAttribute('id');
    if (!id) {
      id = selector.replace(/[^a-zA-Z0-9-_]/g, '_');
      element.setAttribute('id', id);
    }

    var video = document.createElement('video');
    video.setAttribute('id', id + '-bg');
    video.setAttribute('class', 'video-js vjs-default-skin');
    element.parentNode.insertBefore(video, element.nextSibling);

    switch (config.provider) {

      case 'youtube':
        var configVideo = {
          autoplay: true,
          controls: false,
          loop: true,
          muted: true,
          fluid: true,
          techOrder: ['youtube'],
          sources: [{
            type: 'video/youtube',
            src: 'https://www.youtube.com/embed/' + config.video
          }],
          youtube: {
            disablekb: 1
          }
        };
        var configBackground = {
          container: id,
          mediaType: 'Youtube'
        };
        videojs(id + '-bg', configVideo).Background(configBackground);
        break;
    }

    var wrapper = element.querySelector('.videojs-background-wrap');

    toggle(wrapper, media);

    window.addEventListener('resize', function () {
      toggle(wrapper, media);
    });

  };

  function toggle(element, media) {

    if (window.matchMedia(media).matches) {
      element.style.display = '';
    }
    else {
      element.style.display = 'none';
    }

  }

})(window.VideoBgModifier = window.VideoBgModifier || {});
