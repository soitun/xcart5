{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Body
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<div class="product-comparison">
  <div IF="!isEmptyList()" class="{getBlockClasses()}">
    <h2>{t(getHead())}</h2>
    <ul>
      <li FOREACH="getProducts(),product">
        <a href="#" class="remove" title="{t(#Remove#)}" data-id="{product.product_id}"><img src="images/spacer.gif" alt="{t(#Remove#)}" /></a>
        <a href="{product.getURL()}">{product.getName()}</a>
      </li>
    </ul>
    <div class="buttons-row">
      <widget class="\XLite\Module\XC\ProductComparison\View\Button\Compare" />
      <a href="#" class="clear-list">{t(#Clear list#)}</a>
    </div>
  </div>
</div>
