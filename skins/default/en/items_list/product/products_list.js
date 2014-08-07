/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Products list controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function ProductsListView(base)
{
  ProductsListView.superclass.constructor.apply(this, arguments);
}

extend(ProductsListView, ListView);

// Products list class
function ProductsListController(base)
{
  ProductsListController.superclass.constructor.apply(this, arguments);

  this.dragDropCart = core.getCommentedData(jQuery('body'), 'dragDropCart');

  core.bind(
    'updateCart',
    _.bind(
    function(event, data) {
      var productPattern, product;
      for (var i = 0; i < data.items.length; i++) {
        if (data.items[i].object_type == 'product') {

          // Added mark
          productPattern = '.product.productid-' + data.items[i].object_id;
          product = jQuery(productPattern, base);
          if (data.items[i].quantity > 0) {
            product.addClass('product-added');
            if (this.block) {
              this.block.triggerVent('item.addedToCart', {'view': this, 'item': product});
            }

          } else {
            product.removeClass('product-added');
            if (this.block) {
              this.block.triggerVent('item.removedFromCart', {'view': this, 'item': product});
            }
          }

          // Check inventory limit
          if (data.items[i].is_limit) {
            product
              .addClass('out-of-stock')
              .draggable('disable');
            if (this.block) {
              this.block.triggerVent('item.outOfStock', {'view': this, 'item': product});
            }

          } else {
            product
              .removeClass('out-of-stock');

            // We add the draggable product if 'dragDropCart' flag is on (currently it is on if non-mobile device is used)
            if (product.parents('.ui-draggable').length && dragDropCart) {
              product.draggable('enable');
            }

            if (this.block) {
              this.block.triggerVent('item.stockIncrease', {'view': this, 'item': product});
            }
          }

        }
      }
    },
    this
    )
  );

};

extend(ProductsListController, ListsController);

ProductsListController.prototype.name = 'ProductsListController';

ProductsListController.prototype.getListView = function()
{
  return new ProductsListView(this.base);
};

ProductsListView.prototype.postprocess = function(isSuccess, initial)
{
  ProductsListView.superclass.postprocess.apply(this, arguments);

  var o = this;
  this.dragDropCart = core.getCommentedData(jQuery('body'), 'dragDropCart');

  if (!this.dragDropCart) {
    jQuery('.drag-n-drop-handle').hide();
  }

  if (isSuccess) {

    // Column switcher for 'table' display mode
    jQuery('.products-table .column-switcher', this.base).commonController('markAsColumnSwitcher');

    // Must be done before any event handled on 'A' tags. IE fix
    if (jQuery.browser.msie) {
      jQuery(draggablePattern, this.base).find('a')
        .each(
          function() {
            this.defferHref = this.href;
            this.href = 'javascript:void(0);';
          }
        )
        .click(
          function() {
            if (!o.base.hasClass('ie-link-blocker')) {
              self.location = this.defferHref;
            }
          }
        );
    }

    // Register "Changing display mode" handler
    jQuery('.display-modes a', this.base).click(
      function() {
        return !o.load({'displayMode': jQuery(this).attr('class')});
      }
    );

    // Register "Sort by" selector handler
    jQuery('.sort-crit a', this.base).click(
      function () {
        return !o.load({
          'sortBy': jQuery(this).data('sort-by'),
          'sortOrder': jQuery(this).data('sort-order')
        });
      }
    );

    // Register "Quick look" button handler
    jQuery('.quicklook a.quicklook-link', this.base).click(
      function () {
        popup.openAsWait();

        return !popup.load(
          URLHandler.buildURL({
            target:      'quick_look',
            action:      '',
            product_id:  core.getValueFromClass(this, 'quicklook-link'),
            only_center: 1
          }),
          function () {
            jQuery('.formError').hide();
          },
          50000
        );
      }
    );

    core.bind(
      'afterPopupPlace',
      function() {
        new ProductDetailsController(jQuery('.ui-dialog div.product-quicklook'));
      }
    );

    var cartTrayFadeOutDuration = 400;
    var draggablePattern = '.products-grid .product, .products-list .product, .products-sidebar .product';
    var cartTray = jQuery('.cart-tray-box', this.base).eq(0);
    var countRequests = 0;

    cartTray.data('isproductdrag', false);

    this.dragDropCart ? jQuery(draggablePattern, this.base).draggable(
    {
      revert:         'invalid',
      revertDuration: 300,
      zIndex:         500,
      distance:       10,
      containment:    'body',

      helper: function()
      {
        var base = jQuery(this);
        var clone = base
          .clone()
          .css(
            {
              'width':  base.parent().width() + 'px',
              'height': base.parent().height() + 'px'
            }
          );

        base.addClass('drag-owner');
        base.parent().addClass('current');

        if (jQuery.browser.msie) {
          base.addClass('ie-link-blocker');
        }

        clone.find('a').click(
          function() {
            return false;
          }
        );

        return clone.get(0);
      }, // helper()

      start: function(event, ui)
      {
        cartTray.data('isproductdrag', true);
        cartTray.not('.cart-tray-adding, .cart-tray-added')
          .addClass('cart-tray-active cart-tray-moving')
          .attr('style', 'display:block');
      }, // start()

      stop: function(event, ui)
      {
        cartTray.data('isproductdrag', false);
        cartTray.not('.cart-tray-adding, .cart-tray-added')
          .fadeOut(
            cartTrayFadeOutDuration,
            function() {
              if (cartTray.data('isproductdrag')) {
                jQuery(this).show();

              } else {
                jQuery(this)
                  .removeClass('cart-tray-active cart-tray-moving cart-tray-added');
              }
            }
          );

        jQuery('.drag-owner').removeClass('drag-owner');
        jQuery('.product-cell.current').removeClass('current');

        if (jQuery.browser.msie) {
          var downer = jQuery('.drag-owner');
          setTimeout(
            function() {
              downer.removeClass('ie-link-blocker');
            },
            1000
          );
        }

      } // stop()

    }
    ) : false; // jQuery(draggablePattern, this.base).draggable

    // Disable out-of-stock product to drag
    var draggableDisablePattern = '.products-grid .product.out-of-stock, .products-list .product.out-of-stock, .products-sidebar .product.out-of-stock';
    jQuery(draggableDisablePattern, this.base).draggable('disable');

    // Disable not-available product to drag
    draggableDisablePattern = '.products-grid .product.not-available, .products-list .product.not-available, .products-sidebar .product.not-available';
    jQuery(draggableDisablePattern, this.base).draggable('disable');

    // Disable dragging the products when the customer need to choose the product options for them first
    draggableDisablePattern = '.products-grid .product.need-choose-options, .products-list .product.need-choose-options, .products-sidebar .product.need-choose-options';
    jQuery(draggableDisablePattern, this.base).draggable('disable');

    cartTray.droppable(
    {
      tolerance: 'touch',

      over: function(event, ui)
      {
        cartTray.addClass('droppable');
      },

      out: function(event, ui)
      {
        cartTray.removeClass('droppable');
      },

      drop: function(event, ui)
      {
        var pid = core.getValueFromClass(ui.draggable, 'productid');
        if (pid) {
          cartTray
            .removeClass('cart-tray-moving cart-tray-added')
            .addClass('cart-tray-adding')
            .removeClass('droppable');

          countRequests++;

          core.trigger('addToCartViaDrop', {widget: o});

          core.post(
            URLHandler.buildURL(
              {
                target: 'cart',
                action: 'add'
              }
            ),
            function(XMLHttpRequest, textStatus, data, isValid)
            {
              countRequests--;
              if (!isValid) {
                core.trigger(
                  'message',
                  {
                    text: 'An error occurred during adding the product to cart. Please refresh the page and try to drag the product to cart again or contact the store administrator.',
                    type: 'error'
                  }
                );
              }

              if (0 == countRequests) {
                if (isValid) {
                  cartTray
                    .removeClass('cart-tray-adding')
                    .addClass('cart-tray-added');

                  setTimeout(
                    function() {
                      if (cartTray.data('isproductdrag')) {
                        cartTray
                          .removeClass('cart-tray-added')
                          .addClass('cart-tray-moving');

                      } else {
                        cartTray.not('.cart-tray-adding')
                         .fadeOut(
                            cartTrayFadeOutDuration,
                            function() {
                              if (cartTray.data('isproductdrag')) {
                                jQuery(this)
                                  .removeClass('cart-tray-added')
                                  .addClass('cart-tray-moving')
                                  .show();

                              } else {
                                jQuery(this)
                                .removeClass('cart-tray-active cart-tray-added');
                              }
                            }
                          );
                      }
                    },
                    4000
                  ); // setTimeout()

                } else {
                  cartTray
                    .removeClass('cart-tray-adding cart-tray-active');

                }
              } // if (0 == countRequests)
            },
            {
              target:     'cart',
              action:     'add',
              product_id: pid
            },
            {
              rpc: true
            }
          ); // core.post()
        } // if (isProductDrag)
      } // drop()
    }
    ); // cartTray.droppable()

    // Manual set cell's height
    this.base.find('table.products-grid tr').each(
      function () {
        var height = 0;
        jQuery('div.product', this).each(
          function() {
            height = Math.max(height, jQuery(this).height());
          }
        );
      }
    );

    // Process click on 'Add to cart' buttons by AJAX
    jQuery('.add-to-cart', this.base).each(
      function (index, elem) {
        jQuery(elem).click(function() {
          ProductsListView.prototype.addToCart(elem);
        });
      }
    );
  } // if (isSuccess)
}; // ProductsListView.prototype.postprocess()

// Post AJAX request to add product to cart
ProductsListView.prototype.addToCart = function(elem)
{
  var pid = core.getValueFromClass(jQuery(elem), 'productid');

  core.post(
    URLHandler.buildURL(
      {
        target: 'cart',
        action: 'add'
      }
    ),
    function(XMLHttpRequest, textStatus, data, isValid)
    {
      if (!isValid) {
        core.trigger(
          'message',
          {
            text: 'An error occurred during adding the product to cart. Please refresh the page and try to drag the product to cart again or contact the store administrator.',
            type: 'error'
          }
        );
      }
    },
    {
      target:     'cart',
      action:     'add',
      product_id: pid
    },
    {
      rpc: true
    }
  ); // core.post()
}

// Get event namespace (prefix)
ProductsListView.prototype.getEventNamespace = function()
{
  return 'list.products';
}

/**
 * Load product lists controller
 */
core.autoload(ProductsListController);
