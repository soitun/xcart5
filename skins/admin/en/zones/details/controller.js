/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Zone details form controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

core.bind(
  'load',
  function(event) {
    jQuery('.table-value .listbox').each(function () {
      var obj = jQuery(this);

      var inputField = jQuery('input[type="hidden"]', obj);
      var inputFieldId = jQuery(inputField).attr('id');

      inputField
        .parents('form')
        .submit(
          function() {
            var id = inputFieldId.replace('-store', '');
            saveSelects(new Array(id));
  
            return true;
          }
        );
    });
  }
);
