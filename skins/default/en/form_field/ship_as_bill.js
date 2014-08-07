/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Shipping-as-billing checkbox controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function ShipAsBillHandler()
{
  this.flag = jQuery('#ship-as-bill');
  this.block = jQuery('.shipping-section');

  // Event handlers
  var o = this;

  this.flag.click(
    function(event) {
      return o.changeFieldsAccessability();
    }
  );

  this.changeFieldsAccessability();
}

ShipAsBillHandler.prototype.flag = null;
ShipAsBillHandler.prototype.block = null;

ShipAsBillHandler.prototype.changeFieldsAccessability = function()
{
  this.block.find('input, select, textarea').prop('disabled', this.flag.prop('checked') ? 'disabled' : '');
  this.flag.removeProp('disabled');
};

jQuery(document).ready(
  function(event) {
    var shipAsBillHandler = new ShipAsBillHandler();
  }
);
