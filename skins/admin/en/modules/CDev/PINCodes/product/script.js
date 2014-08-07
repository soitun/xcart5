/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Pin codes page scripts
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function lcPinCodesUpdateEnabled() {
  var enabled = jQuery('#enabled-checkbox').prop('checked');

  var elements = jQuery('div.pin-codes-auto,div.pin-codes-actions,div.pin-codes-status,div.items-list');
  if (enabled) {
    elements.show();
    lcPinCodesUpdateAuto();
  } else {
    elements.hide();
  }
}

function lcPinCodesUpdateAuto() {
  var auto = jQuery('#autopincodes').val();

  var elements = jQuery('div.pin-codes-actions, div.pin-codes-status .remaining, div.can-add-after-saving');
  if ('0' === auto) {
    elements.show();
  } else {
    elements.hide();
  }
}

function lcPinCodesDisableSoldRemoval() {
  jQuery('div.pincodes tr.sold button.remove')
    .css('opacity', '0.5')
    .css('cursor', 'auto')
    .attr('title', lbl_cannot_remove_sold_pincode)
    .unbind('click');
}

jQuery().ready(
  function () {
    jQuery('#autopincodes').change(lcPinCodesUpdateAuto);
    lcPinCodesUpdateAuto();

    jQuery('#enabled-checkbox').change(lcPinCodesUpdateEnabled);
    lcPinCodesUpdateEnabled();
    decorate(
      'ItemsList',
      'placeNewContent',
      function () {
        arguments.callee.previousMethod.apply(this, arguments);

        lcPinCodesDisableSoldRemoval();
      }
    );

    lcPinCodesDisableSoldRemoval();
  }
);
