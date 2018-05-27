# Parallax Background Modifier

## Overview
This module implements a Modifier which allows you to set background image with
configurable Parallax speed.

Optionally you can set media queries.

## Installation
1. The module can be installed via the
[standard Drupal installation process](http://drupal.org/node/1897420).
2. It will create a new Paragraph bundle.
3. Add this Paragraph bundle to a field_modifiers field on an entity (Block or
Paragraph) or onto a field on a Look.
4. Install required library by one of these 2 options:

### A. Library installation (manual)
1. Download [Jarallax](https://github.com/nk-o/jarallax) library
(version 1.10.3 is recommended).
2. Place unpacked library in your libraries folder.

### B. Library installation (composer)
1. Copy the following into your project's composer.json file.
    ```
    "repositories": [
      {
        "type": "package",
        "package": {
          "name": "nk-o/jarallax",
          "version": "1.10.3",
          "dist": {
            "type": "zip",
            "url": "https://github.com/nk-o/jarallax/archive/v1.10.3.zip"
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
    composer require nk-o/jarallax
    ```

### Optional steps for better user experience
1. Use a paragraph Preview view mode on Form display.
2. Use Entity browser module for easier creation and selection of media assets.

## Maintainers
This module is maintained by developers at Morpht. For more information on
the company and our offerings, see [morpht.com](https://morpht.com).
