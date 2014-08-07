/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Product box controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

jQuery().ready(
  function() {
    var base = jQuery('.product-block .product');

    // Register "Quick look" button handler
    jQuery('.quicklook a.quicklook-link', base).click(
      function () {
        return !popup.load(
          URLHandler.buildURL({
            target:      'quick_look',
            action:      '',
            product_id:  core.getValueFromClass(this, 'quicklook-link'),
            only_center: 1
          }),
          false,
          50000
        );
      }
    );
  }
);

