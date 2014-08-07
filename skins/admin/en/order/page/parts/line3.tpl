{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Order : line 3
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="order.operations", weight="300")
 *}

<div IF="isOrderItemsVisible()" class="line-3">
  <h2>{t(#Order items#)}</h2>
  <list name="order.items.wrapper" />
</div>
