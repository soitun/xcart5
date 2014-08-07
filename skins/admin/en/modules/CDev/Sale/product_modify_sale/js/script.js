/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Sale widget controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function SalePriceValueBlock() {

  if (!jQuery('#participate-sale').is(':checked')) {
    jQuery('.sale-discount-types').hide();
  }

  // Binding "Change" functionality to participate-sale checkbox
  jQuery('#participate-sale').change(
    function () {
      if (this.checked) {
        jQuery('.sale-discount-types').show();

      } else {
        jQuery('.sale-discount-types').hide();
      }
    }
  );
}

core.autoload(SalePriceValueBlock);
