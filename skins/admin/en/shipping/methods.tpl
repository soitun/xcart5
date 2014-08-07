{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Shipping methods management page main template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<ul class="carriers-list" IF="getShippingProcessors()">
  <li FOREACH="getShippingProcessors(),id,p">
    <a href="{buildURL(#shipping_methods#,##,_ARRAY_(#carrier#^p.getProcessorId()))}" IF="!isActiveCarrier(p)">{t(p.getProcessorName())}</a>
    <span IF="isActiveCarrier(p)">{t(p.getProcessorName())}</span>
  </li>
</ul>

<widget class="\XLite\View\Form\Shipping\Methods" name="shipping_methods_form" />
  <widget class="\XLite\View\ItemsList\Model\Shipping\Methods" />
<widget name="shipping_methods_form" end />
