/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Remove button controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

jQuery().ready(
  function () {
    jQuery('div.btn-dropdown button.main').click(
      function () {
        jQuery(this).parent().find('li button:first').click();
        return false;
      }
    );
  }
);
