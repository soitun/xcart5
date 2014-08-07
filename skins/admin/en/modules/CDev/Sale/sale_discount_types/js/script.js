/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Sale widget controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function SalePriceValue() {

  jQuery('.discount-type input:radio:checked').closest('ul.sale-discount').addClass('active');

  jQuery('.discount-type input:radio').bind('click', function () {

    jQuery('ul.sale-discount').removeClass('active');

    jQuery(this).closest('ul.sale-discount').addClass('active');

    var input = jQuery('#sale-price-value-' + jQuery(this).val());

    input.focus();

    jQuery('input[name="postedData[salePriceValue]"]').val(input.val());
  });

  jQuery('.sale-price-value input[type="text"]').bind('change', function () {
    jQuery('input[name="postedData[salePriceValue]"]').val(jQuery(this).val());
  });
}

core.autoload(SalePriceValue);