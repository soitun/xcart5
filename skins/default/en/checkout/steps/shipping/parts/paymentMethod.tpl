{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Payment method row
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<div IF="method.processor.getIconPath(order,method)" class="icon">
  <img src="{preparePaymentMethodIcon(method.processor.getIconPath(order,method))}" alt="" />
</div>
<span class="payment-title">{method.getTitle()}</span>
<div IF="method.processor.isCOD()&method.processor.getCODValue(order)" class="payment-cod">{t(#This will increase the shipping cost by XX#,_ARRAY_(#XX#^formatPrice(method.processor.getCODValue(order))))}</div>
<div IF="{method.getDescription()}" class="payment-description">{method.getDescription()}</div>
