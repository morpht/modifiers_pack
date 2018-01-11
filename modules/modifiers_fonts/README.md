# Font Modifier

## Overview
This module implements a Modifier which allows you to set font(s) via link
to a stylesheet
(e.g. "https<nolink>://fonts.googleapis.com/css?family=Open+Sans:300,400")
and use it on basic HTML tag set.

Optionally you can set media queries.

## Installation
1. The module can be installed via the
[standard Drupal installation process](http://drupal.org/node/1897420).
2. It will create a new Paragraph bundle.
3. Add this Paragraph bundle to a field_modifiers field on an entity (Block or
Paragraph) or onto a field on a Look.
4. The font definition needs to be according CSS shorthand Font property
e.g. "normal 300 1.6rem/2.1rem 'Open Sans', sans-serif".

### Optional steps for better user experience
1. Use a paragraph Preview view mode on Form display.

## Maintainers
This module is maintained by developers at Morpht. For more information on
the company and our offerings, see [morpht.com](https://morpht.com).
