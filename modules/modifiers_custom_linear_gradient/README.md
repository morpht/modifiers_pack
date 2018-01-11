# Custom Linear Gradient Modifier

## Overview
This module implements a Modifier which allows you to use colors to set a
linear gradient. You can set multiple colors, they will be evenly distributed
along a customizable direction. If only one color is provided it will be set
as background color.

Optionally you can set media queries and transition duration.

If you need to use controlled vocabulary for color selection you can use the
Linear Gradient Modifier (modifiers_linear_gradient) module.

## Installation
1. The module can be installed via the
[standard Drupal installation process](http://drupal.org/node/1897420).
2. It will create a new Paragraph bundle.
3. Add this Paragraph bundle to a field_modifiers field on an entity (Block or
Paragraph) or onto a field on a Look.

### Optional steps for better user experience
1. Use a paragraph Preview view mode on Form display.
2. Download Spectrum library ([Spectrum](http://bgrins.github.io/spectrum)) to
your libraries folder and change the widget for Color fields to "Spectrum".

## Maintainers
This module is maintained by developers at Morpht. For more information on
the company and our offerings, see [morpht.com](http://morpht.com).
