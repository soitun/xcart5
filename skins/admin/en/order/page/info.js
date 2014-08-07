/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Order info form controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function OrderInfoForm()
{
  jQuery(this.formContainer).get(0).commonController.submitOnlyChanged = true;
}

OrderInfoForm.prototype.formContainer = '.order-info form';

core.autoload(OrderInfoForm);