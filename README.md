# Modifiers Pack

## INTRODUCTION

This module provides an starter set of Modifiers which will be helpful for
basic and common modification use cases.

Each of the module can have its own set of requirements and dependencies. Look
at their respective readme and info files.

## REQUIREMENTS

1. Install the [Modifiers](https://www.drupal.org/project/modifiers) module.
2. Read the Modifiers Pack submodules installation instructions carefully to
configure libraries correctly.

## INSTALLATION

1. The module can be installed via the
[standard Drupal installation process](http://drupal.org/node/1897420).

## CONFIGURATION

1. Configure the field settings for the entity bundle (Custom Block, Paragraph)
you wish to modify.
    - Add an unlimited "field_modifiers" ("Entity reference revisions") field
    referencing Paragraphs.
    - Select the Paragraph bundles you would like to reference, ie. the
    modifiers you wish to expose.
    - Save.
2. Create an appropriately typed Entity (Custom Block, Paragraph) and confirm
that the field_modifiers exists and that it can be populated.
    - Add and configure one of the available Modifiers.
    - Save.
3. Confirm that the content has been modified.

## MAINTAINERS

These modules are maintained by developers at Morpht. For more information on
the company and our offerings, see [morpht.com](http://morpht.com).
