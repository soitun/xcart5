/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Transmit shipment button controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function CapostButtonTransmitShipment()
{
  var obj = this;

  jQuery('.capost-button-transmit-shipment').each(function () {
    
    var btn = this;
    var o = jQuery(this);

    var parcelId = core.getCommentedData(o, 'parcel_id');
    var warningText = core.getCommentedData(o, 'warning_text');

    o.click(function (event) {

      result = confirm(warningText);

      if (result) {
      
        popup.openAsWait();

        submitForm(btn.form, obj.getParams(parcelId));
      }
    });
  });
}

CapostButtonTransmitShipment.prototype.getParams = function (parcelId)
{
  var result = {
    'action': 'capost_transmit_shipment',
    'parcel_id': parcelId
  };

  return result;
};

core.autoload(CapostButtonTransmitShipment);

