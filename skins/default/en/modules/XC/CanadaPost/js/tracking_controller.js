/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Canda Post tracking details controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

jQuery().ready(
  function () {
    jQuery('a.capost-tracking-link').click(
      function () {
        return !popup.load(
          this,
          null,
          false
        );
      }
    );
  }
);
