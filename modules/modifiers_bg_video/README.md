# Video Background Modifier

## Overview
This module implements a Modifier which allows you to set background video. 
Currently the only supported provider is YouTube, but other providers
can be added if there is support for them in VideoJS.

Optionally you can set media queries.

## Installation
1. The module can be installed via the
[standard Drupal installation process](http://drupal.org/node/1897420).
2. It will create a new Paragraph bundle.
3. It will create a new media bundle of type Video (if it doesn't exist yet).
4. Place [VideoJS Youtube](https://github.com/videojs/videojs-youtube) 
and [VideoJS Background](https://github.com/matthojo/videojs-Background) in 
your libraries folder.
5. Create a new field of Paragraph type on target entity, choose this one or 
more Modifiers to be included.

### Optional steps for better user experience
1. Use a paragraph Preview view mode on Form display.
2. Use Entity browser module for easier creation and selection of media assets.

## Maintainers
This module is maintained by developers at Morpht. For more information on
the company and our offerings, see [morpht.com](https://morpht.com).
