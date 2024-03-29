/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Canada Post return products button controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function PopupButtonCapostReturnProducts(base)
{
  PopupButtonCapostReturnProducts.superclass.constructor.apply(this, arguments);
}

extend(PopupButtonCapostReturnProducts, PopupButton);

PopupButtonCapostReturnProducts.prototype.pattern = '.popup-button.capost-return-products-button';

core.autoload(PopupButtonCapostReturnProducts);
