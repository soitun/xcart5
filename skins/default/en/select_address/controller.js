/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Pick address from address book controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */
core.trigger(
  'load',
  function() {
    var form = jQuery('form.select-address').eq(0);
    jQuery('.select-address .addresses > li').click(
      function() {
        form.get(0).elements.namedItem('addressId').value = core.getValueFromClass(this, 'address')
        form.submit();
      }
    );
  }
);
