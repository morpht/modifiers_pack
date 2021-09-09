/**
 * @file
 * Initializes modification based on provided configuration.
 */

(function (VideoBgModifier) {

  'use strict';

  VideoBgModifier.apply = function (context, selector, media, config) {

    var element = context.querySelector(selector);
    if (!element) {
      return;
    }

    // iOS devices do not display the video. We will serve an image to them.
    var iOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
    if (iOS !== false && typeof config.image !== 'undefined') {
      var image = 'url("' + config.image + '")';
      element.style.backgroundPosition = 'center';
      element.style.backgroundSize = 'cover';

      toggleMobile(element, media, image);

      window.addEventListener('resize', function () {
        toggleMobile(element, media, image);
      });
    }
    else {
      var id = element.getAttribute('id');
      if (!id) {
        id = selector.replace(/[^a-zA-Z0-9-_]/g, '_');
        element.setAttribute('id', id);
      }

      var video = context.createElement('video');
      video.setAttribute('id', id + '-bg');
      video.setAttribute('class', 'video-js vjs-default-skin');
      video.setAttribute('autoplay', '');
      video.setAttribute('loop', '');
      video.setAttribute('muted', '');
      video.setAttribute('playsinline', '');
      element.parentNode.insertBefore(video, element.nextSibling);

      var videoConfig = {
        autoplay: true,
        controls: false,
        loop: true,
        muted: true,
        fluid: true,
      };
      var videoBgConfig = {
        container: id,
      };

      switch (config.provider) {

        case 'vimeo':
          videoConfig.techOrder = ['vimeo'];
          videoConfig.sources = [{
            type: 'video/vimeo',
            src: 'https://vimeo.com/' + config.video,
          }];
          videoBgConfig.mediaType = 'Vimeo';
          break;

        case 'youtube':
          videoConfig.techOrder = ['youtube'];
          videoConfig.sources = [{
            type: 'video/youtube',
            src: 'https://www.youtube.com/embed/' + config.video,
          }];
          videoConfig.youtube = {
            disablekb: 1,
            playsinline: 1,
          };
          videoBgConfig.mediaType = 'Youtube';
          break;
      }

      videojs(id + '-bg', videoConfig);
      setTimeout(function () {
        videojs(id + '-bg').Background(videoBgConfig);
      }, 1);

      var wrapper = element.querySelector('.videojs-background-wrap');
      if (!wrapper) {
        return;
      }

      toggleDesktop(wrapper, media);

      window.addEventListener('resize', function () {
        toggleDesktop(wrapper, media);
      });
    }

  };

  function toggleDesktop(element, media) {

    if (window.matchMedia(media).matches) {
      element.style.display = '';
    }
    else {
      element.style.display = 'none';
    }

  }

  function toggleMobile(element, media, image) {

    if (window.matchMedia(media).matches) {
      element.style.backgroundImage = image;
    }
    else {
      element.style.backgroundImage = '';
    }

  }

})(window.VideoBgModifier = window.VideoBgModifier || {});
