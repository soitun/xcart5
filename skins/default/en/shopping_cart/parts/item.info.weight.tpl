{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Shopping cart item weight block
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="cart.item.info", weight="30")
 *}
<p class="item-weight" IF="{item.getWeight()}">
  <span>{t(#Weight#)}:</span>
  {item.getWeight()} {getWeightSymbol()}
</p>
