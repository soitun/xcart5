{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Shopping cart subtotal
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="cart.panel.totals", weight="30")
 *}
<li class="total">
  <strong>{t(#Total#)}:</strong>
  <widget class="XLite\View\Surcharge" surcharge="{cart.getTotal()}" currency="{cart.getCurrency()}" />
</li>
