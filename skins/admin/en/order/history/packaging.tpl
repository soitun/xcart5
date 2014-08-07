{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Order packaging template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="order-packaging">

  <p>{t(#Shipping has been calculated based on the following split of the products into packages:#)}</p>

  <ul class="packages">
    <li FOREACH="getPackages(),id,package">
      <div><span class="package-id">{t(#Package#)} #{id}</span> <span class="package-props">[{t(#weight#)}: {package.weight} {getWeightSymbol()}, {t(#dimensions#)}: {package.box.length}x{package.box.width}x{package.box.height} {getDimSymbol()}]</span></div>
      <ul class="package-products">
        {foreach:package.items,item}
        <li><span class="package-item-name">{item.name}:</span> <span class="package-item-qty">{item.qty} {t(#item(s)#)}</span></li>
        {end:}
      </ul>
    </li>
  </ul>

</div>
