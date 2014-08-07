/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Delete user button controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function PopupButtonDeleteUser()
{
  PopupButtonDeleteUser.superclass.constructor.apply(this, arguments);
}

extend(PopupButtonDeleteUser, PopupButton);

PopupButtonDeleteUser.prototype.pattern = '.delete-user-button';

decorate(
  'PopupButtonDeleteUser',
  'callback',
  function (selector)
  {
    // Some autoloading could be added
    jQuery('.button-cancel').each(
      function () {

        jQuery(this).attr('onclick', '')
        .bind(
          'click',
          function (event) {
            event.stopPropagation();

            jQuery(selector).dialog('close');

            return true;
          });

      });
  }
);

core.autoload(PopupButtonDeleteUser);
