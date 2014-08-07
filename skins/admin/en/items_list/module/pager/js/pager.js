/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * JS pager
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

core.microhandlers.add(
  'addons-pager-list-wrapper',
  '.addons-pager-list-wrapper',
  function (event) {
    jQuery('.addons-pager-list-wrapper').each(function (index, elem) {
      jQuery(elem).width(jQuery('.addons-pager-list-wrapper > .pagination').width());
    });
  }
);
