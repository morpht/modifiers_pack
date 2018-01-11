# Parallax Background Modifier

## Overview
This module implements a Modifier which allows you to set background image with
configurable Parallax speed.

Optionally you can set media queries.

## Installation
1. The module can be installed via the
[standard Drupal installation process](http://drupal.org/node/1897420).
2. It will create a new Paragraph bundle.
3. It will create a new media bundle of type Image (if it doesn't exist yet).
4. Add this Paragraph bundle to a field_modifiers field on an entity (Block or
Paragraph) or onto a field on a Look.
5. Install required library by one of these 2 options:

### A. Library installation (manual)
1. Download [Parallax.js](https://github.com/pixelcog/parallax.js) library
(version 1.4.2 is recommended).
2. Place unpacked library in your libraries folder.

### B. Library installation (composer)
1. Copy the following into your project's composer.json file.
    ```
    "repositories": [
      {
        "type": "package",
        "package": {
          "name": "pixelcog/parallax.js",
          "version": "1.4.2",
          "dist": {
            "type": "zip",
            "url": "https://github.com/pixelcog/parallax.js/archive/v1.4.2.zip"
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
    composer require pixelcog/parallax.js
    ```

### Optional steps for better user experience
1. Use a paragraph Preview view mode on Form display.
2. Use Entity browser module for easier creation and selection of media assets.

## Maintainers
This module is maintained by developers at Morpht. For more information on
the company and our offerings, see [morpht.com](https://morpht.com).
