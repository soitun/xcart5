/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Instant search
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

jQuery(function (jQuery) {

  var Accordion = {

    config: {
      intentTimeout: 200,
      duration: 300,
      easing: "easeInSine",
      activeTitleColor: "#0f9dcc",
      inactiveTitleColor: "#2c5fa6"
    },

    init: function (accordion) {
      this.acc = accordion;

      var self = this;

      this.acc
        .find('dt')
          .hoverIntent({
            over: function () {
              self.play.call(self, this);
            },
            timeout: this.config.intentTimeout,
            out: function () {}
          });

      this.acc.find('dd').each(function () {
        var dd = jQuery(this),
            dt = dd.prev();

        dd.css('top', dt.position().top + 'px');
      });

      this.play(this.acc.find('dt:first-child'));
    },

    animateShow: function (e) {
      //e.slideDown(this.config.duration, this.config.easing);
      e.show();
    },

    animateHide: function (e) {
      //e.slideUp(this.config.duration, this.config.easing);
      e.hide();
    },

    play: function (dt) {
      var active = jQuery(dt).next(),
        others = active.siblings('dd');

      this.animateShow(active);
      this.animateHide(others);
    }
  };

  var Search = {

    config: {
      minChars: 3,
      timeout: 300
    },

    init: function (element) {
      this.elem = element;

      this.elem.attr('autocomplete', 'off')
        .keydown(jQuery.proxy(this, "keydown"));

      var menuOpts = {
        'id':     'instant_search_menu',
        'class':  'instant-search-menu'
      };
      this.menu = jQuery('<div></div>', menuOpts)
        .appendTo(document.body)
        .hide()
        .outerWidth(300);

      this.loader = jQuery('<div></div>', { 'class': 'instant-search-loader' })
        .appendTo(document.body)
        .hide();

      jQuery(document.body)
        .mousedown(jQuery.proxy(this, "mousedown"))
        .keydown(jQuery.proxy(this, "globalKeydown"));

      jQuery(window).resize(jQuery.proxy(this, "reposition"));

    },

    reposition: function () {
      if (this.menu.is(':visible')) {
        this.menu.position({
          of: this.elem,
          at: "left bottom",
          my: "left top",
          offset: "1px 3px",
          collision: "none"
        });
      }

      if (this.loader.is(':visible')) {
        this.loader.position({
          of: this.elem,
          at: "right top",
          my: "right top",
          offset: "-28px 2px",
          collision: "none"
        });
      }
    },

    keydown: function (e) {
      var code = e.keyCode || e.which;
      clearTimeout(this.action);

      var openKeys = [40], // Arrow down
        closeKeys = [13, 27, 9, 38], // Enter, ESC, Tab, Arrow up
        ignoreKeys = [37, 39, 35, 36, 123, 112]; // Left and right arrows, Home, End, F12, F1

      if (jQuery.inArray(code, openKeys) != -1)
        this.load();
      else if (jQuery.inArray(code, closeKeys) != -1)
        this.close();
      else if (jQuery.inArray(code, ignoreKeys) == -1)
        this.action = setTimeout(jQuery.proxy(this, "toggle"), this.config.timeout);
    },

    globalKeydown: function (e) {
      var code = e.keyCode || e.which;

      (27 == code) && this.close();
    },

    mousedown: function (e) {
      if (e.target == this.menu[0] || e.target == this.elem[0])
        return;

      var found = false,
        self = this;
      jQuery(e.target).parents().each(function (index, element) {
        if (element == self.menu[0]) {
           found = true;
           return false;
        }
      });

      if (!found)
        this.menu.hide();
    },

    canOpen: function () {
      return jQuery.trim(this.elem.val()).length >= this.config.minChars;
    },

    isOpen: function () {
      return this.menu.is(':visible');
    },

    toggle: function () {
      this.canOpen() ? this.load() : this.close();
    },

    load: function () {
      if (!this.canOpen())
        return;

      if (this.xhr)
        this.xhr.abort();

      var searchTerm = jQuery.trim(this.elem.val()).toLowerCase();

      if (this.searchTerm == searchTerm) {
        if (this.menu.find('dl').children().length) {
          this.menu.show();
          this.reposition();
        }
      } else {
        this.loader.show();
        this.reposition();

        var self = this;
        this.xhr = jQuery.get(
          URLHandler.buildURL(
            {
              'target': 'instant_search',
              'widget': '\\XLite\\Module\\CDev\\InstantSearch\\View\\InstantSearch',
              'substring': searchTerm,
              't': +new Date,
            }
          ),
          function (data, textStatus, xhr) {
            var data = jQuery('<div>').append(data).find('.ajax-container-loadable').html();
            self.searchTerm = searchTerm;
            self.loader.hide();
            self.open(data);
          }
        );
      }
    },

    open: function (data) {
      this.menu.html(data);

      var acc = this.menu.find('dl');
      if (acc.children().length > 0) {
        this.menu.show();
        this.reposition();

        this.process();
        Accordion.init(acc);
      } else {
        this.menu.hide();
      }
    },

    close: function () {
      if (this.xhr)
        this.xhr.abort();

      this.loader.hide();

      this.menu.hide();
    },

    process: function () {

      this.menu.find('dd .item_container').each(function () {
        new InstantSearchProductView(this, jQuery(this).data('product-id'));
      });

      this.menu.find('dt').each(function () {
        var title = jQuery(this).html();
        jQuery.each(Search.searchTerm.split(" "), function () {
          if (this.length > 0) {
            title = Search.highlightHits(title, this);
          }
        });
        jQuery(this).html(title);
      });
    },

    highlightHits: function (bodyText, searchTerm) {
      var newText = "",
        i = -1,
        lcSearchTerm = searchTerm.toLowerCase(),
        lcBodyText = bodyText.toLowerCase(),
        openingTag = '<span class="highlight-hit">',
        closingTag = '</span>';

      while (bodyText.length > 0) {
        i = lcBodyText.indexOf(lcSearchTerm, i+1);
        if (i < 0) {
          newText += bodyText;
          bodyText = "";
        } else if (bodyText.lastIndexOf(">", i) >= bodyText.lastIndexOf("<", i)) {
          newText += bodyText.substring(0, i) + openingTag + bodyText.substr(i, searchTerm.length) + closingTag;
          bodyText = bodyText.substr(i + searchTerm.length);
          lcBodyText = bodyText.toLowerCase();
          i = -1;
        }
      }

      return newText;
    }

  };

  var searchBox = jQuery(".simple-search-box input[type=text]");
  Search.init(searchBox);

});


function InstantSearchProductView(base, productId) {
  this.callSupermethod('constructor', arguments);

  this.productId = productId;

  var self = this;
  core.bind('updateCart', function (event, data) {
    jQuery.each(data.items, function () {
      if ('product' === this.object_type && self.productId === this.object_id) {
        self.load();
        return false;
      }
    });
  });
}

extend(InstantSearchProductView, ALoadable);

InstantSearchProductView.prototype.productId = null;
InstantSearchProductView.prototype.shadeWidget = true;
InstantSearchProductView.prototype.widgetTarget = 'instant_search';
InstantSearchProductView.prototype.widgetClass = '\\XLite\\Module\\CDev\\InstantSearch\\View\\Product';
InstantSearchProductView.prototype.getParams = function(params) {
  params = this.callSupermethod('getParams', arguments);

  params.productId = this.productId;

  return params;
}

InstantSearchProductView.prototype.getShadeBase = function() {
  return jQuery('.shade-base', this.base).eq(0);
}

InstantSearchProductView.prototype.beforeSubmit = function() {
  this.shade();
}

InstantSearchProductView.prototype.postprocess = function(isSuccess, initial)
{
  // Intentionally not calling parent
  // this.callSupermethod('postprocess', arguments);

  var self = this;
  this.base.find('form.instant-search-product-details').each(
    function () {
      var cf = new CommonForm(this);
      cf.enableBackgroundSubmit(jQuery.proxy(self, 'beforeSubmit'), function () {});
    }
  );
}
