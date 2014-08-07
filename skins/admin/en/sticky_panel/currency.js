/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Sticky panel controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

// TODO: move this bind/trigger events to the main widget definition

jQuery().ready(
  function () {
    jQuery('.sticky-panel').each(
      function () {

        var box     = jQuery(this);
        var cancel  = jQuery('.cancel', box);
        var buttons = jQuery('button', box);
        var form    = box.closest('form');

        form.get(0).commonController.submitOnlyChanged = true;

        form.bind(
          'sticky_undo_buttons',
          function (e){
            buttons.each(
              function() {
                this.disable();
              }
            );

            cancel.addClass('disabled');
          }
        );

        form.bind(
          'sticky_changed_buttons',
          function (e){
            buttons.each(
              function() {
                this.enable();
              }
            );

            cancel.removeClass('disabled');
          }
        );

        cancel.bind(
          'click',
          function (e) {
            box.trigger('sticky_undo_buttons');
          }
        );

      }
    );
  }
);


