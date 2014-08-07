{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Display horizontal minicart item price
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="minicart.horizontal.item", weight="20")
 *}
<div class="item-price"><widget class="XLite\View\Surcharge" surcharge="{item.getNetPrice()}" currency="{cart.getCurrency()}" /> &times; {item.getAmount()}</div>
