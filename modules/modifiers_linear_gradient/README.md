# Color modifier

## Overview
This module implements a Modifier which allows you to use colors from a 
controlled vocabulary of Colors defined by you. It is possible to set 
background, text and link color accompanied by :hover variants. 

Optionally you can set media queries and transition duration.

If you need more freedom with color selection have a look at sibling module 
Custom color modifier (modifiers_custom_colors).

## Installation
1. The module can be installed via the
[standard Drupal installation process](http://drupal.org/node/1897420).
2. It will create a new Paragraph bundle.
3. It will create a new Taxonomy vocabulary "Color", where it is possible to 
set the Colors to be used  throughout the project.
4. Add this Paragraph bundle to a field_modifiers field on an entity (Block or
Paragraph) or onto a field on a Look.

### Optional steps for better user experience
1. Use a paragraph Preview view mode on Form display.
2. Download Spectrum library ([Spectrum](http://bgrins.github.io/spectrum)) to 
your libraries folder and change the widget for 
Color field in Color vocabulary to "Spectrum". 

## Maintainers
This module is maintained by developers at Morpht. For more information on
the company and our offerings, see [morpht.com](http://morpht.com).
