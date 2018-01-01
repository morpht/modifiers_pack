# Modifiers Pack

## Overview

This module provides an starter set of Modifiers which will be helpful for
basic and common modification use cases.

Each of the module can have its own set of requirements and dependencies. Look 
at their respective readme and info files.

## How to Use Modifiers

1. Install the Modifiers module.
2. Install the Modifiers Pack module. Read the installation instructions
carefully to configure libraries correctly.
3. Configure the field settings for the entity bundle (Custom Block, Paragraph)
you wish to modify.
    - Add an unlimited "field_modifiers" ("Entity reference revisions") field
    referencing Paragraphs.
    - Select the Paragraph bundles you would like to reference, ie. the
    modifiers you wish to expose.
    - Save.
4. Create an appropriately typed Entity (Custom Block, Paragraph) and confirm
that the field_modifiers exists and that it can be populated.
    - Add and configure one of the available Modifiers.
    - Save.
5. Confirm that the content has been modified.

## Maintainers

These modules are maintained by developers at Morpht. For more information on
the company and our offerings, see [morpht.com](http://morpht.com).
