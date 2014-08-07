/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Wholesale functions
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function getWholesaleParams(product)
{
  return {
    quantity: jQuery(".product-qty input[type='text']").val()
  };
}

function getWholesaleTriggers()
{
  return ".product-qty input[type='text']";
}

function bindWholesaleTriggers()
{
  var handler = function ($this) {
    core.trigger('update-product-page', jQuery('input[name="product_id"]', $this).val());
  };

  var timer;
  var $this = jQuery(".product-qty.wholesale-price-defined input[type='text']").closest('form')

  if ($this) {
    jQuery(".product-qty.wholesale-price-defined input[type='text']")
      .unbind('change')
      .bind('change', function (e) {
        window.clearTimeout(timer);
        timer = window.setTimeout(function () {
          handler($this);
        }, 2000);
      });
  }
}

core.registerWidgetsParamsGetter('update-product-page', getWholesaleParams);
core.registerWidgetsTriggers('update-product-page', getWholesaleTriggers);
core.registerTriggersBind('update-product-page', bindWholesaleTriggers);
