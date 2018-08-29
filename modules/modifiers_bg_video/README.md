# Video Background Modifier

## INTRODUCTION
This module implements a Modifier which allows you to set background video.
Currently the only supported provider is YouTube, but other providers
can be added if there is support for them in VideoJS.

Optionally you can set media queries.

## INSTALLATION
1. The module can be installed via the
[standard Drupal installation process](http://drupal.org/node/1897420).
2. It will create a new Paragraph bundle.
3. It will create a new Video Embed media bundle (if it doesn't exist yet).
4. Create a new field of Paragraph type on target entity, choose this one or
more Modifiers to be included.
5. Install required libraries by one of these 2 options:

### A. Library installation (manual)
1. Download [VideoJS Youtube](https://github.com/videojs/videojs-youtube)
library (version 2.3.2 is recommended).
2. Download [VideoJS Background](https://github.com/matthojo/videojs-Background)
library (version 1.0.7 is recommended).
3. Place unpacked libraries in your libraries folder.

### B. Library installation (composer)
1. Copy the following into your project's composer.json file.
    ```
    "repositories": [
      {
        "type": "package",
        "package": {
          "name": "matthojo/videojs-background",
          "version": "1.0.7",
          "dist": {
            "type": "zip",
            "url": "https://github.com/matthojo/videojs-Background/archive/v1.0.7.zip"
          },
          "require": {
            "composer/installers": "~1.0"
          },
          "type": "drupal-library"
        }
      },
      {
        "type": "package",
        "package": {
          "name": "videojs/videojs-youtube",
          "version": "2.3.2",
          "dist": {
            "type": "zip",
            "url": "https://github.com/videojs/videojs-youtube/archive/v2.3.2.zip"
          },
          "require": {
            "composer/installers": "~1.0"
          },
          "type": "drupal-library"
        }
      }
    ]
    ```
2. Ensure you have following mapping inside your composer.json.
    ```
    "extra": {
      "installer-paths": {
        "libraries/{$name}": ["type:drupal-library"]
      }
    }
    ```
3. Run following command to download required libraries.
    ```
    composer require matthojo/videojs-background videojs/videojs-youtube
    ```

### Optional steps for better user experience
1. Use a paragraph Preview view mode on Form display.
2. Use Entity browser module for easier creation and selection of media assets.

## MAINTAINERS
This module is maintained by developers at Morpht. For more information on
the company and our offerings, see [morpht.com](https://morpht.com).
