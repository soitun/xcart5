/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Product details controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

/**
 * Controller
 */

function ProductDetailsController(base)
{
  var o = this;
  ProductDetailsController.superclass.constructor.apply(this, arguments);

  if (
    this.base
    && this.base.get(0)
    && (
      core.getCommentedData(jQuery('body'), 'product_id')
      || (
        jQuery('form.product-details', this.base).get(0)
        && jQuery('form.product-details', this.base).get(0).elements.namedItem('product_id')
      )
    )
  ) {
    this.productId = core.getCommentedData(jQuery('body'), 'product_id')
      ? core.getCommentedData(jQuery('body'), 'product_id')
      : jQuery('form.product-details', this.base).get(0).elements.namedItem('product_id').value;

    this.block = new ProductDetailsView(this.base, this.productId);

    core.bind(
      'updateCart',
      function(event, data) {
        for (var i = 0; i < data.items.length; i++) {
          if (data.items[i].object_type == 'product' && data.items[i].object_id == o.productId) {
            if (0 < data.items[i].quantity && !jQuery('body').hasClass('added-product')) {
              jQuery('body').addClass('added-product')
                .removeClass('non-added-product');

            } else if (0 == data.items[i].quantity && jQuery('body').hasClass('added-product')) {
              jQuery('body').addClass('non-added-product')
                .removeClass('added-product');
            }
          }
        }

        if (!o.selfAdded) {
          for (var i = 0; i < data.items.length; i++) {
            if (data.items[i].object_type == 'product' && data.items[i].object_id == o.productId) {
              o.block.load();
            }
          }
        }
      }
    );

    core.callTriggersBind('update-product-page');
  }
}

extend(ProductDetailsController, AController);

// Prodiuct id
ProductDetailsController.prototype.productId = null;

// Controller name
ProductDetailsController.prototype.name = 'ProductDetailsController';

// Find pattern
ProductDetailsController.prototype.findPattern = 'div.product-details';

// Controller associated main widget
ProductDetailsController.prototype.block = null;

// Controller associated buttons block widget
ProductDetailsController.prototype.buttonsBlock = null;

ProductDetailsController.prototype.selfAdded = false;

// Initialize controller
ProductDetailsController.prototype.initialize = function()
{
  var o = this;

  this.base.bind(
    'reload',
    function(event, box) {
      o.bind(box);
      core.trigger('update-product-page', o.productId);
    }
  );
};

/**
 * Main widget
 */

function ProductDetailsView(base, productId)
{
  this.callSupermethod('constructor', arguments);

  this.productId = productId;

  this.linkClickHandler = _.bind(
    function(event)
    {
      event.stopPropagation();

      this.showLightbox();
      jQuery('.product-image-gallery li.selected a', this.base).eq(0).trigger('click');

      return false;
    },
    this
  );
}

extend(ProductDetailsView, ALoadable);

// Prodiuct id
ProductDetailsView.prototype.productId = null;

ProductDetailsView.prototype.shadeClass = 'wait-progress overlay-blur-base';
// Widget target
ProductDetailsView.prototype.widgetTarget = 'product';

// Widget class name
ProductDetailsView.prototype.widgetClass = '\\XLite\\View\\Product\\Details\\Customer\\Page\\Main';

// Imgaes gallery
ProductDetailsView.prototype.gallery = null;

// Zoom layer max. width
ProductDetailsView.prototype.zoomMaxWidth = 460;

// Width after which the zoom will be initialized
ProductDetailsView.prototype.zoomWidth = 768;

// Zoom widget
ProductDetailsView.prototype.zoomWidget = false;

// Zoom layer max. width
ProductDetailsView.prototype.kZoom = 1.3;

ProductDetailsView.prototype.shadeWidget = function()
{
  return 0 == this.base.parents('.ui-dialog').length;
};

ProductDetailsView.prototype.preloadHandler = function ()
{
  if (this.hasClass('product-quicklook')) {
    popup.close();
  }
};

// Postprocess widget
ProductDetailsView.prototype.postprocess = function(isSuccess, initial)
{
  this.callSupermethod('postprocess', arguments);

  if (isSuccess) {

    // Hide popup title
    jQuery(this.base).parents('.ui-dialog').eq(0).addClass('no-title');

    // Save gallery list items
    this.gallery = jQuery('.image .product-image-gallery li', this.base);

    var o = this;

    // Bind the cloud zoom triggering event.
    // The element initializes itself the cloud zoom widget
    jQuery('.cloud-zoom', this.base).bind(
      'cloud-zoom',
      function (event) {
        if (jQuery(window).width() > o.zoomWidth) {
          if (jQuery(this).data('zoom')) {
            jQuery(this).data('zoom').destroy();
          }

          if (jQuery(this).data('rel-data')) {
            jQuery(this).attr('rel', jQuery(this).data('rel-data'));
          }

          jQuery(this).CloudZoom();

        } else {

          if (!jQuery(this).data('rel-data')) {
            jQuery(this).data('rel-data', jQuery(this).attr('rel'));
          }

          if (jQuery(this).data('zoom')) {
            jQuery(this).data('zoom').destroy();
          }

          var rel = core.getRelArray(jQuery(this));

          rel.position = "'inside'";
          rel.adjustX  = intval(jQuery('.image .product-photo img', o.base).offset().left - jQuery('.image .product-photo .cloud-zoom', o.base).offset().left);

          core.setRelArray(jQuery(this), rel);

          jQuery(this).CloudZoom();

          jQuery('.image .product-photo img', o.base).css({width: 'auto', height: 'auto'});
        }
      }
    );

    // Arrow-based image navigation
    jQuery('.image .left-arrow', this.base).click(
      function (event) {
        o.switchImage(-1);
      }
    );

    jQuery('.image .right-arrow', this.base).click(
      function (event) {
        o.switchImage(1);
      }
    );

    // Form AJAX-based submit
    var form = this.base.find('form.product-details').get(0);
    if (form) {
      form.commonController
        .enableBackgroundSubmit()
        .bind('local.beforeSubmit', _.bind(this.addProductToCart, this))
        .bind('local.submitted', _.bind(this.postprocessAdd2Cart, this))
    }

    // Cloud zoom
    var cloud = jQuery('.cloud-zoom', this.base);

    if (cloud.length) {
      // The zoom effect is removed from Quick look
      this.zoomWidget = !this.base.hasClass('product-quicklook');

      if (core.getCommentedData(cloud, 'kZoom')) {
        this.kZoom = core.getCommentedData(cloud, 'kZoom');
      }

      var imageWrapper = jQuery(document.createElement('div')).addClass('wrapper');

      cloud.wrap(imageWrapper);
    }

    // Change Continue shopping button for QuickLook mode
    if (this.base.hasClass('product-quicklook') && 0 < this.base.parents('.blockUI').length) {
      jQuery('button.continue', this.base)
        .unbind('click')
        .removeAttr('onclick');
      jQuery('button.continue', this.base).click(
        function() {
          popup.close();
          return false;
        }
      );
    }

    // Show Lightbox on the image click
    cloud.click(
      function(event) {
        o.showLightbox();
        jQuery('.product-image-gallery li.selected a').eq(0).trigger('click');

        return false;
      }
    );

    // Gallery
    if (typeof(window.lightBoxImagesDir) != 'undefined') {
      jQuery('.loupe', this.base).click(
        function(event) {
          o.showLightbox();
          setTimeout(
            function() {
              jQuery('.product-image-gallery li.selected a').eq(0).trigger('click');
            },
            500
          );

          return false;
        }
      );
    }

    this.hideLightbox();

    // Tabs
    var tabsBase = jQuery('.product-details-tabs', this.base);
    tabsBase.find('.tabs li a').click(
      function (event) {
        event.preventDefault();

        var link = jQuery(this);
        tabsBase.find('.tabs li').removeClass('active');
        link.parent().addClass('active');

        tabsBase.find('.tabs-container .tab-container').hide();
        tabsBase.find('.tabs-container #' + link.data('id')).show();

        self.location.hash = link.data('id');
      }
    );

    var hash = ((self.location.hash) + '').replace(/^#/, '');
    if (hash) {
      tabsBase.find('.tabs li a').each(
        function() {
          var link = jQuery(this);
          if (link.data('id') == hash) {
            link.click();
          }
        }
      );
    }

    if (jQuery('.product-image-gallery li a', this.base).length) {
      // TODO: improve to skip additional JS manipulations
      // like resizing etc when it is not needed
      jQuery('.product-image-gallery li a', o.base).first().click();
      if (jQuery.browser.mozilla) {
        jQuery('.product-image-gallery li a', o.base).first().click();
      }
    } else if (this.zoomWidget && !cloud.data('zoom')) {
      cloud.trigger('cloud-zoom');
    }
  }
};

ProductDetailsView.prototype.showLightbox = function()
{
  var o = this;

  jQuery('.product-image-gallery a', this.base)
    .unbind('click')
    .colorbox(
      {
        onComplete: function() {
          jQuery('#cboxCurrent').css('display', 'none');
        },
        onClosed: function() {
          o.hideLightbox();
        },
        maxWidth: jQuery(document).width(),
        maxHeight: jQuery(document).height()
      }
    );
};

ProductDetailsView.prototype.hideLightbox = function()
{
  var o = this;

  jQuery('.product-image-gallery a', this.base)
    .unbind('click')
    .bind(
      'click',
      function(event) {
        event.stopPropagation();
        o.selectImage(
          jQuery.inArray(this, jQuery(this).parents('ul').eq(0).find('a').get())
        );

        return false;
      }
    );
};

// Get base element for shade / unshade operation
ProductDetailsView.prototype.getShadeBase = function() {
  return jQuery('.shade-base', this.base).eq(0);
};

// Image gallery switcher
ProductDetailsView.prototype.switchImage = function(diff)
{
  var selected = -1;
  var i = 0;

  // Detect current index
  this.gallery.each(
      function() {
        if (selected == -1 && jQuery(this).hasClass('selected')) {
          selected = i;
        }
        i++;
      }
  );

  if (selected == -1) {
    selected = 0;
  }

  // Calculate new position
  var next = selected + diff;

  if (next < 0) {
    next = this.gallery.length - Math.abs(next) % this.gallery.length;
  } else if (next >= this.gallery.length) {
    next = next % this.gallery.length;
  }

  return this.selectImage(next);
};

// Select image from gallery
ProductDetailsView.prototype.selectImage = function(pos)
{
  this.gallery.removeClass('selected');

  // Refresh main image and another options + cloud zoom plugin restart
  next = this.gallery.eq(pos);
  next.addClass('selected');

  if (this.zoomWidget) {
    var cloud = jQuery('.cloud-zoom', this.base);

    if (cloud.data('zoom')) {
      cloud.data('zoom').destroy();
    } else {
      cloud.unbind('click', this.linkClickHandler);
    }

    cloud.attr('href', jQuery('a', next).attr('href'));
  }

  var middle = jQuery('img.middle', next).eq(0);
  if (middle.length > 0) {
    jQuery('.image .product-photo img', this.base)
      .hide()
      .attr('src', middle.attr('src'))
      .width(middle.width())
      .height(middle.height())
      .attr('alt', middle.attr('alt'))
      .show();
  }

  if (jQuery('a', next).length) {
    eval('var tmp = {' + jQuery('a', next).attr('rev') + '}');

    if (this.zoomWidget) {
      if (
        tmp.width > (middle.width()  * this.kZoom)
        || tmp.height > (middle.width()  * this.kZoom)
      ) {
        cloud.trigger('cloud-zoom');
      } else {
        cloud.click(this.linkClickHandler);
      }
    }
  }
};

// Get additional parameters
ProductDetailsView.prototype.getParams = function(params)
{
  params = this.callSupermethod('getParams', arguments);

  params.product_id = this.productId;
  params.added = 1;

  return params;
};

// Form submit handler
ProductDetailsView.prototype.addProductToCart = function(event)
{
  // We do not shade widgets collection after the product is added to cart
  core.doShadeWidgetsCollection = false;
  this.base.get(0).controller.selfAdded = true;
};

// Form POST processor
ProductDetailsView.prototype.postprocessAdd2Cart = function(event, data)
{
  this.base.get(0).controller.selfAdded = false;

  data.isValid ? this.load() : this.unshade();
};

// Get event namespace (prefix)
ProductDetailsView.prototype.getEventNamespace = function()
{
  return 'block.product.details';
};

core.autoload(ProductDetailsController);

core.bind(
  'update-product-page',
  function (event, productId)
  {
    core.processUpdateWidgetsCollection(
      'update-product-page',
      '\\XLite\\View\\ProductPageCollection',
      {product_id: productId},
      '.product-info-' + productId
    );
  }
);

var resizerTimer;

jQuery(window).resize(
  function (event) {
    clearTimeout(resizerTimer);
    resizerTimer = setTimeout(
      function () {
        jQuery('.cloud-zoom').trigger('cloud-zoom');
      },
      500
    );
  }
);
