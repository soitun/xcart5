/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

TableItemsList.prototype.listeners.unremovableRole = function(handler)
{
  jQuery('.permanent .input-field-wrapper.switcher input', handler.container).prop('disabled', 'disabled');
};

