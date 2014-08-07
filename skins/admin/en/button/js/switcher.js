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
    jQuery('button.switcher').click(
      function () {
        var inp = jQuery(this).prev();
        var enable = !inp.attr('value');
        inp.attr('value', enable ? '1' : '');
        var btn = jQuery(this);
        if (enable) {
          btn.addClass('on').removeClass('off').attr('title', btn.data('lbl-disable'));

        } else {
          btn.addClass('off').removeClass('on').attr('title', btn.data('lbl-enable'));
        }
      }
    );
  }
);

