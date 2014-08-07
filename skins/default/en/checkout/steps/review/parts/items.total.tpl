{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Checkout : order review step : items : total
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="checkout.review.selected.items", weight="40")
 * @ListChild (list="checkout.review.inactive.items", weight="40")
 *}
<hr />

<div class="total clearfix">
  {t(#Total#)}:
  <span class="value"><widget class="XLite\View\Surcharge" surcharge="{cart.getTotal()}" currency="{cart.getCurrency()}" /></span>
</div>
