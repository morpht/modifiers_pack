/**
 * @file
 * Initializes modification based on provided configuration.
 */

(function (DataTablesModifier, $) {

  'use strict';

  DataTablesModifier.apply = function (context, selector, media, config) {

    var element = $(selector, context);
    if (!element.length) {
      return;
    }

    var pluginConfig = {
      paging: (typeof config.paging !== 'undefined' ? config.paging : false),
      searching: (typeof config.searching !== 'undefined' ? config.searching : false),
      ordering: (typeof config.ordering !== 'undefined' ? config.ordering : false),
      scrollCollapse: (typeof config.scroll_collapse !== 'undefined' ? config.scroll_collapse : false),
      scrollX: (typeof config.scroll_x !== 'undefined' ? config.scroll_x : false),
      scrollY: (typeof config.scroll_y !== 'undefined' ? config.scroll_y : false),
      lengthMenu: (typeof config.length_menu !== 'undefined' ? config.length_menu : [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, 'All'],
      ]),
      pageLength: (typeof config.page_length !== 'undefined' ? config.page_length : 10),
      retrieve: true,
      autoWidth: false,
    };

    setDataTable(element, media, pluginConfig);

    window.addEventListener('resize', function () {
      setDataTable(element, media, pluginConfig);
    });

  };

  function setDataTable(element, media, pluginConfig) {

    // Skip badly formatted tables.
    var tables = $('table', element).has('thead').has('tbody').filter(function () {
      var valid = true;
      var columns = $('thead th, thead td', this).length;
      $('tbody tr', this).each(function () {
        if ($('td:lt(' + columns + ')', this).length !== columns) {
          valid = false;
        }
        else if ($('td:gt(' + columns + ')', this).length !== 0) {
          valid = false;
        }
      });
      return valid;
    });

    if (window.matchMedia(media).matches) {
      tables.DataTable(pluginConfig);
    }
    else {
      tables.DataTable().destroy();
    }

  }

})(window.DataTablesModifier = window.DataTablesModifier || {}, jQuery);
