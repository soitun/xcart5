/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Create shipment button controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function CapostButtonCreateShipment()
{
  var obj = this;

  jQuery('.capost-button-create-shipment').each(function () {
    
    var btn = this;
    var o = jQuery(this);

    var parcelId = core.getCommentedData(o, 'parcel_id');

    o.click(function (event) {
  
      popup.openAsWait();

      submitForm(btn.form, obj.getParams(parcelId));
    });
  });
}

CapostButtonCreateShipment.prototype.getParams = function (parcelId)
{
  var result = {
    'action': 'capost_create_shipment',
    'parcel_id': parcelId
  };

  return result;
};

core.autoload(CapostButtonCreateShipment);

