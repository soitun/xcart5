{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Payment method row
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
{if:method.processor.getIconPath(order,method)}
  <img src="{preparePaymentMethodIcon(method.processor.getIconPath(order,method))}" alt="{method.getName()}" />
{else:}
  {if:method.getDescription()}{method.getDescription()}{else:}{method.getName()}{end:}
{end:}
