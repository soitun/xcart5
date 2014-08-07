/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Disables dragging
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function disableDragging()
{
  var draggablePattern = '.products-grid .product, .products-list .product, .products-sidebar .product';
  jQuery(draggablePattern).draggable('disable').removeClass('ui-state-disabled');
}

core.bind(
  'load',
  function() {
    decorate(
      'ProductsListView',
      'postprocess',
      function(isSuccess, initial)
      {
        arguments.callee.previousMethod.apply(this, arguments);
        disableDragging();
      }
    )
  }
);

